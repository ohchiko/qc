<?php

namespace App\API\Controllers\V1;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\API\Controllers\BaseController;
use App\Http\Requests\ViewRole;
use App\Http\Requests\ViewAllRoles;
use App\Http\Requests\SyncPermissions;
use App\API\Resources\V1\RoleResource;
use App\API\Resources\V1\RoleCollection;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAllRoles $request)
    {
        return new RoleCollection(Role::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ViewRole $request, Role $role)
    {
        return new RoleResource($role);
    }

    public function syncPermissions(SyncPermissions $request, Role $role)
    {
        $role->syncPermissions($request->input('permissions'));

        return new RoleResource($role);
    }
}

