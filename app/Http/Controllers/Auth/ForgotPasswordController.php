<?php
/**
 * This file rules forgotten passwords
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
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * This file rules forgotten passwords
 *
 * @category Auth
 * @package  Class
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
}
