<?php
/**
 * Created by PhpStorm.
 * User: EBOD
 * Date: 8/9/2017
 * Time: 6:20 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $guard = 'admin';

    protected $fillable = [
        'city','country','about','admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}