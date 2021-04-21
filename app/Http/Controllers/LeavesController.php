<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Leave as ResourceLeave;
use App\Leave;
use App\LeaveType;
use App\User;

use DataTables;
class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Leaves';
        return view('contents.leaves.index', $data);
    }

    public function all(){
        $leaves = Leave::with(['user', 'type'])->get();
        
        return DataTables::of(ResourceLeave::collection($leaves))->toJson();
    }

    public function pendings(){
        $data['title'] = 'Pendings';
        $data['leaves'] = Leave::with(['user', 'type'])->where('status', 'pending')->get();

        return view('contents.leaves.pending', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Assign leave';
        $data['employees'] = User::where('status', 1)->get();
        $data['leaveTypes'] = LeaveType::all();
        return view('contents.leaves.create', $data);
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
            'employee' => 'required',
            'leave_type' => 'required',
            'status' => 'required|string',
            'dates' => 'required',
            'reason' => 'required|string'
        ]);

        $dates = explode(',',$data['dates']);

        foreach($dates as $date){
            Leave::create([
                'user_id' => $data['employee'],
                'type_id' => $data['leave_type'],
                'status' => $data['status'],
                'date' => $date,
                'reason' => $data['reason']
            ]);
        }

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
            'date' => 'required|date',
            'reason' => 'nullable|string'
        ]);

        $leave->update($data);

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

    public function request_action(Request $request){
        $leave = Leave::find($request->id);
        $messageText = '';
        switch($request->action){
            case 'approved':
                $leave->status = 'approved';
                $messageText = 'Request Approved';
            break;
            case 'rejected': 
                $leave->status = 'rejected';
                $messageText = 'Request Rejected';
            break;
        }

        $leave->save();

        return response()->json(['success' => true, 'msg' => $messageText, 'leave_id' => $leave->id]);
    }
}
