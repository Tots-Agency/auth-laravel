<?php

namespace Tots\Auth\Http\Controllers\Basic;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        /** @var \Tots\Auth\Models\TotsUser $user */
        $user = $request->user();
        // Get Params
        $oldPassword = $request->input('old_password');
        $password = $request->input('password');
        // Verify if password is correct
        if(!Hash::check($oldPassword, $user->password)){
            throw new \Exception('Password is not correct');
        }
        // Save new password
        $user->password = Hash::make($password);
        $user->save();
        
        return $user;
    }
}
