<?php

namespace App\API\Controllers\V1;

use App\User;
use Illuminate\Http\Request;
use App\API\Controllers\BaseController;
use App\Http\Requests\ViewUser;
use App\Http\Requests\ViewAllUsers;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\DeleteUser;
use App\Http\Requests\AssignRole;
use App\API\Resources\V1\UserResource;
use App\API\Resources\V1\UserCollection;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAllUsers $request)
    {
        return new UserCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        return new UserResource(User::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(ViewUser $request, User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUser $request, User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'The resource deleted successfully.'
        ]);
    }

    public function assignRole(AssignRole $request, User $user)
    {
        $user->assignRole($request->input('role'));

        return new UserResource($user);
    }
}

