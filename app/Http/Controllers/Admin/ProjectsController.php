<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Language;

use App\Project;
use App\Task;
use App\TaskAssignment;
use App\User;
use App\ProjectMember;
class ProjectsController extends Controller
{
    public function index(){
        $data['projects'] = Project::with(['tasks','tasks_completed', 'members'])->whereNotIn('ProjeBASLIK',['Feiertag','Urlaub','Krank','KUG'])->orderBy('ProjeID', 'DESC')->get();
        $data['users'] = User::where('status', 1)->get();
        
        //return response()->json($data); exit;
        return view('admin.contents.projects', $data);
    }

    public function show($id){
        $data['project'] = Project::with(['tasks','timelogs', 'members', 'activities'])->where('ProjeID', $id)->orderBy('ProjeID', 'DESC')->first();
        
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
            'ProjeBASLIK' => $request->name,
            'description' => $request->description,
            'client' => $request->company,
            'budget' => $request->budget,
            'spent' => $request->spent,
            'status' => $request->status
        ]);

        foreach($request->members as $member){
            ProjectMember::create([
                'project_id' => $project->ProjeID,
                'user_id' => $member
            ]);
        }

        $leader = ProjectMember::where('project_id', $project->id)->where('user_id',$request->leader);
        if($leader->exists()){
            $leader->leader = 1;
            $leader->save();
        }else{
            ProjectMember::create([
                'project_id' => $project->ProjeID,
                'user_id' => $request->leader,
                'leader' => 1
            ]);
        }

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
    public function edit(Request $request){
        $project = Project::with('members')->where('ProjeID',$request->id)->first();

        return response()->json($project);
    }
    
    public function update(Request $request){
        $project = Project::find($request->id);
        $project->ProjeBASLIK = $request->name;
        $project->description = $request->description;
        $project->client = $request->company;
        $project->budget = $request->budget;
        $project->spent = $request->spent;
        $project->status = $request->status;
        $project->save();

        $membersIds = array();

        if($request->members){
            foreach($request->members as $member){
                if(!ProjectMember::where('project_id', $project->ProjeID)->where('user_id', $member)->exists()){
                    ProjectMember::create([
                        'project_id' => $project->ProjeID,
                        'user_id' => $member
                    ]);
                }
    
                array_push($membersIds, $member);
            }
        }
        ProjectMember::where('project_id', $project->ProjeID)->whereNotIn('user_id', $membersIds)->delete();

        $leader = ProjectMember::where('project_id', $project->ProjeID)->where('user_id',$request->leader);
        if($leader->exists()){
            $leader = ProjectMember::where('project_id', $project->ProjeID)->where('user_id',$request->leader)->first();
            $leader->leader = 1;
            $leader->save();
        }else{
            ProjectMember::create([
                'project_id' => $project->ProjeID,
                'user_id' => $request->leader,
                'leader' => 1
            ]);
        }
        if($project){
            return response()->json(array('success' => true, 'msg' => 'Project updated successfully.'));
        }else{
            return response()->json(array('success' => true, 'msg' => 'Something went wrong!'));
        }
    }

    public function destroy(Request $request){
        $project = Project::find($request->id);
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

        return view('admin.contents.projects_calendar');
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
