<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Project;
use App\OtherExpenses;
use App\Setting;
use App\Watches;
use App\Tag;
use App\Timelog;

use App\Http\Resources\Timelog as TimelogResource;
use DataTables;
use Carbon\Carbon;
class TimeTrackingController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'My Times';
        $data['projects'] = Project::where('default', 0)->orderBy('created_at', 'ASC')->get();
        $data['tasks'] = auth()->user()->tasks;
        $data['expenses'] = OtherExpenses::all();
        $data['tags'] = Tag::where('for', 'timelog')->get();
        $default = $request->user()->settings()->where('key', 'default_start_time')->first();
        
        if ($default) {
            $data['default_start_time'] = $default->value;
        } else {
            $data['default_start_time'] = '07:00';
        }
        return view('contents.timesheet', $data);
    }
    public function logs()
    {
        $timelogs = Timelog::with(['project','user'])->orderBy('start_date', 'DESC')->get();
        return DataTables::of(TimelogResource::collection($timelogs))->toJson();
    }

    public function edit($id)
    {
        $timelog = Timelog::with('tags')->where('id', $id)->first();
        return response()->json($timelog);
    }

    public function store(Request $request)
    {
        $end_date = $request->end_date !== null ? $request->end_date : $request->start_date;
        $end_time = $request->end_time !== null ? $request->end_time : Carbon::parse($request->start_date)->addHours($request->duration)->toTimeString();
        $timelog = Timelog::create([
            'user_id' => auth()->user()->id,
            'start_date' => $request->start_date,
            'start_time' => Carbon::parse($request->start_date)->toTimeString(),
            'end_date' => $end_date,
            'end_time' => $end_time,
            'duration' => $request->duration,
            'break' => $request->break,
            'project_id' => $request->project_id,
            'task_id' => $request->task_id,
            'expenses_id' => $request->expenses_id,
            'note' => $request->note
        ]);

        $timelog->tags()->sync($request->input('tags', []));

        if ($timelog)
            return response()->json(array('success' => true, 'msg' => 'Time saved successfully!'));
    }
    public function update(Request $request)
    {
        $end_date = $request->end_date !== null ? $request->end_date : $request->start_date;
        $end_time = $request->end_time !== null ? $request->end_time : Carbon::parse($request->start_date)->addHours($request->duration)->toTimeString();
        $timelog = Timelog::find($request->id);
        $timelog->start_date = $request->start_date;
        $timelog->start_time = Carbon::parse($request->start_date)->toTimeString();
        $timelog->end_date = $end_date;
        $timelog->end_time = $end_time;
        $timelog->duration = $request->duration;
        $timelog->break = $request->break;
        $timelog->project_id = $request->project_id;
        $timelog->expenses_id = $request->expenses_id;
        $timelog->task_id = $request->task_id;
        $timelog->note = $request->note;
        $timelog->save();

        if ($timelog)
            return response()->json(array('success' => true, 'msg' => 'Time updated successfully!'));
    }
    public function destroy($id)
    {
        $time = Timelog::find($id);
        $time->delete();

        if ($time) {
            return response()->json(array('success' => true, 'msg' => 'Timelog Deleted!'));
        }
    }
}
