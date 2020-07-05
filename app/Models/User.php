<?php
/**
 * File user class
 * php version 7.4
 *
 * @category Auth
 * @package  Files
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class for user model
 *
 * @category Auth
 * @package  Class
 * @author   Safonov Vladimir <safonov.open@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     http://famstor.test/auth
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @return bool
     */
    public function isAdmin()
    {
        //dd($this->hasRole('super-admin'));
        return $this->hasRole('super-admin');
    }
}
