<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\EmailCommand;
use App\EmailAction;

class EmailActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['actions'] = EmailAction::with('command')->get();
        $data['commands'] = EmailCommand::all();

        return view('admin.contents.emailaction', $data);
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
        $createAction = EmailAction::create([
            'command_id' => $request->command_id,
            'description' => $request->description
        ]);

        if($createAction)
            return response()->json(array('success' => true, 'msg' => 'Action Created'));
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
        $actionData = EmailAction::find($request->id);
        return response()->json($actionData);
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
        $action = EmailAction::find($request->id);
        $action->command_id = $request->command_id;
        $action->description = $request->description;
        $action->save();

        if($action)
            return response()->json(array('success' => true, 'msg' => 'Action Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = EmailAction::find($request->id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Action Deleted'));
    }
}
