<?php

namespace App\Services\Auth;

use App\Exceptions\JsonResponseException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    /**
     * login
     *
     * @param  mixed $data
     * @return User
     */
    public function login(array $data):User {
       if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            $token = $user->createToken(config('app.name'));
            $user['token'] = $token;
            return $user;
       } else {
        throw new JsonResponseException('Unauthorized', Response::HTTP_UNAUTHORIZED);
       }
    }

    public function register(array $data):User {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $token = $user->createToken(config('app.name'));
        $user['token'] = $token;
        return $user;
    }
}
