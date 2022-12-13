<?php

use App\Models\UserCheckin;
use App\Models\CheckinQuestion;
use App\Models\Notification;
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

function getNotifications(){
    return Notification::where('user_id',Auth::user()->id)->where('read',0)->get();
}

function getNotificationCount(){
    return Notification::where('user_id',Auth::user()->id)->where('read',0)->count('id');
}



function notificationWhereToGo($type){
    $url=url('/');
    switch ($type) {
        case 'ExerciseLibraryApproved':
            $url=route('exercise.library.index').'?goto=1';
            break;
        case 'ExerciseLibraryRejected':
            $url=route('exercise.library.index').'?goto=3';
            break;
        case 'ProgramApproved':
            $url=route('program.builder.index').'?goto=1';
            break;
        case 'ProgramRejected':
            $url=route('program.builder.index').'?goto=3';
            break;
        case 'WarmupApproved':
            $url=route('warmup.builder.index').'?goto=1';
            break;
        case 'WarmupRejected':
            $url=route('warmup.builder.index').'?goto=3';
            break;
        case 'CoachClientAssigned':
            $url=route('user.coach.index');
            break;
        case 'CoachClientRemoved':
            $url=route('user.coach.index');
            break;
        case 'ProgramDayCompleted':
            $url=route('program.builder.index');
            break;
        case 'ExerciseLibraryCreated':
            $url=route('exercise.library.index').'?goto=2';
            break;
        case 'ProgramAssigned':
            $url=route('program.builder.index');
            break;
        case 'ProgramRemoved':
            $url=route('program.builder.index');
            break;
        case 'ProgramCreated':
            $url=route('program.builder.index');
            break;
        case 'ProgramShared':
            $url=route('program.builder.index');
            break;
        case 'ProgramShareRemoved':
            $url=route('program.builder.index');
            break;
        case 'WarmupCreated':
            $url=route('warmup.builder.index').'?goto=2';
            break;

        default:

            break;
     }
     return $url;
}
