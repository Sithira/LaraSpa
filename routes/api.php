<?php

use Illuminate\Http\Request;

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

Route::get('/', 'Api\PublicEndPointController@welcome')
    ->name('welcome');

Route::get('/ping', function() {
    return "pong";
})->name('ping');

Route::get('/version', 'Api\PublicEndPointController@version')
    ->name('version');

Route::get('/providers', 'Api\PublicEndPointController@authProviders')
    ->name('providers');

Route::post('/register', 'Auth\RegisterController@register');

/*
|--------------------------------------------------------------------------
| API Routes For Versions
|--------------------------------------------------------------------------
| Dynamically load the apis to the application on loading.
|
*/
Route::group([
    'middleware' => ['api.v:1', 'auth:api'],
    'prefix'     => 'v1',
], function ($router) {
    require base_path('routes/api_v1.php');
});
