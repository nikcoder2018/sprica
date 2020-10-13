<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TicketType;
class TicketsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['types'] = TicketType::all();
        return view('admin.contents.tickets_types', $data);
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
        $createType = TicketType::create([
            'name' => $request->name
        ]);
        if($createType)
            return response()->json(array('success' => true, 'msg' => 'Ticket Type Created'));
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
        $typeData = TicketType::find($request->id);
        return response()->json($typeData);
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
        $type = TicketType::find($request->id);
        $type->name = $request->name;
        $type->save();

        if($type)
            return response()->json(array('success' => true, 'msg' => 'Ticket Type Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $type = TicketType::find($request->id);
        $type->delete();

        if($type){
            return response()->json(array('success' => true, 'msg' => 'Ticket Type Deleted!'));
        }
    }
}
