<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatSystemController extends Controller
{
    public function index(){
        $data['page_title'] = 'Messages';
        
        return view('contents.messages', $data);
    }
}
