<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeTrackingController extends Controller
{
    public function index(){
        $data['page_title'] = 'Time Sheet';
        return view('content.timetracking', $data);
    }
}
