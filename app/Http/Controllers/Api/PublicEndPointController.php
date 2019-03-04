<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HTTPStatus;
use App\Models\AuthProviders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicEndPointController extends Controller
{

    /**
     * Return the current version of the application.
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function version()
    {
        return response()->json([
            "version" => config('base.version')
        ]);
    }

    /**
     * Get available authentication providers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authProviders()
    {
        $providers = AuthProviders::select(['name', 'callback_url'])->get();

        return response()->json([
            "status" => HTTPStatus::OK,
            "data" => $providers
        ]);
    }
}
