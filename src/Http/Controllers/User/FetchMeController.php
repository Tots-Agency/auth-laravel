<?php

namespace Tots\Auth\Http\Controllers\User;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;

class FetchMeController extends \Laravel\Lumen\Routing\Controller
{

    public function handle(Request $request)
    {
        /** @var \Tots\Auth\Models\TotsUser $user */
        $user = $request->user();
        // Return data
        return $user;
    }
}
