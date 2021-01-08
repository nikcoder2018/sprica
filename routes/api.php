<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects/calendar/resource', 'Admin\ProjectsController@calendar_resources');
Route::get('/projects/calendar/events', 'Admin\ProjectsController@calendar_events');

Route::get('/users/all', 'UsersController@all');
Route::get('/permissions/all', 'PermissionsController@all');
Route::get('/roles/all', 'RolesController@all');
Route::get('/projects/all', 'ProjectsController@all');