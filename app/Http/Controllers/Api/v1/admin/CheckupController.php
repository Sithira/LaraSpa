<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use Illuminate\Http\Request;

class CheckupController extends Controller
{

    public function index() : \App\Http\Resources\v1\CheckupCollection
    {
        $checkups = Checkup::paginate();

        return api_resource('CheckupCollection')
            ->make($checkups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Checkup $checkup
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function show(Checkup $checkup) : \App\Http\Resources\v1\Checkup
    {
        return api_resource("Checkup")
            ->make($checkup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Checkup $checkup
     * @return void
     */
    public function update(Request $request, Checkup $checkup)
    {

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
