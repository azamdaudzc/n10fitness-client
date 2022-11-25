<?php

namespace App\Http\Controllers\N10Controllers;

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

class AssignedProgramsController
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
    public function view_week($id = 0)
    {

        $program_week=ProgramBuilderWeek::where('id',$id)->get()->first();
        $program_id=ProgramBuilderWeek::where('id',$program_week->id)->first()->program_builder_id;
        $user_program=UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->get()->first();
        if($user_program->start_date == null ){
            UserProgram::where('user_id',Auth::user()->id)->where('program_builder_id',$program_id)->update(['start_date' => \Carbon\Carbon::now()]);
        }
        $start_date=date('Y-m-d', strtotime($user_program->start_date. ' + '.(($program_week->week_no-1) * 7).' days'));
        $end_date=date('Y-m-d', strtotime($user_program->start_date. ' + '.($program_week->week_no * 7).' days'));
        $current_date='';
        $saved_current_date='';

        $week_days=ProgramBuilderWeekDay::where('program_builder_week_id',$program_week->id)->get();
        return view('N10Pages.ProgramPages.view-week',compact('current_date','saved_current_date','program_week','week_days','start_date','end_date'));
    }
    public function view_day($id = 0)
    {
        $program_day=ProgramBuilderWeekDay::where('id',$id)->get()->first();
        $warmups=ProgramBuilderDayWarmup::where('program_builder_week_day_id',$id)->with('warmupBuilder')->get();
        $exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$id)->with('exerciseLibrary')->get();
        $day_id=$id;
        foreach ($exercises as $value) {
            $exercise_sets[$value->id]=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
        }
        return view('N10Pages.ProgramPages.view-day',compact('day_id','program_day','warmups','exercises','exercise_sets'));
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
        return response()->json(['success' => true]);
    }
}
