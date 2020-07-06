<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index()
    {
        $allRoles = Role::all()->pluck('name');
        $allPermissions = Permission::all()->pluck('name');
        return view('Admin::index', compact('allRoles', 'allPermissions'));
    }

}
