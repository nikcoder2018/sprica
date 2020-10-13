<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Ticket;
use App\TicketType;
use App\User;
class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tickets'] = Ticket::all();
        $data['types'] = TicketType::orderBy('id', 'ASC')->get();
        $data['users'] = User::all();
        return view('admin.contents.tickets', $data);
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
    public function edit(Request $request)
    {
        $ticketData = Ticket::find($request->id);
        return response()->json($ticketData);
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
    public function destroy(Request $request)
    {
        $ticket = Ticket::find($request->id);
        $ticket->delete();

        if($ticket){
            return response()->json(array('success' => true, 'msg' => 'Ticket Deleted!'));
        }
    }
}
