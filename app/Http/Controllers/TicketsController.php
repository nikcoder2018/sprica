<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Ticket as TicketResource;
use App\Ticket;
use App\TicketType;
use App\User;
use App\Project;
use App\ProjectMember;
use Gate;
use DataTables;
class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //abort_unless(Gate::any(['full_access','tickets_show']), 404);

        $data['title'] = 'Tickets';
        $data['projects'] = Project::all();
        $data['types'] = TicketType::orderBy('id', 'ASC')->get();
        $data['users'] = User::all();

        return view('contents.tickets', $data);
    }

    public function all(){
        $tickets = Ticket::with('requester')->get();
        return DataTables::of(TicketResource::collection($tickets))->toJson();
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
        $createTicket = Ticket::create([
            'requester_user_id' => $request->requester_user_id,
            'project_id' => $request->project,
            'type' => $request->type,
            'priority' => $request->priority,
            'subject' => $request->subject, 
            'description' => $request->description,
            'status' => 'open'
        ]);

        if($createTicket)
            return response()->json(array('success' => true, 'msg' => 'Ticket Created'));
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
    public function edit(Ticket $ticket)
    {
        return response()->json($ticket);
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
        $ticket = Ticket::find($request->id);
        $ticket->requester_user_id = $request->requester_user_id;
        $ticket->project_id = $request->project;
        $ticket->type = $request->type;
        $ticket->priority = $request->priority;
        $ticket->subject = $request->subject;
        $ticket->description = $request->description;
        $ticket->status = $request->status;
        $ticket->save();

        if($ticket)
            return response()->json(array('success' => true, 'msg' => 'Ticket Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        if($ticket){
            return response()->json(array('success' => true, 'msg' => 'Ticket Deleted!'));
        }
    }
}
