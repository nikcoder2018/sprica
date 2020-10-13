<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['news'] = News::all();
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
        $createNews = News::create([
            'heading' => $request->heading,
            'to' => $request->to,
            'details' => $request->details
        ]);

        if($createNews)
            return response()->json(array('success' => true, 'msg' => 'News Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $news = News::find($request->id);
        return response()->json($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $news = News::find($request->id);
        $news->heading = $request->heading;
        $news->to = $request->to;
        $news->details = $request->details;
        $news->save();

        if($news)
            return response()->json(array('success' => true, 'msg' => 'News Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $news = News::find($request->id);
        $news->delete();

        if($news){
            return response()->json(array('success' => true, 'msg' => 'News Deleted!'));
        }
    }
}
