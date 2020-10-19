<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Language;

use App\Project;
use App\User;
class ProjectsController extends Controller
{
    public function index(){
        $projects = Project::with(['tasks','tasks_completed'])->orderBy('ProjeID', 'DESC')->get();
        

        foreach($projects as $project){
            $members = array();
            $tasks = $project->tasks;
            if(count($tasks) > 0){
                foreach($tasks as $task){
                    $assigns = $task->assigned;
                    if(count($assigns) > 0){
                        foreach($assigns as $assign){
                            array_push($members, $assign->assign_to);
                        }
                    }
                }
            }
            $members = array_unique($members);
            $members_data = array();
            foreach($members as $key=>$member){
                if(User::where('id', $member)->exists()){
                    array_push($members_data,User::find($member));
                }
                
            }

            $project['members'] = $members_data;
        }
        $data['projects'] = $projects;
        //return response()->json($data); exit;
        return view('admin.contents.projects', $data);
    }

    public function store(Request $request){
        $project = Project::create([
            'ProjeBASLIK' => $request->ProjeBASLIK,
            'ProjeKODU' => $request->ProjeKODU
        ]);

        if($project){
            return response()->json(array('success' => true, 'msg' => 'New project added successfully.'));
        }else{
            return response()->json(array('success' => true, 'msg' => 'Something went wrong!'));
        }
    }

    public function edit(Request $request){
        $project = Project::find($request->id);

        return response()->json($project);
    }
    
    public function update(Request $request){

        $project = Project::find($request->ProjeID);
        $project->ProjeBASLIK = $request->ProjeBASLIK;
        $project->ProjeKODU = $request->ProjeKODU;
        $project->save();

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

    public function calendar(){
        return view('admin.contents.projects_calendar');
    }
}
