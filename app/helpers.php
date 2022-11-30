<?php

use App\Models\UserCheckin;
use App\Models\CheckinQuestion;
use Illuminate\Support\Facades\Auth;

function checkinQuestionAvailability()
{
    $check_in = UserCheckin::where('user_id', Auth::user()->id)->latest('checkin_time')->first();

    if ($check_in && $check_in->checkin_time <= now()->subDays(7)->setTime(0, 0, 0)->toDateTimeString()) {
        $checkin_questions = CheckinQuestion::with('checkinQuestionInputs')
            ->orderBy('checkin_questions.display_order')->take(1)->get();
    } else if ($check_in && $check_in->is_completed == null) {
        $checkin_questions = CheckinQuestion::with('checkinQuestionInputs')
            ->where('display_order', '>', $check_in->last_answered_question)
            ->orderBy('checkin_questions.display_order')->take(1)->get();
    }
    else if(!$check_in)
        {
            $checkin_questions = CheckinQuestion::with('checkinQuestionInputs')
            ->orderBy('checkin_questions.display_order')->take(1)->get();
        } else {
        return false;
    }

    if ($checkin_questions->count() > 0) {
        return true;
    } else {
        return false;
    }
}
