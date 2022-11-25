<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderWeek
 *
 * @property $id
 * @property $program_builder_id
 * @property $week_no
 * @property $assigned_calories
 * @property $assigned_proteins
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilderWeekDay[] $programBuilderWeekDays
 * @property ProgramBuilder $programBuilder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderWeek extends Model
{
    
    static $rules = [
		'program_builder_id' => 'required',
		'week_no' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['program_builder_id','week_no','assigned_calories','assigned_proteins'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderWeekDays()
    {
        return $this->hasMany('App\Models\ProgramBuilderWeekDay', 'program_builder_week_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilder()
    {
        return $this->hasOne('App\Models\ProgramBuilder', 'id', 'program_builder_id');
    }
    

}
