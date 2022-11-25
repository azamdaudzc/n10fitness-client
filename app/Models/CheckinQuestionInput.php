<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CheckinQuestionInput
 *
 * @property $id
 * @property $input_type
 * @property $label
 * @property $placeholder
 * @property $is_required
 * @property $display_order
 * @property $checkin_question_id
 * @property $created_at
 * @property $updated_at
 *
 * @property CheckinQuestion $checkinQuestion
 * @property UserCheckinAnswer[] $userCheckinAnswers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CheckinQuestionInput extends Model
{

    static $rules = [
		'input_type' => 'required',
		'label' => 'required',
		'placeholder' => 'required',
		'is_required' => 'required',
		'checkin_question_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['input_type','label','placeholder','is_required','display_order','checkin_question_id','options'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function checkinQuestion()
    {
        return $this->hasOne('App\Models\CheckinQuestion', 'id', 'checkin_question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userCheckinAnswers()
    {
        return $this->hasMany('App\Models\UserCheckinAnswer', 'checkin_question_input_id', 'id');
    }


}
