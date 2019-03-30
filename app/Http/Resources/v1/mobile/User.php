<?php

namespace App\Http\Resources\v1\mobile;

use App\Http\Resources\BaseResource;

class User extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "provider" => $this->provider,
            "avatar" => $this->avatar,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "optician" => $this->optician
        ];
    }
}
