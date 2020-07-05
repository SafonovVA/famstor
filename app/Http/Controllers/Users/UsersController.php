<?php
/**
 * File for verificate user controller
 * php version 7.4
 *
 * @category User
 * @package  Files
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class user controller
 *
 * @category User
 * @package  Class
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */
class UsersController extends \App\Http\Controllers\Controller
{
    /**
     * UserCOntroller constructor
     */
    public function __construct()
    {
        $this->middleware('auth');

        //$this->middleware('admin-auth')->only('editUsers');
        //$this->middleware('team-member')->except('editUsers');

        // Ограничение частоты запросов для api
        //$this->middleware(['auth:api', 'throttle:60,1']);
    }

    /**
     * UserController index view
     *
     * @param \Illuminate\Http\Request $request user request params
     * @param int                      $id      user id
     *
     * @return void
     */
    public function index(\Illuminate\Http\Request $request, $id = 1)
    {

        $today = Carbon::today()->addSecond();

        $tomorrow = Carbon::tomorrow()->addSecond();

        if ($today < $tomorrow) {
            $today = $tomorrow;

        }

        //dd($request->route()->getName() );
        return view('users.index')
            ->with('id', $today);
        //return view('users.index', ['id' => $id]);
    }

    /**
     * UserController view
     *
     * @param string $user userName
     *
     * @return void
     */
    public function view($user)
    {
        //dd(request()->route()->getName() );
        return view('users.view', ['user' => $user]);
        //return redirect('users');
    }

    /**
     * UserController view
     *
     * @param int    $id   userId
     * @param string $some someString
     *
     * @return string
     */
    public function some($id, $some)
    {
        return $id . ' admin ' . $some;
    }
}
