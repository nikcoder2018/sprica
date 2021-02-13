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

Route::get('dashboard/data', 'DashboardController@data');
Route::get('projects/calendar/resource', 'Admin\ProjectsController@calendar_resources');
Route::get('projects/calendar/events', 'Admin\ProjectsController@calendar_events');

Route::get('users/all', 'UsersController@all');
Route::get('permissions/all', 'PermissionsController@all');
Route::get('roles/all', 'RolesController@all');
Route::get('projects/all', 'ProjectsController@all');
Route::get('tasks/all', 'TasksController@all');
Route::get('tickets/all', 'TicketsController@all');
Route::get('notices/all', 'NoticesController@all');
Route::get('notices/reads', 'NoticesController@reads');

Route::get('finance/estimates/generate', 'EstimateController@generate');
Route::get('finance/invoices/generate', 'InvoiceController@generate');
Route::apiResource('finance/expenses/categories', 'ExpenseCategoryController');
Route::apiResource('finance/expenses', 'ExpenseController');
Route::apiResource('finance/invoices', 'InvoiceController');
Route::apiResource('finance/estimates', 'EstimateController');

Route::post('projects/{id}/details', 'ProjectsController@details');
