<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Employee ;
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

Route::middleware('api')->post('/add', function (Request $request) {
    return response()->json(['data'=>Employee::paginate(3)]) ;
});
Route::group(['middleware' => ['api'], 'namespace' => 'api'], function () {

Route::get('/search','search_employee_Controller@search_employee');
Route::get('/employee/{id?}','search_employee_Controller@get_employee_data');

});
