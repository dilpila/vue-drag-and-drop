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

Route::get('task','TaskController@index')->name('get.task');
Route::post('task/create','TaskController@store')->name('get.create');
Route::get('task/delete/{id}','TaskController@destroy')->name('get.destroy');
Route::post('task/update/drag','TaskController@updateDrag')->name('get.update.drag');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
