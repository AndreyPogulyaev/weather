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
    return view('welcome');
});

RpcRouter::on('weather.getByDate', 'App\\Http\\Controllers\\RpcController@getByDate');
RpcRouter::on('weather.getHistory', 'App\\Http\\Controllers\\RpcController@getHistory');

Route::post('/rpc', 'AvtoDev\\JsonRpc\\Http\\Controllers\\RpcController');