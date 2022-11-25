<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExerciseMovementPattern
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property ExerciseLibrary[] $exerciseLibrarys
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExerciseMovementPattern extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exerciseLibrarys()
    {
        return $this->hasMany('App\Models\ExerciseLibrary', 'movement_pattern_id', 'id');
    }
    

}
