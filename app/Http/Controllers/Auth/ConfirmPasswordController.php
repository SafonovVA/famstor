<?php
/**
 * File for confirm user password
 * php version 7.4
 *
 * @category Auth
 * @package  Files
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

/**
 * Class for confirm user password
 *
 * @category Auth
 * @package  Class
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */
class ConfirmPasswordController extends Controller
{

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
