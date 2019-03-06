<?php
/**
 * Created by PhpStorm.
 * User: sithira
 * Date: 2019-03-06
 * Time: 13:50
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{

    public function with($request)
    {
       return [
           'system' => config('base.name', 'system-name'),
           'version' => config('api.version', '1')
       ];
    }

}