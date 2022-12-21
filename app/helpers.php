<?php

use App\Models\UserCheckin;
use App\Models\UserProgram;
use App\Models\Notification;
use App\Models\CheckinQuestion;
use App\Models\ProgramBuilderWeek;
use Illuminate\Support\Facades\Auth;

function checkinQuestionAvailability()
{
    $check_program=UserProgram::where('user_id')->where('is_completed','=',null)->first();
    if(!$check_program){
        return false;
    }
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

function getProgramCompletedPercentage(){
    $temp=UserProgram::where('user_id',Auth::user()->id)->first();
    if($temp==null) return null;
    $program=$temp->program_builder_id;
    $total=ProgramBuilderWeek::where('program_builder_id',$program)->count('id');
    $done=ProgramBuilderWeek::where('program_builder_id',$program)->where('is_completed',1)->count('id');
    if($total>0 && $done >0){
        return round(($done/$total)*100);
    }
    else{
        return 0;
    }
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
            $url=route('assigned.programs.index').'?goto=1';
            break;
        case 'ProgramRejected':
            $url=route('assigned.programs.index').'?goto=3';
            break;
        case 'WarmupApproved':
            $url=route('warmup.builder.index').'?goto=1';
            break;
        case 'WarmupRejected':
            $url=route('warmup.builder.index').'?goto=3';
            break;
        case 'CoachClientAssigned':
            $url=route('assigned.coach.index');
            break;
        case 'CoachClientRemoved':
            $url=route('assigned.coach.index');
            break;
        case 'ProgramDayCompleted':
            $url=route('assigned.programs.index');
            break;
        case 'ExerciseLibraryCreated':
            $url=route('exercise.library.index').'?goto=2';
            break;
        case 'ProgramAssigned':
            $url=route('assigned.programs.index');
            break;
        case 'ProgramRemoved':
            $url=route('assigned.programs.index');
            break;
        case 'ProgramCreated':
            $url=route('assigned.programs.index');
            break;
        case 'ProgramShared':
            $url=route('assigned.programs.index');
            break;
        case 'ProgramShareRemoved':
            $url=route('assigned.programs.index');
            break;
        case 'WarmupCreated':
            $url=route('warmup.builder.index').'?goto=2';
            break;

        default:

            break;
     }
     return $url;
}
