<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watches;
use App\Role;
use Carbon\Carbon;
use Auth;
class DashboardController extends Controller
{
    public function index(){
        $data['page_title'] = 'Dashboard';
        $data['this_month'] = Watches::where('Tarih', '>=', Carbon::today()->firstOfMonth()->toDateString())
                                     ->where('Tarih', '<=', Carbon::today()->endOfMonth()->toDateString())
                                     ->where('UyeID', Auth()->user()->id)
                                     ->sum('Saat');

        $data['total'] =    Watches::where('UyeID', Auth()->user()->id)->sum('Saat');                         
        return view('contents.dashboard', $data);
    }
}
