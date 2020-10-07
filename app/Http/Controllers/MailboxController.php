<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailBox;
class MailboxController extends Controller
{
    public function index(){
        $data['mailbox'] = MailBox::where('draft', 0)->get();

        return view('admin.contents.mailbox', $data);
    }

    public function compose(){
        return view('admin.contents.mailbox_compose');
    }

    public function send(Request $request){
        $mailbox = new MailBox;
        $mailbox->to = $request->to;
        $mailbox->subject = $request->subject;
        $mailbox->content = $request->content;
        $mailbox->save();
    }

    public function read($id){
        $data['email'] = MailBox::find($id);

        return view('admin.contents.mailbox_read', $data);
    }

    public function drafts(){

    }

    public function templates(){

    }
}
