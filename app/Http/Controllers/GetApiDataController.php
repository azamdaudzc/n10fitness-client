<?php

namespace App\Http\Controllers;

use App\Models\UserCheckin;
use App\Models\UserProgram;
use App\Models\AthleticType;
use Illuminate\Http\Request;
use App\Models\CheckinQuestion;
use App\Models\UserCheckinAnswer;
use App\Models\ProgramBuilderWeek;
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

        $id=$request->checkin_question_id;
        $new_data='not_available';
        $ques_display_order=CheckinQuestion::find($id)->display_order;

        unset($request['question_id']);
        unset($request['_token']);
        $input=$request->all();
        if(UserCheckin::where('user_id',Auth::user()->id)->where('is_completed',null)->exists()){
            $checkin_id=UserCheckin::where('user_id',Auth::user()->id)->where('is_completed',null)->get()->first()->id;
        }
        else{
            $checkin=UserCheckin::create([
                'user_id' => Auth::user()->id,
                'checkin_time' => \Carbon\Carbon::now(),
            ]);
            $checkin_id=$checkin->id;
        }

        foreach (json_decode($request->answer) as  $value) {


            UserCheckinAnswer::create([
                        'user_checkin_id' => $checkin_id,
                        'checkin_question_input_id' =>$value->questionId,
                        'checkin_question_id' => $id,
                        'answer' => $value->questionVal,
                    ]);

        }

        UserCheckin::where('id',$checkin_id)->update(['last_answered_question' =>  $ques_display_order]);
        if(CheckinQuestion::where('display_order','>',$ques_display_order)->count('id') > 0){
            $new_data='available';
        }
        else{
            UserCheckin::where('user_id',Auth::user()->id)->update(['is_completed' => 1]);
        }
        return response()->json([
            'new_data' => $new_data,
        ]);

    }


    public function uploadImage(Request $request)
    {

        $file = $request->file('image');
        $filename=$this->saveCheckInAnswerImage($request,$file);
        return $filename;

    }


    public function getUserPrograms(){
        $data['programs'] = UserProgram::where('user_id', Auth::user()->id)->with('program', 'program.coach')->get();

    }

    public function getUserProgramWeeks(Request $request){
        $user_program = UserProgram::where('user_id', Auth::user()->id)
        ->where('id', $request->id)
        ->with('program', 'program.coach')->get()->first();

        $program_weeks=ProgramBuilderWeek::where('program_builder_id',$user_program->program_builder_id)->get();
        $data['program']=$user_program;
        $data['program_weeks']=$program_weeks;
        return $data;
    }

}
