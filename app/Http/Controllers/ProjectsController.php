<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Language;

use App\Http\Resources\Project as ResourceProject;
use App\Project;
use App\Task;
use App\TaskAssignment;
use App\User;
use App\ProjectMember;
use App\Role;
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

    public function show($id){
        $data['project'] = Project::with(['tasks','hours', 'members', 'activities'])->where('ProjeID', $id)->orderBy('ProjeID', 'DESC')->first();
        
        $data['users'] = User::where('status', 1)->get();
        #return response()->json($data); exit;
        return view('admin.contents.projects_details', $data);
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
        $newmember = new ProjectMember;
        $newmember->project_id = $request->project_id;
        $newmember->user_id = $request->user_id;
        $newmember->save();

        $renderRow = view('render.row-new-project-member', ['member' => $newmember])->render();

        if($newmember){
            return response()->json(array('success' => true, 'msg' => 'New member added successfully.', 'row' => $renderRow));
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
    public function remove_member(Request $request){
        $member = ProjectMember::where('project_id',$request->project_id)->where('user_id',$request->user_id);
        $member->delete();

        if($member){
            return response()->json(array('success' => true, 'msg' => 'Member Removed!','id' => $request->user_id));
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
        $users = User::orderBy('name', 'ASC')->get();

        $results = array();
        foreach($users as $user){
            $resourceId = $user->id;
            $title = '';
            $tasks = TaskAssignment::with('task')->where('assign_to', $resourceId)->get();

            foreach($tasks as $task){
                $project = Project::where('ProjeID', $task->task->project_id)->first();
                array_push($results, (object) array(
                    'resourceId' => $user->id,
                    'title' => $project->ProjeBASLIK.'-'.$task->task->title,
                    'start' => $task->task->start_date,
                    'end' => $task->task->due_date
                ));
            }
        }

        return response()->json($results);
    }
}
