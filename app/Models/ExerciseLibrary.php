<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExerciseLibrary
 *
 * @property $id
 * @property $name
 * @property $video_link
 * @property $avatar
 * @property $category_id
 * @property $equipment_id
 * @property $movement_pattern_id
 * @property $created_by
 * @property $description
 * @property $top_three_cues
 * @property $approved_by
 * @property $rejected_by
 * @property $created_at
 * @property $updated_at
 *
 * @property ExcerciseLibraryMuscle[] $excerciseLibraryMuscles
 * @property ExerciseCategory $exerciseCategory
 * @property ExerciseEquipment $exerciseEquipment
 * @property ExerciseMovementPattern $exerciseMovementPattern
 * @property ProgramBuilderDayExercise[] $programBuilderDayExercises
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExerciseLibrary extends Model
{



    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
     protected $fillable = ['name','video_link','avatar','category_id','equipment_id','movement_pattern_id','created_by','description','top_three_cues','approved_by','rejected_by'];
// protected $guarded= [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function excerciseLibraryMuscles()
    {
        return $this->hasMany('App\Models\ExcerciseLibraryMuscle', 'exercise_library_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseCategory()
    {
        return $this->hasOne('App\Models\ExerciseCategory', 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseEquipment()
    {
        return $this->hasOne('App\Models\ExerciseEquipment', 'id', 'equipment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseCreator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exerciseMovementPattern()
    {
        return $this->hasOne('App\Models\ExerciseMovementPattern', 'id', 'movement_pattern_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programBuilderDayExercises()
    {
        return $this->hasMany('App\Models\ProgramBuilderDayExercise', 'exercise_library_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }


    public static function rules(){
        return [
            'name' => 'required',
            'category_id' => 'required',
            'equipment_id' => 'required',
            'movement_pattern_id' => 'required',

        ];
    }
}
