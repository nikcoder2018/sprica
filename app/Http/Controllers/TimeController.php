<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function search(Request $request)
    {
        $times = Time::where('hours', $request->input('query'))->get();
        return $times;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $times = Time::all();

        return response()->json($times);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Time::create($request->only(['hours', 'break']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $time = Time::findOrFail($request->input('time_id'));
        return $time;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $time = Time::findOrFail($request->input('time_id'));
        $time->update($request->only(['hours', 'break']));

        return $time;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $time = Time::findOrFail($request->input('time_id'));
        $time->delete();
        return response('', 204);
    }
}
