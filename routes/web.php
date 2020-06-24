<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\User;
use App\Link;

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
    return view('welcome');
});

Route::get('/{user}/{route}', function ($user, $route, Request $request){
    $user = User::where('username', $user)->first();
    $link = Link::where('user_id', $user->id)->where('route', $route)->first();

    return redirect()->away($link->url); 
});