<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CheckinQuestion
 *
 * @property $id
 * @property $question
 * @property $display_order
 * @property $created_at
 * @property $updated_at
 *
 * @property CheckinQuestionInput[] $checkinQuestionInputs
 * @property UserCheckinAnswer[] $userCheckinAnswers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CheckinQuestion extends Model
{
    
    static $rules = [
		'question' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['question','display_order'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkinQuestionInputs()
    {
        return $this->hasMany('App\Models\CheckinQuestionInput', 'checkin_question_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userCheckinAnswers()
    {
        return $this->hasMany('App\Models\UserCheckinAnswer', 'checkin_question_id', 'id');
    }
    

}
