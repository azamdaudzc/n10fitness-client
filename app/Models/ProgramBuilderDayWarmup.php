<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramBuilderDayWarmup
 *
 * @property $id
 * @property $program_builder_week_day_id
 * @property $warmup_builder_id
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilderWeekDay $programBuilderWeekDay
 * @property WarmupBuilder $warmupBuilder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProgramBuilderDayWarmup extends Model
{
    
    static $rules = [
		'program_builder_week_day_id' => 'required',
		'warmup_builder_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['program_builder_week_day_id','warmup_builder_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programBuilderWeekDay()
    {
        return $this->hasOne('App\Models\ProgramBuilderWeekDay', 'id', 'program_builder_week_day_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function warmupBuilder()
    {
        return $this->hasOne('App\Models\WarmupBuilder', 'id', 'warmup_builder_id');
    }
    

}
