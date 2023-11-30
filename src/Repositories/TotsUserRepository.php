<?php

namespace Tots\Auth\Repositories;

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

    public function removeById($userId)
    {
        $user = TotsUser::find($userId);
        if($user === null){
            throw new \Exception('This user not exist');
        }
        $user->forceDelete();
    }
}