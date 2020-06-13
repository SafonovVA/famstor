<?php


namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

class UsersController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        //$this->middleware('admin-auth')->only('editUsers');
        //$this->middleware('team-member')->except('editUsers');

        // Ограничение частоты запросов для api
        //$this->middleware(['auth:api', 'throttle:60,1']);
    }

    public function index(\Illuminate\Http\Request $request, $id = 1)
    {
        //dd($request->route()->getName() );
        return view('users.index')
            ->with('id', $id);
        //return view('users.index', ['id' => $id]);
    }

    public function view($user)
    {
        //dd(request()->route()->getName() );
        return view('users.view', ['user' => $user]);
        //return redirect('users');
    }

    public function some($id, $some)
    {
        return $id . ' some ' . $some;
    }
}
