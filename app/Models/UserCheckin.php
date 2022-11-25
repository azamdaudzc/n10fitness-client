<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCheckin
 *
 * @property $id
 * @property $checkin_time
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property UserCheckinAnswer[] $userCheckinAnswers
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserCheckin extends Model
{
    
    static $rules = [
		'checkin_time' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['checkin_time','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userCheckinAnswers()
    {
        return $this->hasMany('App\Models\UserCheckinAnswer', 'user_checkin_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
