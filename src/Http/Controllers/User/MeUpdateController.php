<?php

namespace Tots\Auth\Http\Controllers\User;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;

class MeUpdateController extends \Laravel\Lumen\Routing\Controller
{

    public function handle(Request $request)
    {
        /** @var \Tots\Auth\Models\TotsUser $user */
        $user = $request->user();
        // update params
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->photo = $request->input('photo');
        $user->phone = $request->input('phone');
        $user->save();
        // Return data
        return $user;
    }
}
