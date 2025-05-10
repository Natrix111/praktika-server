<?php

namespace Controller\Api;

use Src\Auth\Auth;
use Src\Request;
use Src\View;

class AuthController
{
    public function login(Request $request): void
    {
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = bin2hex(random_bytes(32));
            $user->token = $token;
            $user->save();

            (new View())->toJSON(['token' => $token]);
        } else {
            http_response_code(401);
            (new View())->toJSON(['error' => 'Невернные данные']);
        }
    }
}