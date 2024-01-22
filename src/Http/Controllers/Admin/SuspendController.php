<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;
use Tots\Core\Exceptions\TotsException;

class SuspendController extends \Illuminate\Routing\Controller
{
    public function handle($id)
    {
        // Search user exist
        $user = TotsUser::where('id', $id)->first();
        if($user === null){
            throw new TotsException('Item not exist.', 'not-found', 404);
        }
        // Save new status
        $user->status = TotsUser::STATUS_SUSPENDED;
        $user->save();

        return ['success' => true];
    }
}
