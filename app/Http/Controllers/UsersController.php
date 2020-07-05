<?php


namespace App\Http\Controllers;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        //$this->middleware('admin-auth')->only('editUsers');
        //$this->middleware('team-member')->except('editUsers');

        // Ограничение частоты запросов для api
        //$this->middleware(['auth:api', 'throttle:60,1']);
    }

    public function index($id = 1)
    {
        return $id . ' index';
    }

    public function view($user = 'asd')
    {
        return view('users.view', ['user' => $user]);
        return redirect('users');
    }

    public function some($id, $some)
    {
        return $id . ' admin ' . $some;
    }
}
