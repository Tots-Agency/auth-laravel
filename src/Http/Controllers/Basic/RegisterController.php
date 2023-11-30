<?php

namespace Tots\Auth\Http\Controllers\Basic;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;
use Illuminate\Support\Facades\Hash;
use Tots\Auth\Services\AuthService;

class RegisterController extends \Laravel\Lumen\Routing\Controller
{

    /**
     *
     * @var AuthService
     */
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request)
    {
        // Validation
        $this->validate($request, [
            'password' => 'required|min:6',
            'email' => 'required|email|unique:tots_user'
        ]);
        // Get Params
        $email = $request->input('email');
        $password = $request->input('password');
        // Create new user
        $user = new TotsUser();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
        // Return data
        return $user;
    }
}
