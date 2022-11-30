<?php

namespace App\Http\Controllers\UserControllers;

use App\Models\UserCheckin;
use Illuminate\Http\Request;
use App\Models\CheckinQuestion;
use App\Http\Controllers\Controller;
use App\Models\CheckinQuestionInput;
use App\Models\UserCheckinAnswer;
use Illuminate\Support\Facades\Auth;

class UserCheckinController extends Controller
{

    public function list(Request $request)
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
            return response()->json(['done'=>'done']);
        }
        $page_heading = 'Checkin Question';
        $sub_page_heading = collect(['User', 'Checkin Questions']);
        $title = "Checkin Question";
        if ($checkin_questions->count()>0) {
            $data = $checkin_questions->first();
            $question_inputs = CheckinQuestionInput::where('checkin_question_id', $data->id)->get();
        }
        else{
            return response()->json(['done'=>'done']);
        }

        return view('N10Pages.CheckQuestions.form', compact('question_inputs', 'data', 'title', 'page_heading', 'sub_page_heading'));
    }

    public function store(Request $request){

        $id=$request->question_id;
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
        foreach ($input as $key => $value) {
            $splitted=explode('-',$key);
            if(!is_array($value) &&  is_file($value)){
                $image = $this->saveCheckInAnswerImage($request,$value);
                $value=$image;
            }
            else{
                $value=json_encode($value);
            }
            UserCheckinAnswer::create([
                'user_checkin_id' => $checkin_id,
                'checkin_question_input_id' => $splitted[0],
                'checkin_question_id' => $id,
                'answer' => $value,
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
}
