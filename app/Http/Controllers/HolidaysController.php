<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'date' => 'required',
            'occasion' => 'required:string'
        ]);

        $holiday = Holiday::create($data);

        if($holiday)
            return response()->json(['success' => true, 'msg' => 'New Holiday Created']);
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
    public function edit(Holiday $holiday)
    {
        return $holiday;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $data = $request->validate([
            'date' => 'required',
            'occasion' => 'required:string'
        ]);

        $holiday->update($data);

        if($holiday)
            return response()->json(['success' => true, 'msg' => 'Update Successful', 'details' => $holiday]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        if($holiday->delete())
            return response()->json(['success' => true, 'msg' => 'Delete Successful']);
    }
}
