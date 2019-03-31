<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helpers\HTTPCodes;
use App\Helpers\HTTPMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CheckupScheduleRequest;
use App\Models\CheckupSchedule;
use \App\Http\Resources\v1\admin\CheckupScheduleCollection as CheckupScheduleCollectionResource;
use \App\Http\Resources\v1\admin\CheckupSchedule as CheckupScheduleResource;

class CheckupScheduleController extends Controller
{

    /**
     * List all the checks ups for admins.
     *
     * @return CheckupScheduleCollectionResource
     */
    public function index() : CheckupScheduleCollectionResource
    {
        $schedules = CheckupSchedule::paginate();

        return api_resource('admin\CheckupScheduleCollection')
            ->make($schedules);
    }

    /**
     * Create a new checkup for admin
     *
     * @param CheckupScheduleRequest $request
     * @return CheckupScheduleResource
     */
    public function store(CheckupScheduleRequest $request)
    {
        $scheduleCheckup = CheckupSchedule::create($request->validated());

        if ($scheduleCheckup instanceof CheckupSchedule) {
            return api_resource('admin\CheckupSchedule')
                ->make($scheduleCheckup)
                ->response()
                ->setStatusCode(HTTPCodes::CREATED);
        }

        return response()->json(HTTPMessages::ERROR);
    }

    /**
     *  Show a specific Checkup schedule.
     *
     * @param CheckupSchedule $schedule
     * @return CheckupScheduleResource
     */
    public function show(CheckupSchedule $schedule)
    {
        return api_resource("admin\CheckupSchedule")
            ->make($schedule);
    }

    /**
     * @param CheckupScheduleRequest $request
     * @param CheckupSchedule $schedule
     * @return CheckupScheduleResource
     */
    public function update(CheckupScheduleRequest $request, CheckupSchedule $schedule) : CheckupScheduleResource
    {
        $status = $schedule->update($request->validated());

        if ($status) {
            return api_resource("admin\CheckupSchedule")
                ->make($schedule);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    /**
     * @param CheckupScheduleController $checkupSchedule
     */
    public function destroy(CheckupSchedule $checkupSchedule)
    {
        //
    }
}
