<?php

namespace App\Http\Controllers\Api\v1\Admin;


use App\Helpers\HTTPMessages;
use App\Http\Requests\v1\UserRequest;
use App\Http\Resources\v1\Admin\UserCollection as UserResourceCollection;
use \App\Http\Resources\v1\Admin\User as UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResourceCollection
     */
    public function index() : UserResourceCollection
    {
        $users = User::paginate();

        return api_resource('admin\UserCollection')->make($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request) : UserResource
    {
        $user = User::create($request->all());

        if ($user instanceof User) {
            return api_resource('admin\User')->make($user);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user) : UserResource
    {
        return api_resource('admin\User')->make($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserRequest $request, User $user) : UserResource
    {

        $status = $user->update($request->all());

        if ($status) {
            return api_resource('admin\User')->make($user);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(HTTPMessages::GENERIC_DELETE);
    }
}
