<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class TimeTrackingController extends Controller
{
    public function index(){
        $data['page_title'] = 'Time Sheet';
        $data['projects'] = Project::orderBy('projeKODU', 'ASC')->get();
        $data['codes'] = Code::all();

        return view('contents.timetracking', $data);
    }
}
