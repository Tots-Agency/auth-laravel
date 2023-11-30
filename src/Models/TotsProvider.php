<?php

namespace Tots\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Model
 *
 * @author matiascamiletti
 */
class TotsProvider extends Model
{
    protected $table = 'tots_provider';
    
    protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}