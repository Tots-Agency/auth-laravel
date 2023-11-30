<?php

namespace Tots\Auth\Http\Controllers\Basic;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;

class VerifyIfExistEmailController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Validation
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        // Search user exist
        $user = TotsUser::where('email', $request->input('email'))->first();
        if($user !== null){
            return ['exist' => true];
        }
        return ['exist' => false];
    }
}
