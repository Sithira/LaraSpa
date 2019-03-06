<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HTTPStatus;
use App\Models\AuthProviders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicEndPointController extends Controller
{

    /**
     * Return the welcome message to the user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function welcome()
    {
        return response()->json([
            'message' => "Welcome to " . env('APP_NAME') . " api v" . config('api.version')
        ]);
    }

    /**
     * Return the current version of the application.
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function version()
    {
        return response()->json([
            "version" => config('api.version')
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
