<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderDayExercise
 *
 * @property $id
 * @property $builder_week_day_id
 * @property $exercise_library_id
 * @property $sets_no
 * @property $rep_min_no
 * @property $rep_max_no
 * @property $rpe_no
 * @property $load_text
 * @property $rest_time
 * @property $notes
 * @property $created_at
 * @property $updated_at
 *
 * @property ExerciseLibrary $exerciseLibrary
 * @property ProgramBuilderDayExerciseInput[] $programBuilderDayExerciseInputs
 * @property ProgramBuilderWeekDay $programBuilderWeekDay
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderDayExercise extends Model
{
    
    static $rules = [
		'builder_week_day_id' => 'required',
		'exercise_library_id' => 'required',
		'sets_no' => 'required',
		'rep_min_no' => 'required',
		'rep_max_no' => 'required',
		'rpe_no' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['builder_week_day_id','exercise_library_id','sets_no','rep_min_no','rep_max_no','rpe_no','load_text','rest_time','notes'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseLibrary()
    {
        return $this->hasOne('App\Models\ExerciseLibrary', 'id', 'exercise_library_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderDayExerciseInputs()
    {
        return $this->hasMany('App\Models\ProgramBuilderDayExerciseInput', 'day_exercise_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilderWeekDay()
    {
        return $this->hasOne('App\Models\ProgramBuilderWeekDay', 'id', 'builder_week_day_id');
    }
    

}
