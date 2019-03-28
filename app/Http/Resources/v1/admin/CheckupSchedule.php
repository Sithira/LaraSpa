<?php

namespace App\Http\Resources\v1\admin;

use App\Http\Resources\BaseResource;

class CheckupSchedule extends BaseResource
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
