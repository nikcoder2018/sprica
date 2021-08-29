<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Controlling as ControllingResource;
use App\User;
use App\Timelog;

use DataTables;
class ControllingController extends Controller
{
    public function index(){
        $data['title'] = 'Controlling';
        $data['users'] = User::where('status', 1)->get()->append('totalConfirmedTimelog');

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
