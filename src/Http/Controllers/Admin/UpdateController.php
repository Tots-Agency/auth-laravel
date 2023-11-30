<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Tots\Auth\Models\TotsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id, Request $request)
    {
        $item = TotsUser::where('id', $id)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        // Process validations
        /*$this->validate($request, [
            'title' => 'required|min:3',
        ]);*/
        // Update values
        $item->firstname = $request->input('firstname');
        $item->lastname = $request->input('lastname');
        $item->photo = $request->input('photo');
        $item->phone = $request->input('phone');
        // Verify if email exist
        if($item->email != $request->input('email') && TotsUser::where('email', $request->input('email'))->count() > 0){
            throw new \Exception('Email already exist');
        }
        $item->email = $request->input('email');
        // Verify if password is set
        $password = $request->input('password');
        if($password !== null) {
            $item->password = Hash::make($password);
        }
        // Save new model
        $item->save();
        // Return data
        return $item;
    }
}