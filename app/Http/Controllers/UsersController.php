<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStore as RequestUserStore;
use App\Http\Resources\User as ResourceUser;
use App\User;
use App\Role;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Users';
        $data['roles'] = Role::all();
        return view('admin.contents.users',$data);
    }

    //API
    public function all(){
        $users = User::where('status', 1)->with('roles')->get();
        return ResourceUser::collection($users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create User';
        return view('admin.contents.users_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUserStore $request)
    {
        $user = User::create($request->only(['username','name','email','password']));
        $user->roles()->sync($request->input('roles', []));
        if($user)
            return response()->json(array('success' => true, 'msg' => 'New user created'));
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
    public function edit(User $role)
    {
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        if($user)
            return response()->json(array('success' => true, 'msg' => 'User updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'User Deleted'));
    }
}
