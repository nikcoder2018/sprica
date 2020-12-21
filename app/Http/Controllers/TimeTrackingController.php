<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\OtherExpenses;
use App\Setting;
use App\Watches;
use App\Tag;
use App\Timelog;

use App\Http\Resources\Timelog as TimelogResource;
use DataTables;

class TimeTrackingController extends Controller
{
    public function index(){
        $data['title'] = 'My Times';
        $data['projects'] = Project::where('default', 0)->orderBy('created_at', 'ASC')->get();
        $data['expenses'] = OtherExpenses::all();
        $data['tags'] = Tag::where('for', 'timelog')->get();
        return view('contents.timesheet', $data);
    }
    public function logs(){
        $timelogs = Timelog::with('project')->where('user_id', auth()->user()->id)->orderBy('start_date', 'DESC')->get();
        return DataTables::of(TimelogResource::collection($timelogs))->toJson();
    }
    public function store(Request $request){
        $timelog = Timelog::create([
            'user_id' => auth()->user()->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $request->duration,
            'project_id' => $request->project_id,
            'expenses_id' => $request->expenses_id,
            'note' => $request->note
        ]);

        $timelog->tags()->sync($request->input('tags', []));

        if($timelog)
            return response()->json(array('success' => true, 'msg' => 'Time saved successfully!'));
    }

    public function destroy(Request $request){
        $time = Watches::find($request->SaatID);
        $time->delete();

        if($time){
            return response()->json(array('success' => true, 'msg' => 'Time Deleted!'));
        }
    }
}
