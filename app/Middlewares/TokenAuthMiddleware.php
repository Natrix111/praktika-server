<?php

namespace Middlewares;

use Model\User;
use Src\Request;
use Src\Auth\Auth;
use Src\View;

class TokenAuthMiddleware
{
    public function handle(Request $request, callable $next = null)
    {
        if ($this->isExcludedRoute($request)) {
            return $next ? $next($request) : $request;
        }

        $authHeader = $this->getAuthorizationHeader();

        if (preg_match('/Bearer\s+(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
            $user = User::where('token', $token)->first();

            if ($user) {
                Auth::login($user);
                return $next ? $next($request) : $request;
            }
        }

        http_response_code(401);
        (new View())->toJSON(['error' => 'Unauthorized']);
        exit();
    }


    private function isExcludedRoute(Request $request): bool
    {
        $excludedRoutes = ['/api/login'];

        $currentRoute = $request->getUri();

        return in_array($currentRoute, $excludedRoutes);
    }

    private function getAuthorizationHeader()
    {
        return $_SERVER['HTTP_AUTHORIZATION'] ?? getallheaders()['Authorization'] ?? '';
    }
}

