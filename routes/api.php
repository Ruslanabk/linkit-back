<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\User;
use App\Link;

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

Route::post('/login', 'UserController@authenticate')->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/links', 'LinkController@index');
    Route::post('/links', 'LinkController@store');
    Route::delete('/links/{id}/', 'LinkController@destroy');
});
