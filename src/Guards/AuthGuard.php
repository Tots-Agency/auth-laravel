<?php

namespace Tots\Auth\Guards;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use Tots\Auth\Models\TotsUser;
use Tots\Auth\Providers\AuthServiceProvider;
use Tots\Auth\Services\AuthService;
use Tots\Core\Exceptions\TotsException;

class AuthGuard implements Guard
{
    use GuardHelpers, Macroable;

     /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Undocumented variable
     *
     * @var AuthService
     */
    protected $service;

    public function __construct(UserProvider $provider, Request $request, AuthService $service)
    {
        $this->provider = $provider;
        $this->request = $request;
        $this->service = $service;
    }
    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (isset($this->user)) {
            return $this->user;
        }
    }
    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        try {
            // Decode Token
            $payload = $this->service->decodeAuthToken($credentials['access_token']);
            // Search User in DB
            $user = TotsUser::where('id', $payload->uid)->first();
            if($user == null){
                throw new TotsException('Not exist user.', 'not-exist-user', 400);
            }

            $this->setUser($user);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
