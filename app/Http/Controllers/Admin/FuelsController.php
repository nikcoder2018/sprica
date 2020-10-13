<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Fuel;
use App\Vehicle;
use App\User;
class FuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fuels'] = Fuel::with(['driver','vehicle'])->get();
        $data['vehicles'] = Vehicle::all();
        $data['drivers'] = User::all();

        return view('admin.contents.fuels', $data);
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
        $addFuel = Fuel::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'fill_date' => $request->fill_date,
            'quantity' => $request->quantity,
            'odometer_reading' => $request->odometer_reading,
            'amount' => $request->amount,
            'comment' => $request->comment
        ]);

        if($addFuel)
            return response()->json(array('success' => true, 'msg' => 'Add Fuel.'));
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
        $fuel = Fuel::find($request->id);
        return response()->json($fuel);
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
        $fuel = Fuel::find($request->id);
        $fuel->vehicle_id = $request->vehicle_id;
        $fuel->driver_id = $request->driver_id;
        $fuel->fill_date = $request->fill_date;
        $fuel->quantity = $request->quantity;
        $fuel->odometer_reading = $request->odometer_reading;
        $fuel->amount = $request->amount;
        $fuel->comment = $request->comment;
        $fuel->save();

        if($fuel)
            return response()->json(array('success' => true, 'msg' => 'Fuel Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Fuel::find($request->id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Fuel Deleted'));
    }
}
