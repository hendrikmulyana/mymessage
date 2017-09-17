<?php

namespace App\Traits;

use App\Friendship;
trait Friendable
{
    public function addFriend($admin_id){

        $Friendship = Friendship::create([

            'requester' =>$this->id,
            'user_requested' =>$admin_id,
        ]);

        if ($Friendship){

            return $Friendship;
        }

        return 'failed';
    }
}