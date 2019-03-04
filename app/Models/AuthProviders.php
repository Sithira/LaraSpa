<?php

namespace App\Models;

use App\Models\Scopes\ScopeIsActive;
use Illuminate\Database\Eloquent\Model;

class AuthProviders extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::addGlobalScope(new ScopeIsActive);
    }
}
