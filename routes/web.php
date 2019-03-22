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

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social-login');
Route::get('oauth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Todo - remove -> mail test-route
Route::get('test-mailable', function() {
   return new \App\Mail\Users\Registration\VerifyEmail(\App\Models\User::find(1));
});
