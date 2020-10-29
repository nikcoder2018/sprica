<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\EmailTrigger;
use App\EmailAction;
use App\EmailTemplate;
use App\EmailCommand;
class EmailTriggersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['triggers'] = EmailTrigger::with(['template','action'])->get();
        $data['actions'] = EmailAction::all();
        $data['templates'] = EmailTemplate::all();
        return view('admin.contents.emailtrigger', $data);
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
        $createTrigger = EmailTrigger::create([
            'template_id' => $request->template_id,
            'action_id' => $request->action_id
        ]);

        if($createTrigger)
            return response()->json(array('success' => true, 'msg' => 'Trigger Created.', 'trigger' => EmailTrigger::with(['action','template'])->where('id', $createTrigger->id)->first()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $triggerData = EmailTrigger::find($request->id);
        return response()->json($triggerData);
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
        $trigger = EmailTrigger::find($request->id);
        $trigger->template_id = $request->template_id;
        $trigger->action_id = $request->action_id;
        $trigger->save();

        if($trigger)
            return response()->json(array('success' => true, 'msg' => 'Triger Updated.', 'trigger' => EmailTrigger::with(['action','template'])->where('id', $trigger->id)->first()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = EmailTrigger::find($request->id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Trigger Deleted', 'id' => $request->id));
    }
}
