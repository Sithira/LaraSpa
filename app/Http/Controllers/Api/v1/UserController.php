<?php

namespace App\Http\Controllers\Api\v1;


use App\Helpers\HTTPMessages;
use App\Http\Requests\UserRequest;
use App\Http\Resources\v1\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index() : UserCollection
    {
        $users = User::paginate();

        return api_resource('UserCollection')->make($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return \App\Http\Resources\v1\User
     */
    public function store(UserRequest $request) : \App\Http\Resources\v1\User
    {
        $user = User::create($request->all());

        if ($user instanceof User) {
            return api_resource('User')->make($user);
        }

        return response()->json(HTTPMessages::GENERIC_ERROR);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) : \App\Http\Resources\v1\User
    {
        return api_resource('User')->make($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {

        $status = $user->update($request->all());

        if ($status) {
            return api_resource('User')->make($user);
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
