<?php

namespace App\Models;

use App\Models\Scopes\ScopeIsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthProviders extends Model
{

    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::addGlobalScope(new ScopeIsActive);
    }
}
