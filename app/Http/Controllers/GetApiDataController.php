<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\UserCheckin;
use App\Models\UserProgram;
use App\Models\AthleticType;
use Illuminate\Http\Request;
use App\Models\ProgramBuilder;
use App\Models\CheckinQuestion;
use App\Models\UserCheckinAnswer;
use App\Models\ProgramBuilderWeek;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseSet;
use App\Models\ProgramBuilderDayExerciseInput;

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


  
    public function getUserProgramWeeks(Request $request){
        $user_program = UserProgram::where('user_id', Auth::user()->id)->with('program', 'program.coach')->get()->first();
        if($user_program){
            $program_id= $user_program->program_builder_id;
        }
        else{
            return response()->json([
                'success' => false,
                'msg' => 'user has no programs'
            ]);
        }

        $program_weeks=ProgramBuilderWeek::where('program_builder_id',$program_id)->get();
        $data['program']=$user_program;
        $data['program_weeks']=$program_weeks;
        return $data;
    }

    public function getUserProgramDays(Request $request){
       $id=$request->week_id;
       $last_id=$request->last_week_id;
        $program_week=ProgramBuilderWeek::where('id',$id)->get()->first();
        $program_id=ProgramBuilderWeek::where('id',$program_week->id)->first()->program_builder_id;
        $user_program=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->get()->first();
        if($user_program->start_date == null ){
            UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->update(['start_date' => \Carbon\Carbon::now()->startOfWeek()]);
            $user_program=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->get()->first();

        }

        $start_date=date('Y-m-d', strtotime($user_program->start_date. ' + '.(($program_week->week_no-1) * 7).' days'));
        $end_date=date('Y-m-d', strtotime($user_program->start_date. ' + '.($program_week->week_no * 7).' days'));
        $current_date='';
        $saved_current_date='';

        $week_days=ProgramBuilderWeekDay::where('program_builder_week_id',$program_week->id)->get();
        $ans_exists=null;
        foreach ($week_days as $value) {
            $exercises_test=ProgramBuilderDayExercise::where('builder_week_day_id',$value->id)->get();
            foreach ($exercises_test as $palue) {
                $exercise_sets_test=ProgramBuilderDayExerciseSet::where('program_week_days',$palue->id)->get()->first();
                $answeres_temp=ProgramBuilderDayExerciseInput::where('day_exercise_id',$palue->id)
                ->where('program_builder_id',$program_id)
                ->where('user_program',$user_program->id)->exists();
                if($answeres_temp){
                    $ans_exists[$value->id]=1;
                }

            }
        }
        $data['current_date']=$current_date;
        $data['saved_current_date']=$saved_current_date;
        $data['program_week']=$program_week;
        $data['week_days']=$week_days;
        $data['start_date']=$start_date;
        $data['end_date']=$end_date;
        $data['last_id']=$last_id;
        $data['ans_exists']=$ans_exists;
        $calculated_days=array();
        $period = new DatePeriod(new DateTime($start_date), new DateInterval('P1D'), new DateTime($end_date));
        foreach ($period as $key => $value){
            $found = 0;
            foreach ($week_days as $wd){
            if ($wd->day_title == strtolower($value->format('l'))){

                    $found = 1;
                    $day_no = $wd->day_no;
                    $day_id = $wd->id;
                    $peta[$value->format('Y-M-d')]['day_no']=$day_no;
                    $peta[$value->format('Y-M-d')]['date']=$value->format('Y-M-d');
                    $peta[$value->format('Y-M-d')]['date_to_send'] = $value->format('Y-m-d');
                    $peta[$value->format('Y-M-d')]['day_title']= $value->format('l');
                    $peta[$value->format('Y-M-d')]['day_id'] = $day_id;
                    if (date('Y-m-d') == $value->format('Y-m-d')){
                        if(isset($ans_exists[$day_id])){
                            $peta[$value->format('Y-M-d')]['four']= 'done';

                        }else{
                            $peta[$value->format('Y-M-d')]['four']= 'start';

                        }
                    }
                    else if (date('Y-m-d') >= $value->format('Y-m-d')){
                        $peta[$value->format('Y-M-d')]['four']= 'closed';

                     }
            }
            
        }
        if($found==0){
                $peta[$value->format('Y-M-d')]['four'] = 'Rest Day';
                $peta[$value->format('Y-M-d')]['date'] = $value->format('Y-M-d');
                $peta[$value->format('Y-M-d')]['date_to_send'] = $value->format('Y-m-d');
                $peta[$value->format('Y-M-d')]['day_title'] = $value->format('l');
        }

       
        }
        $data['calculated_days']= $peta;
        return $data;


}


    function getUserProgramDayInfo (Request $request){
        
        if (date('Y-m-d') > $request->date) {
            return $this->fillMissedDays($request->day_id, $request->last_id);
        }
        else{
         return $this->get_day_data($request->day_id,$request->last_id);
        }
    }

  

    public function get_day_data($id, $last_id )
    {

        $back_url = route('assigned.programs.view-week', [$id, $last_id]);

        $program_day = ProgramBuilderWeekDay::where('id', $id)->get()->first();
        //last week
        if ($last_id > 0) {
            $day_no = $program_day->day_no;
            $last_week_id = $last_id;
            $last_week_obj = ProgramBuilderWeek::find($last_week_id);
            $last_day = ProgramBuilderWeekDay::where('program_builder_week_id', $last_week_obj->id)->get()->first();
            $last_exercises = ProgramBuilderDayExercise::where('builder_week_day_id', $last_day->id)->with('exerciseLibrary')->get();
            $user_program_id = UserProgram::where('user_id', Auth::user()->id)->where('program_builder_id', $last_week_obj->program_builder_id)->get()->first()->id;
            foreach ($last_exercises as $value) {
                $last_exercise_sets[$value->exercise_library_id] = ProgramBuilderDayExerciseSet::where('program_week_days', $value->id)->get()->first();
                $last_exercise_sets[$value->exercise_library_id] = ProgramBuilderDayExerciseInput::where('day_exercise_id', $value->id)
                    ->where('program_builder_id', $last_week_obj->program_builder_id)
                    ->where('user_program', $user_program_id)->get()->first();
            }
        } else {
            $last_exercise_sets = null;
        }
        //last week
        $week_obj = ProgramBuilderWeek::find($program_day->program_builder_week_id);
        $week = $week_obj->week_no;
        $warmups = ProgramBuilderDayWarmup::where('program_builder_week_day_id', $id)->with('warmupBuilder')->get();
        $exercises = ProgramBuilderDayExercise::where('builder_week_day_id', $id)->with('exerciseLibrary')->get();
        $day_id = $id;
        $user_program_id = UserProgram::where('user_id', Auth::user()->id)->where('program_builder_id', $week_obj->program_builder_id)->get()->first()->id;
        $exists = ProgramBuilderDayExerciseInput::where('day_exercise_id', $exercises->first()->id)
        ->where('program_builder_id', $week_obj->program_builder_id)
        ->where('user_program', $user_program_id)->exists();
        $answeres=null;
        foreach ($exercises as $value) {
            $exercise_sets[$value->id] = ProgramBuilderDayExerciseSet::where('program_week_days', $value->id)->get()->first();
            $answeres_temp = ProgramBuilderDayExerciseInput::where('day_exercise_id', $value->id)
                ->where('program_builder_id', $week_obj->program_builder_id)
                ->where('user_program', $user_program_id)->get();
            foreach ($answeres_temp as $ans) {
                $answeres[$value->id][$ans->set_no] = $ans;
            }
        }

        $data['week']= $week;
        $data['day_id']= $day_id;
        $data['program_day']= $program_day;
        $data['warmups']= $warmups;
        $data['exercises']= $exercises;
        $data['exercise_sets']= $exercise_sets;
        $data['answeres']= $answeres;
        $data['last_exercise_sets']= $last_exercise_sets;
          return $data;
    }

    public function store_day(Request $request)
    {
        $input = $request->all();
        $program_day = ProgramBuilderWeekDay::where('id', $request->day_id)->get()->first();
        $program_id = ProgramBuilderWeek::where('id', $program_day->program_builder_week_id)->first()->program_builder_id;
        $user_program_id = UserProgram::where('user_id', Auth::user()->id)->where('program_builder_id', $program_id)->get()->first()->id;
        $exercises = ProgramBuilderDayExercise::where('builder_week_day_id', $request->day_id)->with('exerciseLibrary')->get();
        foreach ($exercises as $value) {
            $exercise_set = ProgramBuilderDayExerciseSet::where('program_week_days', $value->id)->get()->first();
            for ($i = 1; $i <= $exercise_set->set_no; $i++) {
                ProgramBuilderDayExerciseInput::create([
                    'day_exercise_id' => $value->id,
                    'program_builder_id' => $program_id,
                    'user_program' => $user_program_id,
                    'set_no' => $i,
                    'weight' => $input['w_e_' . $value->id . '_s_' . $i],
                    'reps' => $input['r_e_' . $value->id . '_s_' . $i],
                    'rpe' => $exercise_set->rpe_no,
                    'peak_exterted_max' => $input['mai_e_' . $value->id . '_s_' . $i],

                ]);
            }
        }
        $name = 'Program Day Completed';
        $message = Auth::user()->first_name . ' ' . Auth::user()->last_name . ' finished day' . $program_day->day_no;
        $this->sendNotification(ProgramBuilder::find($program_id)->created_by, $name, $message);
        return response()->json(['success' => true]);
    }

    public function fillMissedDays($id,$last_id)
    {

        $program_day = ProgramBuilderWeekDay::where('id', $id)->get()->first();
        $week_obj = ProgramBuilderWeek::find($program_day->program_builder_week_id);
        $exercises = ProgramBuilderDayExercise::where('builder_week_day_id', $id)->with('exerciseLibrary')->get();
        $user_program_id = UserProgram::where('user_id', Auth::user()->id)->where('program_builder_id', $week_obj->program_builder_id)->get()->first()->id;

        foreach ($exercises as $value) {
            $exercise_sets[$value->id] = ProgramBuilderDayExerciseSet::where('program_week_days', $value->id)->get()->first();
            $answere = ProgramBuilderDayExerciseInput::where('day_exercise_id', $value->id)
                ->where('program_builder_id', $week_obj->program_builder_id)
                ->where('user_program', $user_program_id)->exists();
            if (!$answere) {
                $set = ProgramBuilderDayExerciseSet::where('program_week_days', $value->id)->get()->first();
                for ($i = 1; $i <= $set->set_no; $i++) {

                    ProgramBuilderDayExerciseInput::create([
                        'day_exercise_id' => $value->id,
                        'program_builder_id' => $week_obj->program_builder_id,
                        'user_program' => $user_program_id,
                        'set_no' => $i,
                        'weight' => 0,
                        'reps' => 0,
                        'rpe' => $set->rpe_no,
                        'peak_exterted_max' => 0,

                    ]);
                }
            }
        }

        return $this->get_day_data($id, $last_id);

    }
    
}
