<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Language;
use App\Watches;
use App\RemainingPayment;
use App\Members;

use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function show(){
        $data['page_title'] = Language::settings('_Isci_Paneli_DashBoard');

        $data['text'] = array(
            'hours_worked_today' => Language::settings('_Bugun_Calisilan_Saatler'),
            'general_time' => Language::settings('Genel_Saat'),
            'this_month' => Language::settings('_Bu_Ay_Ne_Kadar_Calismis'),
            'this_year' => Language::settings('_Bu_Yil_Ne_Kadar_Calismis'),
            'hours' => Language::settings('_DashBoard_Odenmemis_Saatler'),
            'vacation' => Language::settings('_DashBoard_Kalan_Izın_Gunu'),
            'tag' => Language::settings('Genel_Gun')
        );
        
        $data['hours_worked_today'] = Watches::where('Tarih', Carbon::today()->toDateString())->sum('Saat');
        $data['this_month'] = Watches::where('Tarih', '>=', Carbon::today()->firstOfMonth()->toDateString())
                                     ->where('Tarih', '<=', Carbon::today()->endOfMonth()->toDateString())
                                     ->sum('Saat');
        $data['this_year'] = Watches::whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        $data['hours'] = Watches::where('Onay', 1)->sum('Saat') - RemainingPayment::sum('KalanODEME');
        $data['vacation'] = Members::sum('day_off') - Watches::where('ProjeID', 1)->whereYear('Tarih', '>=', Carbon::now()->year)->count();
        
        for($i = 1; $i <= 12; $i++){
            $current_month_str = strtolower(Carbon::create(Carbon::now()->year, $i,1)->format('M'));

            $data['project'][$current_month_str] = Watches::whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
            $data['project'][$current_month_str.'_proj_8'] = Watches::where('ProjeID', 8)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
            $data['project'][$current_month_str.'_proj_1'] = Watches::where('ProjeID', 1)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
            $data['project'][$current_month_str.'_proj_2'] = Watches::where('ProjeID', 2)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
            $data['project'][$current_month_str.'_proj_10'] = Watches::where('ProjeID', 10)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
            $data['project'][$current_month_str.'_proj_11'] = Watches::where('ProjeID', 11)->whereBetween('Tarih',[Carbon::create(Carbon::now()->year, $i,1),Carbon::create(Carbon::now()->year, $i,1)->endOfMonth()->toDateString()])->sum('Saat');
        }

        $data['project']['total']['proj_0'] = Watches::whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        $data['project']['total']['proj_8'] = Watches::where('ProjeID', 8)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        $data['project']['total']['proj_1'] = Watches::where('ProjeID', 1)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        $data['project']['total']['proj_2'] = Watches::where('ProjeID', 2)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        $data['project']['total']['proj_10'] = Watches::where('ProjeID', 10)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        $data['project']['total']['proj_11'] = Watches::where('ProjeID', 11)->whereYear('Tarih', Carbon::now()->year)->sum('Saat');
        
        #return response()->json($data);

        return view('admin.contents.dashboard', $data);
    }
}
