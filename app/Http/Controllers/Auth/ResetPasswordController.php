<?php
/**
 * File used for reset user password
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
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class used for reset user password
 *
 * @category Auth
 * @package  Class
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;
}
