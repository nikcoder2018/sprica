<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Language;

use App\Http\Resources\Project as ResourceProject;
use App\Http\Resources\ProjectMember as ResourceProjectMember;
use App\Project;
use App\Task;
use App\TaskAssignment;
use App\User;
use App\ProjectMember;
use App\Role;
use App\Timelog;
use DataTables;
class ProjectsController extends Controller
{
    public function index(){
        $data['users'] = User::where('status', 1)->get();
        $data['title'] = 'Projects';
        return view('contents.projects', $data);
    }

    public function all(){
        //return response()->json(Role::all());
        $projects = Project::with(['client','tasks','leader','tasks_completed'])->whereNotIn('title',['Feiertag','Urlaub','Krank','KUG'])->orderBy('id', 'DESC')->get();
        
        return DataTables::of(ResourceProject::collection($projects))->toJson();
    }

    public function details($id, Request $request){
        switch($request->category){
            case 'tasks': 
                $tasks = Task::where('project_id', $id)->with('assigned')->get();
                return DataTables::of($tasks)->toJson();
            break;
            case 'timelogs': 
                $timelogs = Timelog::where('project_id', $id)->with('user')->get();
                return DataTables::of($timelogs)->toJson();
            break;
            case 'members': 
                $project = Project::where('id', $id)->with('members')->first()->toArray();
                $members = array_map(function($member) use ($project){
                    if($project['leader_id'] == $member['id']){
                        $member['is_leader'] = true;
                        return $member;
                    }else{
                        return $member;
                    }
                }, $project['members']);
                return DataTables::of($members)->toJson();
            break;
        }
    }
    public function show($id){
        $data['project'] = Project::with(['tasks','timelogs','leader', 'members', 'activities'])->where('id', $id)->orderBy('id', 'DESC')->first();
        $data['users'] = User::where('status', 1)->get();
        $data['hours_logged'] = Timelog::where('project_id', $id)->sum('duration');

        //return $data;
        return view('contents.projects.details', $data);
    }

    public function create(){
        $data['users'] = User::where('status', 1)->get();

        return view('admin.contents.projects_add', $data);
    }
    public function store(Request $request){
        $project = Project::create([
            'leader_id' => $request->leader,
            'title' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline,
            'budget' => $request->budget,
            'spent' => $request->spent,
            //'currency' => $request->currency,
            'status' => $request->status
        ]);

        $project->members()->sync($request->input('members', []));

        if($project){
            return response()->json(array('success' => true, 'msg' => 'New project added successfully.'));
        }else{
            return response()->json(array('success' => true, 'msg' => 'Something went wrong!'));
        }
    }

    public function add_member(Request $request){
        $project = Project::find($request->project_id);
        $project->members()->attach($request->user_id);

        if($project){
            return response()->json(array('success' => true, 'msg' => 'New member added successfully.'));
        }
    }

    public function remove_member(Request $request){
        $project = Project::find($request->id);
        $remove = $project->members()->detach($request->member_id);

        if($remove){
            return response()->json(array('success' => true, 'msg' => 'Member Removed!'));
        }
    }

    public function set_leader(Request $request){
        $project = Project::find($request->project_id);
        $project->leader_id = $request->user_id;
        $project->save();
        if($project){
            return response()->json(array('success' => true, 'msg' => 'New member added successfully.','leader_id' => $request->user_id));
        }
    }

    public function edit(Project $project){
        $members = User::all();
        $project->load('members');
        return response()->json($project);
    }
    
    public function update(Request $request){
        $project = Project::find($request->id);
        $project->title = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->star_date;
        $project->deadline = $request->deadline;
        $project->leader_id = $request->leader;
        $project->budget = $request->budget;
        $project->spent = $request->spent;
        $project->status = $request->status;
        $project->save();
        $project->members()->sync($request->input('members', []));

        if($project){
            return response()->json(array('success' => true, 'msg' => 'Project updated successfully.'));
        }else{
            return response()->json(array('success' => true, 'msg' => 'Something went wrong!'));
        }
    }

    public function destroy($id){
        $project = Project::find($id);
        $project->delete();

        if($project){
            return response()->json(array('success' => true, 'msg' => 'Project Deleted!'));
        }
    }

    public function calendar(){
        $data['projects'] = Project::all();
        $data['employees'] = User::where('status', 1)->get();
        return view('admin.contents.projects_calendar', $data);
    }

    public function calendar_resources(){
        $users = User::orderBy('name', 'ASC')->get();

        $user_array = array();
        foreach($users as $user){
            array_push($user_array, (object) array(
                'id' => $user->id,
                'title' => $user->name
            ));
        }

        return response()->json($user_array);
    }

    public function calendar_events(){
        $users = User::with('tasks')->orderBy('name', 'ASC')->get();

        $results = array();
        foreach($users as $user){
            $title = '';
            foreach($user->tasks as $task){
                $project = Project::find($task->project_id);
                array_push($results, (object) array(
                    'resourceId' => $user->id,
                    'title' => $project->title.'-'.$task->title,
                    'start' => $task->start_date,
                    'end' => $task->due_date
                ));
            }
        }

        return response()->json($results);
    }
}
