<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helpers\HTTPMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CheckupScheduleRequest;
use App\Models\CheckupSchedule;
use \App\Http\Resources\v1\admin\CheckupScheduleCollection as CheckupScheduleCollectionResource;
use \App\Http\Resources\v1\admin\CheckupSchedule as CheckupScheduleResource;

class CheckupScheduleController extends Controller
{

    public function index() : CheckupScheduleCollectionResource
    {
        $schedules = CheckupSchedule::paginate();

        return api_resource('admin\CheckupScheduleCollection')
            ->make($schedules);
    }

    public function store(CheckupScheduleRequest $request) : CheckupScheduleResource
    {
        $scheduleCheckup = CheckupSchedule::create($request->all());

        if ($scheduleCheckup instanceof CheckupSchedule) {
            return api_resource('admin\CheckupSchedule')->make($scheduleCheckup);
        }

        return response()->json(HTTPMessages::ERROR);
    }

    public function show(CheckupSchedule $checkupSchedule) : CheckupScheduleResource
    {
        return api_resource("admin\CheckupSchedule")
            ->make($checkupSchedule);
    }

    public function update(CheckupScheduleRequest $request, CheckupSchedule $checkupSchedule) : CheckupScheduleResource
    {
        $status = $checkupSchedule->update($request->all());

        if ($status) {
            return api_resource("admin\CheckupSchedule")->make($checkupSchedule);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    public function destroy(CheckupSchedule $checkupSchedule)
    {
        //
    }
}
