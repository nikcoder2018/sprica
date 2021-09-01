<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Controlling as ControllingResource;
use App\User;
use App\Project;
use App\Timelog;
use App\OtherExpenses;
use App\Tag;

use DataTables;
class ControllingController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'Controlling';
        $data['projects'] = Project::where('default', 0)->orderBy('created_at', 'ASC')->get();
        $data['tasks'] = auth()->user()->tasks;
        $data['expenses'] = OtherExpenses::all();
        $data['tags'] = Tag::where('for', 'timelog')->get();
        $data['users'] = User::where('status', 1)->get()->append('totalConfirmedTimelog');
        $default = $request->user()->settings()->where('key', 'default_start_time')->first();
        
        if ($default) {
            $data['default_start_time'] = $default->value;
        } else {
            $data['default_start_time'] = '07:00';
        }

        return view('contents.controlling', $data);
    }

    public function data(Request $request){
        $timelogs = Timelog::with(['tags','project', 'user', 'logged_from']);

        if($request->user_id){
            $timelogs = $timelogs->where('user_id', $request->user_id);
        }
        if($request->date_from){
            $timelogs = $timelogs->whereDate('start_date', '>=', $request->date_from);
        }
        if($request->date_to){
            $timelogs = $timelogs->whereDate('start_date', '<=', $request->date_to);
        }
        if($request->confirmation >= 0 && $request->confirmation != ''){
            $timelogs = $timelogs->where('confirmation', $request->confirmation);
        }

        $timelogs = $timelogs->get();

        return DataTables::of(ControllingResource::collection($timelogs))->toJson();

    }
}
