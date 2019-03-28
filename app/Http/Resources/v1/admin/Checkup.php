<?php

namespace App\Http\Resources\v1\admin;

use App\Http\Resources\BaseResource;

class Checkup extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
