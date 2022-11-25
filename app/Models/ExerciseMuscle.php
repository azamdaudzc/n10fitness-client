<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExerciseMuscle
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property ExcerciseLibraryMuscle[] $excerciseLibraryMuscles
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExerciseMuscle extends Model
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
    public function excerciseLibraryMuscles()
    {
        return $this->hasMany('App\Models\ExcerciseLibraryMuscle', 'excercise_muscle_id', 'id');
    }
    

}
