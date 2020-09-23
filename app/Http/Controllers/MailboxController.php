<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailboxController extends Controller
{
    public function index(){
        return view('admin.contents.mailbox');
    }

    public function compose(){
        return view('admin.contents.mailbox_compose');
    }


}
