<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/messages', 'ChatSystemController@index')->name('messages')->middleware('auth');
Route::get('/messages/{sender}', 'ChatSystemController@index2')->name('messages.hasSender')->middleware('auth');
Route::get('/timesheet', 'TimeTrackingController@index')->name('timetracking')->middleware('auth');
Route::post('/timesheet/store', 'TimeTrackingController@store')->name('timetracking.store')->middleware('auth');
Route::get('/timesheet/{id}/delete', 'TimeTrackingController@destroy')->name('timetracking.destroy')->middleware('auth');
Route::get('/timesheet/logs', 'TimeTrackingController@logs');
Route::get('/timesheet/edit/{id}', 'TimeTrackingController@edit')->name('timetracking.edit');
Route::post('/timesheet/update', 'TimeTrackingController@update')->name('timetracking.update');

Route::post('notices/show', 'NoticesController@show')->name('notices.show');


Route::group(['middleware' => ['auth', 'checkstatus']], function () {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('/users', 'UsersController');
    Route::post('/users/{id}', 'UsersController@update')->name('users.update');
    Route::get('/users/{id}/delete', 'UsersController@destroy')->name('users.delete');

    Route::resource('/roles', 'RolesController', ['except' => ['show', 'update', 'destroy']]);
    Route::post('/roles/{id}', 'RolesController@update')->name('roles.update');
    Route::get('/roles/{id}/delete', 'RolesController@destroy')->name('roles.delete');

    Route::resource('/permissions', 'PermissionsController', ['except' => ['show', 'update', 'destroy']]);
    Route::post('/permissions/update', 'PermissionsController@update')->name('permissions.update');
    Route::get('/permissions/{id}/delete', 'PermissionsController@destroy')->name('permissions.delete');

    Route::resource('todo', 'TodosController');
    Route::resource('documents', 'DocumentsController');

    Route::get('/control', 'Admin\HRController@control')->name('admin.hr-control');
    Route::get('/control/wage', 'Admin\HRController@wages')->name('admin.hr-wage');
    Route::get('/control/wage/total', 'Admin\HRController@wages_total')->name('admin.hr-wages-total');
    Route::post('/control/wage/advance', 'Admin\HRController@wages_advance_store')->name('admin.hr-wages-advance');
    Route::post('/control/add', 'Admin\HRController@control_addtime')->name('admin.hr-control.add');
    Route::post('/control/edit', 'Admin\HRController@control_edittime')->name('admin.hr-control.edit');
    Route::post('/control/update', 'Admin\HRController@control_updatetime')->name('admin.hr-control.update');
    Route::post('/control/delete', 'Admin\HRController@control_deletetime')->name('admin.hr-control.delete');
    Route::post('/control/confirmall', 'Admin\HRController@control_confirmall')->name('admin.hr-control.confirmall');

    Route::get('controlling', 'ControllingController@index')->name('controlling.index');
    Route::get('controlling/data', 'ControllingController@data');
    Route::get('payroll', 'PayrollController@index')->name('payroll.index');
    Route::get('payroll/data', 'PayrollController@data');
    Route::get('payroll/profile', 'PayrollController@profile');
    Route::get('payroll-total', 'PayrollTotalController@index')->name('payrolltotal.index');
    Route::get('payroll-total/data', 'PayrollTotalController@data');

    Route::resource('advances', 'AdvancesController', ['except' => ['show', 'update', 'destroy']]);
    Route::get('advances/all', 'AdvancesController@all');
    Route::post('advances/update', 'AdvancesController@update')->name('advances.update');
    Route::get('advances/{id}/delete', 'AdvancesController@destroy')->name('advances.delete');

    Route::prefix('hr')->group(function(){
        Route::resource('holidays', 'HolidaysController', ['except' => ['show']]);
        Route::get('holidays/events', 'HolidaysController@events');
    });

    Route::resource('projects','ProjectsController', ['except' => ['show', 'update']]);
    Route::post('projects/update', 'ProjectsController@update')->name('projects.update');
    Route::get('projects/{id}/details', 'ProjectsController@show')->name('projects.details');
  
    Route::post('/projects/add-member', 'Admin\ProjectsController@add_member')->name('admin.projects.add-member');
    Route::post('/projects/remove-member', 'Admin\ProjectsController@remove_member')->name('admin.projects.remove-member');

    Route::get('/projects/calendar', 'Admin\ProjectsController@calendar')->name('admin.projects.calendar');

    Route::get('/employees', 'Admin\EmployeesController@list')->name('admin.employees');
    Route::get('/employees/details/{id}', 'Admin\EmployeesController@details')->name('admin.employees.details');
    Route::post('/employees/store', 'Admin\EmployeesController@store')->name('admin.employees.store');
    Route::post('/employees/edit', 'Admin\EmployeesController@edit')->name('admin.employees.edit');
    Route::post('/employees/update', 'Admin\EmployeesController@update')->name('admin.employees.update');
    Route::post('/employees/filters', 'Admin\EmployeesController@filters')->name('admin.employees.filter');
    Route::post('/employees/delete', 'Admin\EmployeesController@destroy')->name('admin.employees.destroy');

    Route::resource('holidays', 'HolidaysController');
    Route::resource('leave', 'LeavesController');
    Route::resource('leavetype', 'LeaveTypesController');

    Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
    Route::post('/profile/update', 'Admin\ProfileController@update')->name('admin.profile.update');

    Route::get('/general_settings', 'Admin\SettingsController@general_settings')->name('admin.settings.general');
    Route::post('/general_settings/update', 'Admin\SettingsController@general_settings_update')->name('admin.settings.general-update');

    Route::get('/language_settings/{action}', 'Admin\SettingsController@language_settings')->name('admin.settings.language');
    Route::post('/language_settings/update', 'Admin\SettingsController@language_settings_update')->name('admin.settings.language-update');

    Route::get('/code_settings', 'Admin\SettingsController@code_settings')->name('admin.settings.code');
    Route::post('/code_settings/store', 'Admin\SettingsController@code_settings_store')->name('admin.settings.code-add');

    Route::get('/vacationdays_settings', 'Admin\SettingsController@vacationdays_settings')->name('admin.settings.vacationdays');
    Route::post('/vacationdays_settings/store', 'Admin\SettingsController@vacationdays_settings_store')->name('admin.settings.vacationdays-add');
    Route::post('/vacationdays_settings/edit', 'Admin\SettingsController@vacationdays_settings_edit')->name('admin.settings.vacationdays-edit');
    Route::post('/vacationdays_settings/update', 'Admin\SettingsController@vacationdays_settings_update')->name('admin.settings.vacationdays-update');
    Route::post('/vacationdays_settings/delete', 'Admin\SettingsController@vacationdays_settings_delete')->name('admin.settings.vacationdays-delete');

    Route::get('/mailbox', 'MailboxController@index')->name('admin.mailbox');

    Route::get('/mailbox', 'MailboxController@index')->name('mailbox');
    Route::get('/mailbox/compose', 'MailboxController@compose')->name('mailbox.compose');
    Route::post('/mailbox/compose', 'MailboxController@send')->name('mailbox.compose');
    Route::get('/mailbox/read/{id}', 'MailboxController@read')->name('mailbox.read');
    Route::get('/mailbox/sent', 'MailboxController@sent')->name('mailbox.sent');
    Route::post('/mailbox/unsent', 'MailboxController@unsent')->name('mailbox.unsent');
    Route::get('/mailbox/drafts', 'MailboxController@drafts')->name('mailbox.drafts');
    Route::get('/mailbox/templates', 'MailboxController@templates')->name('mailbox.templates');

    Route::resource('tasks', 'TasksController', ['except' => ['edit', 'update', 'destroy']]);
    Route::post('task/edit', 'TasksController@edit')->name('tasks.edit');
    Route::post('task/update', 'TasksController@update')->name('tasks.update');
    Route::get('task/{id}/destroy', 'TasksController@destroy')->name('tasks.destroy');

    Route::resource('emailtemplates', 'Admin\EmailTemplatesController', ['except' => ['edit', 'update', 'destroy']]);
    Route::post('emailtemplates/edit', 'Admin\EmailTemplatesController@edit')->name('emailtemplates.edit');
    Route::post('emailtemplates/update', 'Admin\EmailTemplatesController@update')->name('emailtemplates.update');
    Route::post('emailtemplates/destroy', 'Admin\EmailTemplatesController@destroy')->name('emailtemplates.destroy');

    Route::resource('emailtriggers', 'Admin\EmailTriggersController', ['except' => ['edit', 'update', 'destroy']]);
    Route::post('emailtriggers/edit', 'Admin\EmailTriggersController@edit')->name('emailtriggers.edit');
    Route::post('emailtriggers/update', 'Admin\EmailTriggersController@update')->name('emailtriggers.update');
    Route::post('emailtriggers/destroy', 'Admin\EmailTriggersController@destroy')->name('emailtriggers.destroy');

    Route::resource('emailactions', 'Admin\EmailActionsController', ['except' => ['edit', 'update', 'destroy']]);
    Route::post('emailactions/edit', 'Admin\EmailActionsController@edit')->name('emailactions.edit');
    Route::post('emailactions/update', 'Admin\EmailActionsController@update')->name('emailactions.update');
    Route::post('emailactions/destroy', 'Admin\EmailActionsController@destroy')->name('emailactions.destroy');

    Route::resource('tickets', 'TicketsController', ['except' => ['update']]);
    Route::post('tickets/update', 'TicketsController@update')->name('tickets.update');

    Route::resource('tickettypes', 'TicketsTypeController', ['except' => ['update', 'destroy']]);
    Route::post('tickettypes/edit', 'TicketsTypeController@edit')->name('tickettypes.edit');
    Route::post('tickettypes/update', 'TicketsTypeController@update')->name('tickettypes.update');
    Route::post('tickettypes/destroy', 'TicketsTypeController@destroy')->name('tickettypes.destroy');


    Route::resource('vehicles', 'Admin\VehiclesController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::post('vehicles/edit', 'Admin\VehiclesController@edit')->name('vehicles.edit');
    Route::post('vehicles/update', 'Admin\VehiclesController@update')->name('vehicles.update');
    Route::post('vehicles/destroy', 'Admin\VehiclesController@destroy')->name('vehicles.destroy');
    Route::post('vehicles/setdriver', 'Admin\VehiclesController@setdriver')->name('vehicles.setdriver');
    Route::get('vehicles/{id}/details', 'Admin\VehiclesController@show')->name('vehicles.show');

    Route::resource('vehiclegroups', 'Admin\VehicleGroupsController', ['except' => ['edit', 'update', 'destroy']]);
    Route::post('vehiclegroups/edit', 'Admin\VehicleGroupsController@edit')->name('vehiclegroups.edit');
    Route::post('vehiclegroups/update', 'Admin\VehicleGroupsController@update')->name('vehiclegroups.update');
    Route::post('vehiclegroups/destroy', 'Admin\VehicleGroupsController@destroy')->name('vehiclegroups.destroy');

    Route::resource('fuels', 'Admin\FuelsController', ['except' => ['edit', 'update', 'destroy']]);
    Route::post('fuels/edit', 'Admin\FuelsController@edit')->name('fuels.edit');
    Route::post('fuels/update', 'Admin\FuelsController@update')->name('fuels.update');
    Route::post('fuels/destroy', 'Admin\FuelsController@destroy')->name('fuels.destroy');

    Route::resource('notices', 'NoticesController', ['except' => ['show', 'update']]);
    Route::post('notices/update', 'NoticesController@update')->name('notices.update');
 
    Route::get('/user/settings', 'GeneralSettingController@index')->name('user.settings.index');
    Route::post('/user/settings', 'GeneralSettingController@store')->name('user.settings.store');

    Route::get('/user/profile', 'ProfileController@index')->name('profile');
    Route::post('/user/profile', 'ProfileController@update')->name('profile.update');
    Route::post('/user/profile/password', 'ProfileController@password')->name('profile.change.password');

    Route::get('/times', 'TimeController@index')->name('times.index');
    Route::get('/times/show', 'TimeController@show')->name('times.show');
    Route::post('/times', 'TimeController@store')->name('times.store');
    Route::post('/times/update', 'TimeController@update')->name('times.update');
    Route::post('/times/delete', 'TimeController@destroy')->name('times.destroy');
    Route::get('/times/search', 'TimeController@search')->name('times.search');

    Route::get('/global-settings', 'GlobalSettingController@index')->name('global-settings.index');
    Route::get('/global-settings/get', 'GlobalSettingController@get')->name('global-settings.get');
    Route::post('/global-settings/set', 'GlobalSettingController@set')->name('global-settings.set');

    Route::prefix('/finance')->group(function () {
        Route::get('/expenses', 'ExpenseController@view')->name('finance.expenses.index');
        Route::get('/invoices', 'InvoiceController@view')->name('finance.invoices.index');
        Route::get('/estimates', 'EstimateController@view')->name('finance.estimates.index');
    });
});
