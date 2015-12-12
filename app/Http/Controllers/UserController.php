<?php namespace App\Http\Controllers;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Core
use Illuminate\Http\Request;

// Helpers
use Epoch2\HttpCodes;
use Illuminate\Support\Facades\Hash;

// Doctrine
use EntityManager;

// Models
use App\Models\User;

// Serializers
use App\Serializers\UserSerializer;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $json = $request->json();

        $user = new User;

        $user->setFirstName($json->get('first_name'));
        $user->setLastName($json->get('last_name'));
        $user->setEmail($json->get('email'));

        $user->setPassword(Hash::make($json->get('password')));

        EntityManager::persist($user);
        EntityManager::flush();

        return response()->json(
            (new UserSerializer)->one($user),
            HttpCodes::HTTP_CREATED
        );
    }
}