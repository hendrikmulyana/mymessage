<?php
/**
 * Created by PhpStorm.
 * User: EBOD
 * Date: 7/24/2017
 * Time: 5:08 PM
 */

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{

    use Notifiable;
    use Friendable;

    protected $guard = 'admin';
    protected $table = 'admin';

    protected $fillable = [
        'namadepan','namabelakang','slug','gender','email','notelp','username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}