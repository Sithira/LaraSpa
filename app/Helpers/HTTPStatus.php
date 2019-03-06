<?php
/**
 * Created by PhpStorm.
 * User: sithira
 * Date: 2019-03-03
 * Time: 21:49
 */

namespace App\Helpers;


class HTTPStatus
{
    # Response Statuses

    const OK = "OK";

    const SUCCESS = "SUCCESS";

    const ERROR = "ERROR";

    # Generic Responses

    const GENERIC_OK = [
        'status' => self::OK,
        'message' => 'Action performed successfully.'
    ];

    const GENERIC_ERROR = [
        'status' => self::ERROR,
        'message' => 'An error occurred while trying to perform the requested action.'
    ];

    const GENERIC_DELETE = [
        'status' => self::OK,
        'message' => 'Resource successfully deleted.'
    ];

    # Exception Handling

    const MODEL_NOT_FOUND_EXCEPTION = [
        'status' => self::ERROR,
        'message' => 'Requested resource not found.'
    ];
}