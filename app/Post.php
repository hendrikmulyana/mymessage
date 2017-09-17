<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(admin::class);
    }

    public function likes(){
        return $this->belongsTo(likes::class);
    }
}
