<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Notice as ResourceNotice;
use App\Notice;
use App\NoticeRead;

use DataTables;
class NoticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'News';
        return view('contents.notices', $data);
    }

    public function all(){
        $notices = Notice::all();
        return DataTables::of(ResourceNotice::collection($notices))->toJson();
    }

    public function reads(){
        $readers = NoticeRead::with(['notice', 'user'])->get();
        return DataTables::of($readers)->toJson();
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
        $createNotice = Notice::create([
            'heading' => $request->heading,
            'details' => $request->details,
            'to' => $request->to
        ]); 
        
        if($createNotice)
        return response()->json(array('success' => true, 'msg' => 'Notice successfully saved.', 'notice' => $createNotice));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $notice = Notice::find($request->id);
        $is_exists = NoticeRead::where('notice_id',$notice->id)->where('user_id', auth()->user()->id)->exists();
        if(!$is_exists){
            NoticeRead::create([
                'notice_id' => $notice->id,
                'user_id' => auth()->user()->id
            ]);
        }

        return response()->json($notice);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        return response()->json($notice);
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
        $notice = Notice::find($request->id);
        $notice->heading = $request->heading;
        $notice->details = $request->details;
        $notice->to = $request->to;
        $notice->save();
        
        if($notice)
        return response()->json(array('success' => true, 'msg' => 'Notice successfully saved.', 'notice' => $notice));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Notice::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Notice deleted.', 'id' => $id));
    }
}
