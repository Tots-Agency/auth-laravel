<?php

namespace Tots\Auth\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tots\Auth\Models\TotsUser;
use Tots\Auth\Services\AuthService;

class AuthOptionalMiddleware
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    /**
     * Undocumented variable
     *
     * @var AuthService
     */
    protected $service;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth, AuthService $service)
    {
        $this->auth = $auth;
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            // Decode Token
            $payload = $this->service->decodeAuthToken($request->bearerToken());
            // Search User in DB
            $user = TotsUser::where('id', $payload->uid)->first();
            if($user != null){
                $this->auth->guard('custom')->setUser($user);
            }
        } catch (\Throwable $th) { }

        return $next($request);
    }
}
