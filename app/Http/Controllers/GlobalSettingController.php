<?php

namespace App\Http\Controllers;

use App\GlobalSetting;
use Illuminate\Http\Request;

class GlobalSettingController extends Controller
{
    public function index()
    {
        return GlobalSetting::all();
    }

    public function get(Request $request)
    {
        return GlobalSetting::get($request->input('key', ''));
    }

    public function set(Request $request)
    {
        GlobalSetting::set($request->input('key', ''), $request->input('value', ''));
        return response('', 204);
    }
}
