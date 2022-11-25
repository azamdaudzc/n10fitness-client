<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderTemplate
 *
 * @property $id
 * @property $program_builder_id
 * @property $is_approved
 * @property $created_by
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilder $programBuilder
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderTemplate extends Model
{
    
    static $rules = [
		'program_builder_id' => 'required',
		'is_approved' => 'required',
		'created_by' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['program_builder_id','is_approved','created_by'];


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
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
    

}
