<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderShare
 *
 * @property $id
 * @property $program_builder_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilder $programBuilder
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderShare extends Model
{
    
    static $rules = [
		'program_builder_id' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['program_builder_id','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilder()
    {
        return $this->hasOne('App\Models\ProgramBuilder', 'id', 'program_builder_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
