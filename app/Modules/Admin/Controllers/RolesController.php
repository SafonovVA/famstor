<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Role;

class RolesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['result' => Role::all()->pluck('name')], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create()
    {
        return response()->json(['result' => null], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $roleName = $request->input('roleName');
        try {
            Role::create(['name' => $roleName]);
        } catch (RoleAlreadyExists $exception) {
            $result = 'Role already exist';
        }
        return response()->json(['result' => $result ?? 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param string $role
     * @return JsonResponse
     */
    public function show($role)
    {
        return response()->json(['result' => Role::findByName($role)->permissions], 200);
    }

    /**
     * Associated new permission with role
     *
     * @param string $permission
     * @param string $role
     * @return JsonResponse
     */
    public function edit($role, $permission)
    {
        try {
            $role = Role::findByName($role);
            $role->givePermissionTo($permission);
        } catch (\Exception $exception) {
            $result = 'Error while adding permission to role';
        }

        return response()->json(['result' => $result ?? 'success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $role
     * @return JsonResponse
     */
    public function update(Request $request, $role)
    {
        $type = $request->input('type');
        if ($type === 'remove') {
            try {
                $role = Role::findByName($role);
                $role->revokePermissionTo($request->input('permissionName'));
            } catch (\Exception $exception) {
                $result = 'Error while removing permission';
            }
        } elseif ($type === 'add') {
            try {
                $role = Role::findByName($role);
                $role->givePermissionTo($request->input('permissionName'));
            } catch (\Exception $exception) {
                $result = 'Error while adding permission to role';
            }
        }

        return response()->json(['result' => $result ?? 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $role
     * @return JsonResponse
     */
    public function destroy($role)
    {
        try {
            Role::findByName($role)->delete();
        } catch (\Exception $e) {
            $result = 'Role already deleted';
        }
        return response()->json(['result' => $result ?? 'success'], 200);
    }
}
