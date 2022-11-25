<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderDayExerciseInput
 *
 * @property $id
 * @property $day_exercise_id
 * @property $program_builder_id
 * @property $set_no
 * @property $weight
 * @property $reps
 * @property $rpe
 * @property $peak_exterted_max
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilderDayExercise $programBuilderDayExercise
 * @property ProgramBuilder $programBuilder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderDayExerciseInput extends Model
{

    static $rules = [
		'day_exercise_id' => 'required',
		'program_builder_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['day_exercise_id','program_builder_id','set_no','weight','reps','rpe','peak_exterted_max','user_program'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilderDayExercise()
    {
        return $this->hasOne('App\Models\ProgramBuilderDayExercise', 'id', 'day_exercise_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilder()
    {
        return $this->hasOne('App\Models\ProgramBuilder', 'id', 'program_builder_id');
    }


}
