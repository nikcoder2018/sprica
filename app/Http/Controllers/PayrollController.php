<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Payroll as PayrollResource;
use App\User;
use App\Timelog;
use App\RemainingPayment;

use Carbon\Carbon;

use DataTables;
class PayrollController extends Controller
{
    public function index(){
        $data['title'] = 'Payroll';
        $data['users'] = User::where('status', 1)->get();

        return view('contents.payroll', $data);
    }
    public function data(Request $request){
        $timelogs = Timelog::with(['project', 'expenses']);

        if($request->user_id){
            $timelogs = $timelogs->where('user_id', $request->user_id);
        }

        if($request->year && $request->month){
            $date = Carbon::create($request->year,$request->month);
            $timelogs = $timelogs->whereBetween('start_date', [$date->startOfMonth()->toDateString(),$date->endOfMonth()->toDateString()]);
        }

        $timelogs = $timelogs->get();

        return DataTables::of(PayrollResource::collection($timelogs))->toJson();
    }
    
    public function profile(Request $request){
        if($request->user_id){
            $user = User::where('id', $request->user_id)->first()->append('dateRegistered');

            $vacation = Timelog::whereYear('start_date', '>=', $request->year)->where('confirmation', 1)->where('vacation', 1)->where('user_id', $request->user_id)->count();
            $date = Carbon::create($request->year,$request->month);

            $currentmonth_dayoff = Timelog::whereBetween('start_date', [$date->startOfMonth()->toDateString(),$date->endOfMonth()->toDateString()])->where('confirmation', 1)->where('vacation', 1)->where('user_id', $request->user_id)->count();
            $currentyear_dayoff = Timelog::whereYear('start_date', $request->year)->where('confirmation', 1)->where('vacation', 1)->where('user_id', $request->user_id)->count();
            
            $data['profile'] = array(
                'avatar' => $user->avatar,
                'name' => $user->name,
                'number' => $user->number,
                'department' => $user->department,
                'hour_fee' => $user->hour_fee,
                'tax_status' => $user->tax_status,
                'dateRegistered' => $user->dateRegistered
            );
            $data['vacation'] = array(
                'day_off' => $user->day_off,
                'remaining' => $user->day_off-$vacation,
                'current_month' => $currentmonth_dayoff
            );
            $data['illness'] = array(
                'current_month' => $currentmonth_dayoff,
                'curreny_year' => $currentyear_dayoff
            );
            $data['paidhours'] = array(
                'current_month' => Timelog::whereBetween('start_date', [$date->startOfMonth()->toDateString(),$date->endOfMonth()->toDateString()])->where('confirmation', 1)->where('user_id', $request->user_id)->sum('duration'),
                'paid_out' => RemainingPayment::where('UyeID', $request->user_id)->sum('KalanODEME'),
                'total_hours' => Timelog::where('user_id', $request->user_id)->where('confirmation', 1)->sum('duration') - RemainingPayment::where('UyeID', $request->user_id)->sum('KalanODEME')
            );
            $data['kug'] = array(
                'current_month' => Timelog::whereBetween('start_date', [$date->startOfMonth()->toDateString(),$date->endOfMonth()->toDateString()])->where('confirmation', 1)->where('project_id', 10)->where('user_id', $request->user_id)->sum('duration')
            );
            return response()->json($data);
        }
    }
}
