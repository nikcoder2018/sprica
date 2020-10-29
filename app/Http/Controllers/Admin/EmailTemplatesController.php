<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\EmailTemplate;
class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["templates"] = EmailTemplate::all();
        $data['text_templates'] = EmailTemplate::select('id','body','title')->where('word_template', true)->get();

        #return response()->json($data);
        return view('admin.contents.emailtemplate', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required']
        ]);
        
        $word_template = false;

        if($request->input('word_template') == 'on'){
            $word_template = true;
        }


        $create = EmailTemplate::create([
            'title'  => $request->input('title'),
            'subject'  => $request->input('subject'),
            'body' => $request->input('body'),
            'word_template' => $word_template
        ]);

        if($create)
            return response()->json(array('success' => true, 'msg' => 'New Email Template Created', 'action' => 'add', 'template' => $create));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $data['template'] = EmailTemplate::find($id);
        return response()->json(array('data' => $data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required']
        ]);
        
        $embed_invoice = false;
        $word_template = false;

        if($request->input('word_template') == 'on'){
            $word_template = true;
        }

        $id = $request->input('id');

        $template = EmailTemplate::find($id);
        $template->title = $request->input('title');
        $template->subject = $request->input('subject');
        $template->body = $request->input('body');
        $template->word_template = $word_template;
        
        $template->save();


        if($template)
            return response()->json(array('success' => true, 'msg' => 'Template Updated', 'action' => 'edit', 'template' => $template));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $delete = EmailTemplate::find($id)->delete();

        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Template Deleted', 'id' => $id));
    }
}
