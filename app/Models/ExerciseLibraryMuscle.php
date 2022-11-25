<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExcerciseLibraryMuscle
 *
 * @property $id
 * @property $name
 * @property $exercise_library_id
 * @property $excercise_muscle_id
 * @property $created_at
 * @property $updated_at
 *
 * @property ExerciseLibrary $exerciseLibrary
 * @property ExerciseMuscle $exerciseMuscle
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExerciseLibraryMuscle extends Model
{

    static $rules = [
		'name' => 'required',
		'exercise_library_id' => 'required',
		'excercise_muscle_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','exercise_library_id','excercise_muscle_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseLibrary()
    {
        return $this->hasOne('App\Models\ExerciseLibrary', 'id', 'exercise_library_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseMuscle()
    {
        return $this->hasOne('App\Models\ExerciseMuscle', 'id', 'excercise_muscle_id');
    }


}
