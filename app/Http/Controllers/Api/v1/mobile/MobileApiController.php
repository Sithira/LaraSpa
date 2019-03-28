<?php

namespace App\Http\Controllers\Api\v1\mobile;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MobileApiController extends Controller
{

    public function getInfo()
    {
        $user = User::with(['optician'])->find(auth()->id());

        return api_resource('mobile\User')->make($user);
    }

    public function getCheckups()
    {
        $scheduledCheckups = User::find(auth()->id())->checkups->reverse();

        return api_resource('mobile\CheckupSchedule')->make($scheduledCheckups);
    }

}
