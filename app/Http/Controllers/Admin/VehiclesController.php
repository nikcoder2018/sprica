<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Vehicle;
use App\VehicleGroup;
use App\User;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vehicles'] = Vehicle::with('group')->get();
        $data['groups'] = VehicleGroup::all();

        return view('admin.contents.vehicles', $data);
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
        $addVehicle = Vehicle::create([
            'name' => $request->name,
            'registration_no' => $request->registration_no,
            'model' => $request->model,
            'chassis_no' => $request->chassis_no,
            'engine_no' => $request->engine_no,
            'manufacturer' => $request->manufacturer,
            'type' => $request->type,
            'color' => $request->color,
            'registration_expiry' => $request->registration_expiry,
            'group_id' => $request->group_id
        ]);

        if($addVehicle)
            return response()->json(array('success' => true, 'msg' => 'Vehicle Updated.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['vehicle'] = Vehicle::with(['driver','group','fuels'])->where('id',$id)->first();
        $data['drivers'] = User::where('status', 1)->get();
        #return response()->json($data); exit;
        return view('admin.contents.vehicles-details', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $vehicle = Vehicle::find($request->id);
        return response()->json($vehicle);
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
        $vehicle = Vehicle::find($request->id);
        $vehicle->name = $request->name;
        $vehicle->registration_no = $request->registration_no;
        $vehicle->model = $request->model;
        $vehicle->chassis_no = $request->chassis_no;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->manufacturer = $request->manufacturer;
        $vehicle->type = $request->type;
        $vehicle->color = $request->color;
        $vehicle->registration_expiry = $request->registration_expiry;
        $vehicle->group_id = $request->group_id;
        $vehicle->is_active = $request->is_active;
        $vehicle->save();

        if($vehicle)
            return response()->json(array('success' => true, 'msg' => 'Vehicle Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Vehicle::find($request->id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Vehicle Deleted'));
    }

    public function setdriver(Request $request){
        $vehicle = Vehicle::find($request->id);
        $vehicle->driver_id = $request->driver;
        $vehicle->save();

        return response()->json(array('success' => true, 'msg' => 'Vehicle Updated'));
    }
}
