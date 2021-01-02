<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        $request->user()->update($request->all());
        return response('', 204);
    }

    public function password(Request $request)
    {
        $data = $request->only(['old', 'new']);

        $user = $request->user();
        if (!Hash::check($data['old'], $user->password)) {
            return response(['message' => 'Password is incorrect.'], 403);
        }
        $user->password = Hash::make($data['new']);
        $user->save();
        return response('', 204);
    }
}
