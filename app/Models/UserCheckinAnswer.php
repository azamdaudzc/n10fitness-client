<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCheckinAnswer
 *
 * @property $id
 * @property $answer
 * @property $user_checkin_id
 * @property $checkin_question_input_id
 * @property $checkin_question_id
 * @property $created_at
 * @property $updated_at
 *
 * @property CheckinQuestionInput $checkinQuestionInput
 * @property CheckinQuestion $checkinQuestion
 * @property UserCheckin $userCheckin
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserCheckinAnswer extends Model
{
    
    static $rules = [
		'answer' => 'required',
		'user_checkin_id' => 'required',
		'checkin_question_input_id' => 'required',
		'checkin_question_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['answer','user_checkin_id','checkin_question_input_id','checkin_question_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function checkinQuestionInput()
    {
        return $this->hasOne('App\Models\CheckinQuestionInput', 'id', 'checkin_question_input_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function checkinQuestion()
    {
        return $this->hasOne('App\Models\CheckinQuestion', 'id', 'checkin_question_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userCheckin()
    {
        return $this->hasOne('App\Models\UserCheckin', 'id', 'user_checkin_id');
    }
    

}
