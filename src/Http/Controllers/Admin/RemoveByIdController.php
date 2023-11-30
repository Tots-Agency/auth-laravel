<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Tots\Auth\Models\TotsUser;
use Illuminate\Http\Request;

class RemoveByIdController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id)
    {
        $item = TotsUser::where('id', $id)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        $item->delete();
        return ['delete' => $id];
    }
}