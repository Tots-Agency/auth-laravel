<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Tots\Auth\Models\TotsUser;
use Illuminate\Http\Request;
use Tots\Core\Exceptions\TotsException;

class RemoveByIdController extends \Illuminate\Routing\Controller
{
    public function handle($id)
    {
        $item = TotsUser::where('id', $id)->first();
        if($item === null) {
            throw new TotsException('Item not exist.', 'not-found', 404);
        }
        $item->delete();
        return ['delete' => $id];
    }
}