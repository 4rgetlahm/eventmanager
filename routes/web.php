<?php

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

Route::get('/', 'Control@index');
Route::get('/dashboard', 'Restricted@index');
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/dashboard/create', 'Restricted@dashboard_createEvent');
Route::get('/dashboard/edit', 'Restricted@dashboard_editEvent');
Route::get('/dashboard/statistics', 'Restricted@dashboard_statistics');
Route::get('/dashboard/users', 'Restricted@dashboard_usermanagement');

//admin panel
Route::post('/events/register', 'Datacontroller@addRegistration');
Route::post('/admin/edituser', 'Datacontroller@editUser');
Route::post('/admin/createvent', 'Eventcontroller@createEvent');
Route::post('/admin/editevent', 'Eventcontroller@editEvent');

//verification
Route::get('/verification/{token}', 'Restricted@verifyUser');
Route::get('/confirmation/resend/{id}', 'Restricted@resendVerification');

//timer
Route::get('/events/alert', 'Alertcontroller@tick')->middleware('localhost');
