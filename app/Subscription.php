<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public static function add($email, $token)
    {
        $sub = new static;
        $sub->email = $email;
        $sub->token = $token;
        $sub->save();

        return $sub;
    }

    public static function addNotToken($email)
    {
        $sub = new static;
        $sub->email = $email;
        $sub->token = null;
        $sub->save();

        return $sub;
    }

    public function remove()
    {
       $this->delete(); 
    }
}
