<?php

namespace Tots\Auth\Repositories;

use Tots\Auth\Models\TotsUserAttemp;

/**
 *
 * @author matiascamiletti
 */
class TotsUserAttempRepository
{
    public function removeByUserId($userId)
    {
        TotsUserAttemp::where('user_id', $userId)->delete();
    }
}