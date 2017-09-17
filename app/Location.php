<?php
/**
 * Created by PhpStorm.
 * User: EBOD
 * Date: 7/26/2017
 * Time: 6:45 AM
 */

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Location extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'locations';

    protected $fillable = [
        'kabkot','kecamatan','lat','lng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}