<?php

namespace App\Http\Controllers\Api\v1\mobile;

use App\Helpers\HTTPMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\mobile\FollowUpRequest;
use App\Models\CheckupSchedule;
use App\Models\User;
use Illuminate\Http\Resources\Json\Resource;

class MobileApiController extends Controller
{

    /**
     * Get user logged in user.
     *
     * Get the info for the current logged in user with allocated optician data.
     *
     * @group Mobile
     *
     * @authenticated
     *
     * @responseFile 200 responses/v1/mobile/user.GET.200.json
     * @responseFile 403 responses/templates/403.json
     * @responseFile 404 responses/templates/GET.404.json
     *
     * @return Resource
     */
    public function getInfo()
    {
        $user = User::with(['optician'])->find(auth()->id());

        return api_resource('mobile\User')->make($user);
    }

    /**
     * Get all checkups
     *
     * Get all the checkups that the authenticated user is allocated to.
     *
     * @group Mobile
     *
     * @authenticated
     *
     * @responseFile 200 responses/v1/mobile/GET.user.checkups.200.json
     * @responseFile 403 responses/templates/403.json
     * @responseFile 404 responses/templates/GET.404.json
     *
     * @return Resource
     */
    public function getCheckups()
    {
        $scheduledCheckups = User::find(auth()->id())->checkups->reverse();

        return api_resource('mobile\CheckupSchedule')->make($scheduledCheckups);
    }

    /**
     * Create a checkup
     *
     * Authenticated user can create a new checkup.
     *
     * @group Mobile
     *
     * @authenticated
     *
     * @bodyParam optician_id integer required Optician id
     * @bodyParam diagnose_date string required Diagnose date
     * @bodyParam note string Note for the other party
     *
     * @responseFile 201 responses/v1/mobile/POST.user.create.checkup.json
     * @responseFile 403 responses/templates/403.json
     * @responseFile 404 responses/templates/GET.404.json
     *
     * @param FollowUpRequest $request
     * @return Resource
     */
    public function requestCheckup(FollowUpRequest $request)
    {

        $checkup = CheckupSchedule::create($request->validated());

        if ($checkup instanceof CheckupSchedule) {
            return api_resource("mobile\CheckupSchedule")->make($checkup);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

}
