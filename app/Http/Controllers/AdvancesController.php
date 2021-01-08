<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Advance as ResourceAdvance;
use App\User;
use App\Advance;
use DataTables;
class AdvancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Advances';
        $data['users'] = User::where('status', 1)->get();
        return view('contents.advances', $data);
    }

    public function all(){
        $advances = Advance::with('user')->get();
        return DataTables::of(ResourceAdvance::collection($advances))->toJson();
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
        $advance = Advance::create([
            'user_id' => $request->user_id,
            'received_at' => $request->received_at,
            'debit_at' => $request->debit_at,
            'amount' => $request->amount,
            'paid_by' => $request->paid_by,
        ]);

        if($advance)
            return response()->json(array('success' => true, 'msg' => 'Data saved successfully!'));
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
    public function edit($id)
    {
        $advance = Advance::find($id);
        return response()->json($advance);
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
        $advance = Advance::find($request->id);
        $advance->received_at = $request->received_at;
        $advance->debit_at = $request->debit_at;
        $advance->amount = $request->amount;
        $advance->paid_by = $request->paid_by;
        $advance->save();

        if($advance)
            return response()->json(array('success' => true, 'msg' => 'Updated Successful'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Advance::find($id);
        $delete->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Delete Successful'));
    }
}
