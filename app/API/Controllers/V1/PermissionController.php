<?php

namespace App\API\Controllers\V1;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\ViewAllPermissions;
use App\Http\Requests\ViewPermission;
use App\API\Resources\V1\PermissionResource;
use App\API\Resources\V1\PermissionCollection;
use App\API\Controllers\BaseController;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAllPermissions $request)
    {
        return new PermissionCollection(Permission::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ViewPermission $request, Permission $permission)
    {
        return new PermissionResource($permission);
    }
}
