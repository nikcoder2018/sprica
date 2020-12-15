<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\File;
class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Documents';

        $folders = Folder::with('files')->where('user_id', auth()->user()->id)->get();
        $data['file_manager_content'] = view('admin.render.file_manager_content', [
            'folders' => Folder::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get()->append('size'),
            'files' => File::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get()
        ])->render();
        
        return view('admin.contents.documents', $data);
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
        $folder = Folder::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name
        ]);
        $folders = Folder::with('files')->where('user_id', auth()->user()->id)->get();
        $view = view('admin.render.file_manager_content', [
            'folders' => Folder::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get()->append('size'),
            'files' => File::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get()
        ])->render();

        if($folder)
            return response()->json(array('success'=>true,'msg'=>'Folder Created', 'view'=>$view));
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
    public function edit($id)
    {
        $folder = Folder::find($id);
        return response()->json($folder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
