<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientCoach
 *
 * @property $id
 * @property $coach_id
 * @property $assigned_by
 * @property $client_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ClientCoach extends Model
{

    static $rules = [
        'client_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['coach_id', 'assigned_by', 'client_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'client_id');
    }

    public function coach()
    {
        return $this->hasOne('App\Models\User', 'id', 'coach_id');
    }
}
