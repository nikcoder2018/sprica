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
use App\Invoice;
use App\Ticket;

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
            case 'timelogs':
                $user_id = auth()->user()->id;
                $firstDayOfWeek = Carbon::today()->startOfWeek()->toDateString();
                $lastDayOfWeek = Carbon::today()->endOfWeek()->toDateString();
                $firstDayOfMonth = Carbon::today()->firstOfMonth()->toDateString();
                $lastDayOfMonth = Carbon::today()->endOfMonth()->toDateString();
                $today = Carbon::today()->toDateString();
                
                $data['month'] = Timelog::where('user_id', $user_id)->whereBetween('start_date', [$firstDayOfMonth, $lastDayOfMonth])->sum('duration');
                $data['week'] = Timelog::where('user_id', $user_id)->whereBetween('start_date', [$firstDayOfWeek, $lastDayOfWeek])->sum('duration');
                $data['today'] = Timelog::where('start_date', '>=', $today)->sum('duration');

                return response()->json($data);
                break;

            case 'statistics':
                $data['worked_hours'] = Timelog::sum('duration');
                $data['employees'] = Members::count();
                $data['unpaid_invoices'] = Invoice::where('status', 'unpaid')->count();
                $data['unresolved_tickets'] = Ticket::where('status', 'open')->count();

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
