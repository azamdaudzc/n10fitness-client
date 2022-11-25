<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExerciseEquipment
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property ExerciseLibrary[] $exerciseLibrarys
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExerciseEquipment extends Model
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
    public function exerciseLibrarys()
    {
        return $this->hasMany('App\Models\ExerciseLibrary', 'equipment_id', 'id');
    }
    

}
