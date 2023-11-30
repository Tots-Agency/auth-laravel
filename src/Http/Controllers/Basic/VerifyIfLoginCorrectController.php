<?php

namespace Tots\Auth\Http\Controllers\Basic;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;
use Illuminate\Support\Facades\Hash;
use Tots\Auth\Models\TotsUserAttemp;
use Tots\Auth\Services\AuthService;

class VerifyIfLoginCorrectController extends LoginController
{
    public function handle(Request $request)
    {
        // Get Params
        $email = $request->input('email');
        $password = $request->input('password');
        // Search active user
        $user = $this->getActiveUser($request, $email, $password);
        
        return true;
    }
}
