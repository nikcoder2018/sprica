<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Language;

use App\Project;
class ProjectsController extends Controller
{
    public function index(){
        $data['projects'] = Project::orderBy('ProjeID', 'DESC')->get();

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
}
