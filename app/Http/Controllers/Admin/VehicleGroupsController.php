<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\VehicleGroup;
class VehicleGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['groups'] = VehicleGroup::all();
        return view('admin.contents.vehicle_groups', $data);
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
        $createGroup = VehicleGroup::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if($createGroup)
            return response()->json(array('success' => true, 'msg' => 'Group Created.'));
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
        $groupData = VehicleGroup::find($request->id);
        return response()->json($groupData);
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
        $group = VehicleGroup::find($request->id);
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();

        if($group)
            return response()->json(array('success' => true, 'msg' => 'Group Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = VehicleGroup::find($request->id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Group Deleted'));
    }
}
