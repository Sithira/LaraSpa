<?php

namespace App\Http\Resources\v1\mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckupSchedule extends JsonResource
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
