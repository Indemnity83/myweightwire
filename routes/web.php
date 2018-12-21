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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::view('/account/approval', 'auth.approval')->name('approval.notice');

Route::view('/privacy', 'privacy');
Route::view('/terms', 'terms');

Route::middleware(['auth', 'verified', 'approved'])
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });