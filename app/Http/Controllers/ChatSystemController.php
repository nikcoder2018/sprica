<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatSystemController extends Controller
{
    public function index(){
        $data['page_title'] = 'Messages';
        $data['sender'] = null;
        return view('contents.messages', $data);
    }

    public function index2($sender){
        $data['page_title'] = 'Messages';
        $data['sender'] = $sender;
        return view('contents.messages', $data);
    }
}
