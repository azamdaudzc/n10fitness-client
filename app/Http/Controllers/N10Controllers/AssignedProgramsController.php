<?php

namespace App\Http\Controllers\N10Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClientCoach;
use App\Models\UserProgram;
use Illuminate\Http\Request;
use App\Models\ProgramBuilder;
use App\Models\ProgramBuilderWeek;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseInput;
use App\Models\ProgramBuilderDayExerciseSet;
use Illuminate\Validation\Rules\Exists;

class AssignedProgramsController extends Controller
{

    public function index(Request $request)
    {
        $data['programs'] = UserProgram::where('user_id', Auth::user()->id)->with('program', 'program.coach')->get();

        return view('N10Pages.ProgramPages.programs')->with($data);
    }

    public function view($id = 0)
    {
        $user_program = UserProgram::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->with('program', 'program.coach')->get()->first();

        $program_weeks=ProgramBuilderWeek::where('program_builder_id',$user_program->program_builder_id)->get();
        return view('N10Pages.ProgramPages.view',compact('user_program','program_weeks'));
    }
    public function view_day_prepare(Request $request){
        $date=$request->date;
        $last_id=$request->last_id;
        if(date('Y-m-d')>$request->date){
            $this->fillMissedDays($request->id);
        }
        return redirect( route('assigned.programs.view-day',[ $request->id,$request->last_id] ) );
    }

    public function view_week($id = 0,$last_id=0)
    {
        if($last_id != 0 ){

        }
        $program_week=ProgramBuilderWeek::where('id',$id)->get()->first();
        $program_id=ProgramBuilderWeek::where('id',$program_week->id)->first()->program_builder_id;
        $user_program=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->get()->first();
        if($user_program->start_date == null ){
            UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->update(['start_date' => \Carbon\Carbon::now()->startOfWeek()]);
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
        return view('N10Pages.ProgramPages.view-week',compact('current_date','saved_current_date','program_week','week_days','start_date','end_date','last_id','ans_exists'));
    }
    public function view_day($id = 0,$last_id = 0)
    {


        $program_day=ProgramBuilderWeekDay::where('id',$id)->get()->first();
        //last week
        if($last_id>0){
        $day_no=$program_day->day_no;
        $last_week_id=$last_id;
        $last_week_obj=ProgramBuilderWeek::find($last_week_id);
        $last_day=ProgramBuilderWeekDay::where('program_builder_week_id',$last_week_obj->id)->get()->first();
        $last_exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$last_day->id)->with('exerciseLibrary')->get();
        $user_program_id=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$last_week_obj->program_builder_id)->get()->first()->id;
        foreach ($last_exercises as $value) {
            $last_exercise_sets[$value->exercise_library_id]=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
            $last_exercise_sets[$value->exercise_library_id]=ProgramBuilderDayExerciseInput::where('day_exercise_id',$value->id)
            ->where('program_builder_id',$last_week_obj->program_builder_id)
            ->where('user_program',$user_program_id)->get()->first();
        }
        }
        else{
            $last_exercise_sets=null;
        }
        //last week
        $week_obj=ProgramBuilderWeek::find($program_day->program_builder_week_id);
        $week = $week_obj->week_no;
        $warmups=ProgramBuilderDayWarmup::where('program_builder_week_day_id',$id)->with('warmupBuilder')->get();
        $exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$id)->with('exerciseLibrary')->get();
        $day_id=$id;
        $user_program_id=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$week_obj->program_builder_id)->get()->first()->id;
        $exists=ProgramBuilderDayExerciseInput::where('day_exercise_id',$exercises->first()->id)
        ->where('program_builder_id',$week_obj->program_builder_id)
        ->where('user_program',$user_program_id)->exists();
        foreach ($exercises as $value) {
            $exercise_sets[$value->id]=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
            $answeres_temp=ProgramBuilderDayExerciseInput::where('day_exercise_id',$value->id)
            ->where('program_builder_id',$week_obj->program_builder_id)
            ->where('user_program',$user_program_id)->get();
            foreach ($answeres_temp as $ans) {
                $answeres[$value->id][$ans->set_no]=$ans;
            }

        }

        if($exists){

            return view('N10Pages.ProgramPages.view-completed-day',compact('week','day_id','program_day','warmups','exercises','exercise_sets','answeres','last_exercise_sets'));
        }
        return view('N10Pages.ProgramPages.view-day',compact('week','day_id','program_day','warmups','exercises','exercise_sets','last_exercise_sets'));
    }

    public function store_day(Request $request){
        $input=$request->all();
        $program_day=ProgramBuilderWeekDay::where('id',$request->day_id)->get()->first();
        $program_id=ProgramBuilderWeek::where('id',$program_day->program_builder_week_id)->first()->program_builder_id;
        $user_program_id=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->get()->first()->id;
        $exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$request->day_id)->with('exerciseLibrary')->get();
        foreach ($exercises as $value) {
            $exercise_set=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
            for ($i=1; $i <= $exercise_set->set_no; $i++) {
                ProgramBuilderDayExerciseInput::create([
                    'day_exercise_id' => $value->id,
                    'program_builder_id' => $program_id,
                    'user_program' => $user_program_id,
                    'set_no' => $i,
                    'weight' => $input['w_e_'.$value->id.'_s_'.$i],
                    'reps' => $input['r_e_'.$value->id.'_s_'.$i],
                    'rpe' => $exercise_set->rpe_no,
                    'peak_exterted_max' => $input['mai_e_'.$value->id.'_s_'.$i],

                ]);
            }
        }
        $name='Program Day Completed';
        $message=Auth::user()->first_name.' '.Auth::user()->last_name.' finished day'.$program_day->day_no;
        $this->sendNotification(ProgramBuilder::find($program_id)->created_by,$name,$message);
        return response()->json(['success' => true]);
    }

    public function fillMissedDays($id){

        $program_day=ProgramBuilderWeekDay::where('id',$id)->get()->first();
        $week_obj=ProgramBuilderWeek::find($program_day->program_builder_week_id);
        $exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$id)->with('exerciseLibrary')->get();
        $user_program_id=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$week_obj->program_builder_id)->get()->first()->id;

        foreach ($exercises as $value) {
            $exercise_sets[$value->id]=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
            $answere=ProgramBuilderDayExerciseInput::where('day_exercise_id',$value->id)
            ->where('program_builder_id',$week_obj->program_builder_id)
            ->where('user_program',$user_program_id)->exists();
            if(!$answere){
                $set=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
                for ($i=1; $i <= $set->set_no; $i++) {

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

    }
}
