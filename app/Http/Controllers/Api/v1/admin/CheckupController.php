<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helpers\HTTPCodes;
use App\Helpers\HTTPMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\admin\CheckupRequest;
use App\Http\Resources\v1\admin\Checkup as CheckupResource;
use App\Http\Resources\v1\admin\CheckupCollection as CheckupCollectionResource;
use App\Models\Checkup;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckupController extends Controller
{

    public function index() : CheckupCollectionResource
    {
        $checkups = Checkup::paginate();

        return api_resource('admin\CheckupCollection')
            ->make($checkups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckupRequest $request
     * @return JsonResource
     */
    public function store(CheckupRequest $request)
    {

        $checkup = Checkup::create($request->validated());

        if ($checkup instanceof Checkup) {
            return api_resource("admin\Checkup")
                ->make($checkup)
                ->response()
                ->setStatusCode(HTTPCodes::CREATED);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    /**
     * Display the specified resource.
     *
     * @param Checkup $checkup
     * @return CheckupResource
     */
    public function show(Checkup $checkup) : CheckupResource
    {
        return api_resource("admin\Checkup")
            ->make($checkup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CheckupRequest $request
     * @param Checkup $checkup
     * @return CheckupResource
     */
    public function update(CheckupRequest $request, Checkup $checkup) : CheckupResource
    {
        $status = $checkup->update($request->validated());

        if ($status) {
            return api_resource("admin\Checkup")->make($status);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Checkup $checkup
     * @return void
     */
    public function destroy(Checkup $checkup)
    {
        //
    }
}
