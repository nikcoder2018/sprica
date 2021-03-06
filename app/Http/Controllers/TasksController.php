<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Project;
use App\ProjectActivity;
use App\Task;
use App\TaskAssignment;
use App\User;
use App\Role;
use App\EmailTrigger;

use App\Http\Resources\Task as ResourceTask;

use DataTables;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Tasks';
        $data['projects'] = Project::all();
        $data['employees'] = User::where('status', 1)->get();
        return view('contents.tasks', $data);
    }

    public function all(){
        $tasks = Task::with(['assigned','project'])->get();
        
        return DataTables::of(ResourceTask::collection($tasks))->toJson();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'project_id' => $request->project_id,
            'title' => $request->title, 
            'description' => $request->description, 
            'start_date' => $request->start_date, 
            'due_date' => $request->due_date, 
            'status' => $request->status, 
            'priority' => $request->priority
        ]);

        $task->assigned()->sync($request->input('assign_to', []));

        // foreach($request->assign_to as $employee){
        //     EmailTrigger::Execute('NEW_TASK_CREATED', array('user_id' => $employee));   
        // }
        
        ProjectActivity::create([
            'project_id' => $request->project_id,
            'user_id' => auth()->user()->id,
            'details' => 'New Task Added.'
        ]);

        return response()->json(array('success' => true, 'msg' => 'Task Successfully Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $task = Task::with('assigned')->where('id', $request->id)->first();
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->project_id = $request->project_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->save();

        $task->assigned()->sync($request->input('assign_to', []));

        if($task->status == 'completed'){
            ProjectActivity::create([
                'project_id' => $request->project_id,
                'user_id' => auth()->user()->id,
                'details' => 'Project Task Marked as Completed'
            ]);
        }

        if($task->status == 'incomplete'){
            ProjectActivity::create([
                'project_id' => $request->project_id,
                'user_id' => auth()->user()->id,
                'details' => 'Project Task Marked as Incomplete'
            ]);
        }

        ProjectActivity::create([
            'project_id' => $request->project_id,
            'user_id' => auth()->user()->id,
            'details' => 'Project Task Updated'
        ]);

        return response()->json(array('success' => true, 'msg' => 'Task Updated Successfully.', 'id' => $task->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        
        ProjectActivity::create([
            'project_id' => $task->project_id,
            'user_id' => auth()->user()->id,
            'details' => 'Project Task Deleted'
        ]);

        $task->delete();

        if($task){
            return response()->json(array('success' => true, 'msg' => 'Task Deleted!','id'=>$task->id));
        }
    }
}
