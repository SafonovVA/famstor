<?php


namespace App\Modules\Admin\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationController
{
    public function getAllRoles()
    {
        return Role::all()->pluck('name');
    }

    public function getPermissionsByRole(Request $request, $name)
    {
        return Role::findByName($name)->permissions;
    }

    public function getAllPermissions()
    {
        return Permission::all()->pluck('name');
    }

    public function addRole(Request $request)
    {
        $roleName = $request->input('roleName');
        try {
            Role::create(['name' => $roleName]);
        } catch (RoleAlreadyExists $exception) {
            $result = 'Role already exist';
        }
        return response()->json(['result' => $result ?? 'success'], 200);
    }

    public function removeRole(Request $request)
    {
        $roleName = $request->input('roleName');
        try {
            Role::findByName($roleName)->delete();
        } catch (\Exception $e) {
            $result ='Role already deleted';
        }
        return response()->json(['result' => $result ?? 'success'], 200);
    }
}
