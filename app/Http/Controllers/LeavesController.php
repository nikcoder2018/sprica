<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $data = $request->validate([
            'user_id' => 'required',
            'type_id' => 'required',
            'status' => 'required|string',
            'duration_type' => 'required|string',
            'reason' => 'nullable|string'
        ]);

        $leave = Leave::create($data);
        $leave->sync_dates($leave->id, $request->input('dates', []));

        if($leave)
            return response()->json(array('success' => true, 'msg' => 'New leave created'));
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
    public function edit(Leave $leave)
    {
        if($leave->exists())
            return response()->json($leave);
        else 
            return response()->json(['success' => false, 'msg' => "Data doesn't exists"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        $data = $request->validate([
            'type_id' => 'required',
            'status' => 'required|string',
            'duration_type' => 'required|string',
            'reason' => 'nullable|string'
        ]);

        $leave->update($data);
        $leave->sync_dates($leave->id,$request->input('dates', []));

        if($leave)
            return response()->json(['success' => true, 'msg' => 'Update Successful', 'details' => $leave]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        if($leave->delete())
            return response()->json(['success' => true, 'msg' => 'Delete Successful']);
    }
}
