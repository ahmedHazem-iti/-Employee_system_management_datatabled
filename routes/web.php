<?php

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {


    Route::get('/', function () {
return view('admin.employee.base');    });

    Route::resource('employee', 'EmployeeController');
    Route::post('employee/update/{employee}', 'EmployeeController@update')->name('sample.update');
    Route::get('employee/destroy/{id}', 'EmployeeController@destroy');
    Route::get('employee/destroysuper/{id}', 'EmployeeController@destroysuper')->middleware('superadmin')->name('deleteemployee');;

    Route::get('users', 'UserController@index')->middleware('superadmin')->name('supercontrol');
    Route::get('changeStatus', 'UserController@changeStatus')->middleware('superadmin');
    Route::get('allemployee', 'UserController@allemployee')->middleware('superadmin')->name('allemployee');




});
