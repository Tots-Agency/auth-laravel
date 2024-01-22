<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Tots\Auth\Models\TotsUser;
use Illuminate\Http\Request;
use Tots\Core\Exceptions\TotsException;

class FetchByIdController extends \Illuminate\Routing\Controller
{
    public function handle($id, Request $request)
    {
        $item = TotsUser::where('id', $id)->first();
        if($item === null) {
            throw new TotsException('Item not exist.', 'not-found', 404);
        }
        return $item;
    }
}