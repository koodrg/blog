<?php

namespace App\App\Api\Middlewares;

use App\Infrastructure\Helpers\JwtHelper;
use App\Infrastructure\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function __construct(public UserRepository $userRepository)
    {
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'TOKEN_NOT_PROVIDED'], 401);
        }

        $decoded = JwtHelper::decodeJwt($token, env('JWT_SECRET_KEY'));

        if (!$decoded) {
            return response()->json(['error' => 'INVALID_TOKEN'], 401);
        }

        if($decoded['exp'] < time()) {
            return response()->json(['error' => 'TOKEN_EXPIRED'], 401);
        }

        $user = $this->userRepository->find($decoded['sub']);

        if($user) {
            Auth::setUser($user);
            return $next($request);
        }

        return response()->json(['error' => 'INVALID_USER'], 401);
    }
}
