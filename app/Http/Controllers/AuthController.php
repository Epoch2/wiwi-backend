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

// Exceptions
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

// JWT
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $this->getCredentials($request);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new UnauthorizedHttpException('Invalid credentials!');
            }
        } catch (JWTException $e) {
            throw new HttpException(HttpCodes::HTTP_INTERNAL_SERVER_ERROR, 'Token creation failed!');
        }

        return response()->json(
            ['token' => $token],
            HttpCodes::HTTP_OK
        );
    }

    private function getCredentials(Request $request)
    {
        return [
            'email' => $request->json()->get('username'),
            'password' => $request->json()->get('password'),
        ];
    }
}