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
