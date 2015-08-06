<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 04/08/2015
 * Time: 15:36
 */

namespace CodeProject\OAuth;
use Auth;

class Verifier
{

    public function verify($username, $password)
    {
        $credentials = [
            'email' => $username,
            'password' => $password
        ];

        if(Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
} 