<?php namespace App\Services;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 13/12/15
 *
 * (c) 2015 wasitworth.it
 */

// JWT
use JWTAuth;

class AuthService
{
    public function getAuthenticatedUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }
}