<?php
/**
 * Created by PhpStorm.
 * User: sithira
 * Date: 2019-03-06
 * Time: 14:47
 */

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Api\v1\UserController@index')->name('v1.users.index');
});
