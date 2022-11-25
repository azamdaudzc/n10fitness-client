<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderWeekDay
 *
 * @property $id
 * @property $program_builder_week_id
 * @property $day_title
 * @property $day_no
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilderDayExercise[] $programBuilderDayExercises
 * @property ProgramBuilderDayWarmup[] $programBuilderDayWarmups
 * @property ProgramBuilderWeek $programBuilderWeek
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderWeekDay extends Model
{
    
    static $rules = [
		'program_builder_week_id' => 'required',
		'day_title' => 'required',
		'day_no' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['program_builder_week_id','day_title','day_no'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderDayExercises()
    {
        return $this->hasMany('App\Models\ProgramBuilderDayExercise', 'builder_week_day_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderDayWarmups()
    {
        return $this->hasMany('App\Models\ProgramBuilderDayWarmup', 'program_builder_week_day_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilderWeek()
    {
        return $this->hasOne('App\Models\ProgramBuilderWeek', 'id', 'program_builder_week_id');
    }
    

}
