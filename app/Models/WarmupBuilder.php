<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WarmupBuilder
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $instructions
 * @property $created_by
 * @property $rejected_by
 * @property $approved_by
 * @property $created_at
 * @property $updated_at
 *
 * @property ProgramBuilderDayWarmup[] $programBuilderDayWarmups
 * @property User $user
 * @property WarmupVideo[] $warmupVideos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WarmupBuilder extends Model
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
    protected $fillable = ['name','description','instructions','created_by','rejected_by','approved_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderDayWarmups()
    {
        return $this->hasMany('App\Models\ProgramBuilderDayWarmup', 'warmup_builder_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function warmupVideos()
    {
        return $this->hasMany('App\Models\WarmupVideo', 'warmup_builder_id', 'id');
    }


}
