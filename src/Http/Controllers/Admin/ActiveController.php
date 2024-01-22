<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;
use Tots\Core\Exceptions\TotsException;

class ActiveController extends \Illuminate\Routing\Controller
{
    public function handle($id)
    {
        // Search user exist
        $user = TotsUser::where('id', $id)->first();
        if($user === null){
            throw new TotsException('Not exist user.', 'not-exist-user', 400);
        }
        // Save new status
        $user->status = TotsUser::STATUS_ACTIVE;
        $user->save();

        return ['success' => true];
    }
}
