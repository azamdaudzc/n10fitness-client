<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WarmupVideo
 *
 * @property $id
 * @property $video_url
 * @property $thumbnail
 * @property $warmup_builder_id
 * @property $created_at
 * @property $updated_at
 *
 * @property WarmupBuilder $warmupBuilder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WarmupVideo extends Model
{
    
    static $rules = [
		'video_url' => 'required',
		'warmup_builder_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['video_url','thumbnail','warmup_builder_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function warmupBuilder()
    {
        return $this->hasOne('App\Models\WarmupBuilder', 'id', 'warmup_builder_id');
    }
    

}
