<?php

namespace Tots\Auth\Repositories;

use Illuminate\Support\Facades\Hash;
use Tots\Auth\Models\TotsUser;

/**
 *
 * @author matiascamiletti
 */
class TotsUserRepository
{
    public function fetchUserByPhone($phone)
    {
        $user = TotsUser::where('phone', $phone)->first();
        // Verify if account exist
        if($user === null){
            throw new \Exception('This user not exist');
        }
        return $user;
    }

    public function fetchUserByEmailAndPhone($email, $phone)
    {
        $user = TotsUser::where('email', $email)->where('phone', $phone)->first();
        // Verify if account exist
        if($user === null){
            throw new \Exception('This user not exist');
        }
        return $user;
    }

    public function fetchUserByEmail($email)
    {
        $user = TotsUser::where('email', $email)->first();
        // Verify if account exist
        if($user === null){
            throw new \Exception('This user not exist');
        }
        return $user;
    }

    public function findUserByEmail($email)
    {
        return TotsUser::where('email', $email)->first();
    }

    public function fetchAllByRole($role)
    {
        return TotsUser::where('role', $role)->get();
    }

    public function updatePhoto($userId, $photo)
    {
        TotsUser::where('id', $userId)->update(['photo' => $photo]);
    }

    public function updatePhone($userId, $phone)
    {
        TotsUser::where('id', $userId)->update(['phone' => $phone]);
    }

    public function updateEmail($userId, $email)
    {
        // Verify if email exist
        $user = TotsUser::where('email', $email)->where('id', '!=', $userId)->first();
        if($user !== null){
            throw new \Exception('This email is already in use');
        }

        TotsUser::where('id', $userId)->update(['email' => $email]);
    }

    public function updatePassword($userId, $password)
    {
        TotsUser::where('id', $userId)->update(['password' => $password]);
    }

    public function updateFirstname($userId, $firstname)
    {
        TotsUser::where('id', $userId)->update(['firstname' => $firstname]);
    }

    public function updateLastname($userId, $lastname)
    {
        TotsUser::where('id', $userId)->update(['lastname' => $lastname]);
    }

    public function update($userId, $firstname, $lastname, $email, $phone, $photo)
    {
        // Verify if email exist
        $user = TotsUser::where('email', $email)->where('id', '!=', $userId)->first();
        if($user !== null){
            throw new \Exception('This email is already in use');
        }

        TotsUser::where('id', $userId)->update([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'photo' => $photo
        ]);
    }

    public function updateByData($userId, $data)
    {
        // Verify if email exist
        $user = TotsUser::where('email', $data['email'])->where('id', '!=', $userId)->first();
        if($user !== null){
            throw new \Exception('This email is already in use');
        }

        TotsUser::where('id', $userId)->update($data);
    }

    public function removeById($userId)
    {
        $user = TotsUser::find($userId);
        if($user === null){
            throw new \Exception('This user not exist');
        }
        $user->forceDelete();
    }

    public function create($email, $password, $firstname = '', $lastname = '', $photo = '', $phone = '', $role = 1, $languageId = 1)
    {
        $user = new TotsUser();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->role = $role;
        $user->password = Hash::make($password);
        $user->photo = $photo;
        $user->phone = $phone;
        $user->status = TotsUser::STATUS_ACTIVE;
        $user->language_id = $languageId;
        return $this->createByObj($user);
    }

    public function createByObj(TotsUser $user)
    {
        $user->save();
        return $user;
    }
}