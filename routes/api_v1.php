<?php
/**
 * Created by PhpStorm.
 * User: sithira
 * Date: 2019-03-06
 * Time: 14:47
 */

Route::group(['prefix' => 'admin'], function() {

    Route::apiResource('/users', 'Api\v1\admin\UserController');

    Route::apiResource('/users/schedules', 'Api\v1\admin\CheckupScheduleController');

});

Route::group(['prefix' => 'mobile'], function() {

    Route::get('/user', 'Api\v1\mobile\MobileApiController@getInfo');
    Route::get('/user/checkups', 'Api\v1\mobile\MobileApiController@getCheckups');
    Route::post('/user/checkups/', 'Api\v1\mobile\MobileApiController@requestCheckup');

});
