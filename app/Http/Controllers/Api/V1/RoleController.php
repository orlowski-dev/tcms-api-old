<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreRoleRequest;
use App\Http\Requests\V1\UpdateRoleRequest;
use App\Http\Resources\V1\RoleCollection;
use App\Http\Resources\V1\RoleResourece;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return new RoleCollection($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $newRole = Role::create($request->all());
        return new RoleResourece($newRole);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResourece($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        return new RoleResourece($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }
}
