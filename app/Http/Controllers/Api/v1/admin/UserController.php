<?php

namespace App\Http\Controllers\Api\v1\Admin;


use App\Helpers\HTTPCodes;
use App\Helpers\HTTPMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\admin\UserRequest;
use App\Http\Resources\v1\admin\User as UserResource;
use App\Http\Resources\v1\admin\UserCollection as UserResourceCollection;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResourceCollection
     */
    public function index(): UserResourceCollection
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
    public function store(UserRequest $request): UserResource
    {
        $user = User::create($request->validated());

        if ($user instanceof User) {
            return api_resource('admin\User')
                ->make($user)
                ->response()
                ->setStatusCode(HTTPCodes::CREATED);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
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
    public function update(UserRequest $request, User $user): UserResource
    {

        $status = $user->update($request->validated());

        if ($status) {
            return api_resource('admin\User')->make($user);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(HTTPMessages::GENERIC_DELETE);
    }
}
