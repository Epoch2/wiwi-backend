<?php namespace App\Serializers;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Models
use App\Models\User;

class UserSerializer
{
    public function one(User $user)
    {
        return [
            'id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
        ];
    }

    public function many($users)
    {
        array_map(function($user) {
            return $this->one($user);
        }, $users);
    }
}