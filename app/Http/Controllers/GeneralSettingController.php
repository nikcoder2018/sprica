<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->settings;
    }

    public function store(Request $request)
    {
        $data = $request->only(['key', 'value']);
        // if (!$this->valid($data)) {
        //     return response('', 422);
        // }
        $request->user()->setSetting($data['key'], $data['value']);
        return response('', 204);
    }

    protected function valid($data)
    {
        switch ($data['key']) {
            case 'theme-mode':
                return in_array($data['value'], ['dark', 'light', 'bordered']);
            case 'nav-layout':
                return in_array($data['value'], ['sticky', 'floating', 'static', 'hidden']);
            default:
                return true;
        }
    }
}
