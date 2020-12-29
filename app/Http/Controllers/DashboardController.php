<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Language;
use App\Helpers\System;

use App\Watches;
use App\RemainingPayment;
use App\Members;
use App\Timelog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('contents.dashboard', $data);
    }

    public function data(Request $request)
    {
        switch ($request->type) {
            case 'mytimelogs':
                $data['timelog_month'] = Timelog::where('user_id', auth()->user()->id)
                    ->whereBetween('start_date', [Carbon::today()->firstOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()])
                    ->sum('duration');
                $data['timelog_total'] = Timelog::where('user_id', auth()->user()->id)->sum('duration');
                $data['timelog_today'] = Timelog::where('start_date', '>=', Carbon::today()->toDateString())->sum('duration');

                return response()->json($data);
                break;

            case 'statistics':
                $data['timelog_month'] = Timelog::whereBetween('start_date', [Carbon::today()->firstOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()])
                    ->sum('duration');
                $data['timelog_year']  = Timelog::whereYear('start_date', Carbon::now()->year)->sum('duration');

                return response()->json($data);
                break;
        }


        // $data['hours'] = Watches::where('Onay', 1)->sum('Saat') - RemainingPayment::sum('KalanODEME');
        // $data['vacation'] = Members::sum('day_off') - Watches::where('ProjeID', 1)->whereYear('Tarih', '>=', Carbon::now()->year)->count();

        // for($i = 1; $i <= 12; $i++){
        //     $current_month_str = strtolower(Carbon::create(Carbon::now()->year, $i,1)->format('M'));

        //     $data['project'][$current_month_str] = Watches::whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        //     $data['project'][$current_month_str.'_proj_8'] = Watches::where('ProjeID', 8)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        //     $data['project'][$current_month_str.'_proj_1'] = Watches::where('ProjeID', 1)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        //     $data['project'][$current_month_str.'_proj_2'] = Watches::where('ProjeID', 2)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        //     $data['project'][$current_month_str.'_proj_10'] = Watches::where('ProjeID', 10)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        //     $data['project'][$current_month_str.'_proj_11'] = Watches::where('ProjeID', 11)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        // }

        // $data['project']['total']['proj_0'] = Watches::whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        // $data['project']['total']['proj_8'] = Watches::where('ProjeID', 8)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        // $data['project']['total']['proj_1'] = Watches::where('ProjeID', 1)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        // $data['project']['total']['proj_2'] = Watches::where('ProjeID', 2)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        // $data['project']['total']['proj_10'] = Watches::where('ProjeID', 10)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        // $data['project']['total']['proj_11'] = Watches::where('ProjeID', 11)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');


    }
}
