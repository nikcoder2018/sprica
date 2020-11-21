<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Project;
use App\ProjectActivity;
use App\Task;
use App\TaskAssignment;
use App\User;
use App\Role;
use App\EmailTrigger;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks'] = Task::with(['project','assigned'])->get();
        $data['projects'] = Project::all();
        $data['employees'] = User::all();
        #return response()->json($data); exit;
        return view('admin.contents.tasks', $data);
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

        foreach($request->assign_to as $employee){
            TaskAssignment::create([
                'task_id' => $task->id,
                'user_id' => auth()->user()->id,
                'assign_to' => $employee
            ]);

            EmailTrigger::Execute('NEW_TASK_CREATED', array('user_id' => $employee));   
        }
        
        ProjectActivity::create([
            'project_id' => $request->project_id,
            'user_id' => auth()->user()->id,
            'details' => 'New Task Added.'
        ]);

        $renderRow = view('render.row-new-project-task', ['task' => $task])->render();

        return response()->json(array('success' => true, 'msg' => 'Task Successfully Created', 'row' => $renderRow));
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

        $assigned_employee = array();

        foreach($request->assign_to as $employee){
            if(!TaskAssignment::where('task_id',$task->id)->where('assign_to',$employee)->exists()){
                TaskAssignment::create([
                    'task_id' => $task->id,
                    'assign_to' => $employee
                ]);
            }

            array_push($assigned_employee, $employee);
        }

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

        TaskAssignment::where('task_id', $task->id)->whereNotIn('assign_to', $assigned_employee)->delete();

        $renderRow = view('render.row-new-project-task', ['task' => $task])->render();

        return response()->json(array('success' => true, 'msg' => 'Task Updated Successfully.','renderRow' => $renderRow, 'id' => $task->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $task = Task::find($request->id);
        $task->delete();

        ProjectActivity::create([
            'project_id' => $request->project_id,
            'user_id' => auth()->user()->id,
            'details' => 'Project Task Deleted'
        ]);

        if($task){
            return response()->json(array('success' => true, 'msg' => 'Task Deleted!','id'=>$task->id));
        }
    }
}
