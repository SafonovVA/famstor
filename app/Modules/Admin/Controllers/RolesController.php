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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($role)
    {
        return response()->json(['result' => Role::findByName($role)->permissions], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $role
     * @return JsonResponse
     */
    public function destroy($role)
    {
        //$roleName = $request->input('roleName');
        try {
            Role::findByName($role)->delete();
        } catch (\Exception $e) {
            $result ='Role already deleted';
        }
        return response()->json(['result' => $result ?? 'success'], 200);
    }
}
