<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\ClientCoach;
use App\Models\UserProgram;
use App\Models\WarmupVideo;
use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Models\ProgramBuilder;
use App\Models\ExerciseLibrary;
use App\Models\ProgramBuilderWeek;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ExerciseLibraryMuscle;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use Illuminate\Validation\Rules\Exists;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseSet;
use App\Models\ProgramBuilderDayExerciseInput;

class ProgramInfoController extends Controller
{

   public function warmupInfo(Request $request){

    $page_heading = 'WarmupBuilder';
    $sub_page_heading = collect(['User', 'WarmupBuilder']);
    $data = new WarmupBuilder();
    $title="Add WarmupBuilder";
    if($request->id){
        $title="Edit WarmupBuilder";
        $data = WarmupBuilder::find($request->id);
    }
    $videos = WarmupVideo::where('warmup_builder_id', $request->id)->get();

    return view('N10Pages.ProgramInfoPages.warmup',compact('videos','data','title','page_heading','sub_page_heading'));
   }


   public function exerciseInfo(Request $request){
    $page_heading = 'ExerciseLibrary';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new ExerciseLibrary();
        $title="Add ExerciseLibrary";
        if($request->id){
            $title="Edit ExerciseLibrary";
            $data = ExerciseLibrary::where('id',$request->id)->with('exerciseCategory','exerciseEquipment','exerciseMovementPattern')->get()->first();
        }
        $library_muscles = ExerciseLibraryMuscle::where('exercise_library_id', $request->id)->with('exerciseMuscle')->get();
    return view('N10Pages.ProgramInfoPages.exercise',compact('library_muscles','data','title','page_heading','sub_page_heading'));

   }
}
