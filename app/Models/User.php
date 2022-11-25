<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'is_active',
        'athletic_type',
        'height',
        'age',
        'gender',
        'avatar',
        'phone',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userCreator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function userAthleticType()
    {
        return $this->hasOne('App\Models\AthleticType', 'id', 'athletic_type');
    }

    public static function editRules($id){
        return  [
            'id' =>'exists:users,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required|unique:users,email,'.$id,
        ];
    }

    public static function createRules(){
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'email|required|unique:users,email',
        ];
    }

}
