<?php

namespace App\Http\Controllers;

use App\Models\UserCheckin;
use App\Models\AthleticType;
use Illuminate\Http\Request;
use App\Models\CheckinQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetApiDataController extends Controller
{
    //
    public function getAthleticTypes(){

        return response()->json(['success' => true, 'athletic_types' =>  AthleticType::all()]);

    }
    public function getCheckinQuestions(){
        if(!Auth::user()){
            return response()->json(['user' => 'Not Authorized']);
        }
        $check_in = UserCheckin::where('user_id', Auth::user()->id)->latest('checkin_time')->first();

        if ($check_in && $check_in->checkin_time <= now()->subDays(7)->setTime(0, 0, 0)->toDateTimeString()) {
            $checkin_questions = CheckinQuestion::with('checkinQuestionInputs')
                ->orderBy('checkin_questions.display_order')->take(1)->get()->first();
        } else if ($check_in && $check_in->is_completed == null) {
            $checkin_questions = CheckinQuestion::with('checkinQuestionInputs')
                ->where('display_order', '>', $check_in->last_answered_question)
                ->orderBy('checkin_questions.display_order')->take(1)->get()->first();
        }
        else if(!$check_in){
            $checkin_questions = CheckinQuestion::with('checkinQuestionInputs')
            ->orderBy('checkin_questions.display_order')->take(1)->get()->first();
        } else {
            return response()->json(['done'=>'done']);
        }
        return  $checkin_questions;
    }

    public function saveCheckinAnswer(Request $request){
        return $input=$request->all();
        //set body as raw and json
        // {
        //     "checkin_question_id" : 1,
        //     "answer" : [
        //         {
        //         "1" : "ans 1"
        //         },
        //         {"2" : "ans 2"}

        //     ]
        // }

    }
}
