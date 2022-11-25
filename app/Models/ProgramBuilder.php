<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilder
 *
 * @property $id
 * @property $title
 * @property $user_id
 * @property $days
 * @property $weeks
 * @property $is_finished
 * @property $created_by
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilderDayExerciseInput[] $programBuilderDayExerciseInputs
 * @property ProgramBuilderShare[] $programBuilderShares
 * @property ProgramBuilderTemplate[] $programBuilderTemplates
 * @property ProgramBuilderWeek[] $programBuilderWeeks
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilder extends Model
{

    static $rules = [
        'title' => 'required',
        'user_id' => 'required',
        'days' => 'required',
        'weeks' => 'required',
        'is_finished' => 'required',
        'created_by' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'user_id', 'days', 'weeks', 'is_finished', 'created_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderDayExerciseInputs()
    {
        return $this->hasMany('App\Models\ProgramBuilderDayExerciseInput', 'program_builder_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderShares()
    {
        return $this->hasMany('App\Models\ProgramBuilderShare', 'program_builder_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderTemplates()
    {
        return $this->hasMany('App\Models\ProgramBuilderTemplate', 'program_builder_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderWeeks()
    {
        return $this->hasMany('App\Models\ProgramBuilderWeek', 'program_builder_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function coach()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
