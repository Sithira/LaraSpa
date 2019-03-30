<?php


namespace App\Helpers;


class HTTPCodes
{

    const SUCCESS = 200;

    const CREATED = 201;

    const SUCCESS_AWAIT = 202;

    // 400's
    const BAD_REQUEST = 400;
    const VALIDATION_ERROR = self::BAD_REQUEST;

    const UNAUTHORIZED = 401;

    const FORBIDDEN = 403;
    const INSUFFICIENT_PERMISSION = self::FORBIDDEN;

    const NOT_FOUND = 404;

}
