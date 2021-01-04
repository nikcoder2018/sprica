<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PayrollTotal as PayrollTotalResource;
use App\User;
use App\Timelog;
use App\RemainingPayment;

use Carbon\Carbon;

use DataTables;

class PayrollTotalController extends Controller
{
    public function index(){
        $data['title'] = 'Payroll Total';
        $data['users'] = User::where('status', 1)->get();
        return view('contents.payroll-total', $data);
    }

    public function data(Request $request){
        $user = User::where('status', 1);
        
        if($request->user_id){
            $user = $user->where('id', $request->user_id);
        }

        if($request->year && $request->month == ''){
            $date = Carbon::create($request->year);
            $user = $user->whereBetween('created_at', [$date->startOfYear()->toDateString(),$date->endOfYear()->toDateString()]);
        }
        
        if($request->year && $request->month != ''){
            $date = Carbon::create($request->year, $request->month);
            $user = $user->whereBetween('created_at', [$date->startOfMonth()->toDateString(),$date->endOfMonth()->toDateString()]);
        }
        $user = $user->get()->append('dateRegistered');

        return DataTables::of(PayrollTotalResource::collection($user))->toJson();
    }
}
