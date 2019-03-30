<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HTTPMessages;
use App\Models\AuthProviders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicEndPointController extends Controller
{

    /**
     * Ping pong
     *
     * Check the ping pong.
     *
     * @group General
     *
     * @response "pong"
     *
     * @return string
     */
    public function ping()
    {
        return "ping";
    }

    /**
     * Welcome message
     *
     * Return the welcome message to the user
     *
     * @group General
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
     * @group General
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function version()
    {
        return response()->json([
            "version" => config('api.version')
        ]);
    }

    /**
     * Return the application meta information.
     *
     * @group general
     *
     * @response 200 {
        "data": "App name and version"
      }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMeta()
    {
        return response()->json([
            "data" => [
                'name' => config("app.name", "My App Name")
            ]
        ]);
    }

    /**
     * Get available authentication providers
     *
     * @group general
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authProviders()
    {
        $providers = AuthProviders::select(['name', 'callback_url'])->get();

        return response()->json([
            "status" => HTTPMessages::SUCCESS,
            "data" => $providers
        ]);
    }
}
