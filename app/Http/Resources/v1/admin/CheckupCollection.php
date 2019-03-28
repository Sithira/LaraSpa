<?php

namespace App\Http\Resources\v1\admin;

use App\Http\Resources\BaseResourceCollection;

class CheckupCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
