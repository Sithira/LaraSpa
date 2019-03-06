<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index() : UserCollection
    {
        $users = User::all();

        return new UserCollection($users);

        //return api_resource('UserCollection')->make($users);
    }
}
