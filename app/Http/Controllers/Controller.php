<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmail;
use App\Models\UserProgram;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProgramBuilderWeek;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateprofile(Request $request, $file)
    {
        $p = $request->input();
        $path = '';

        if ($request->file($file)) {
            $request->validate([
                $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imagePath = $request->file($file);
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file($file)->storeAs('public/profileimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }


    public function saveThumbnailImage(Request $request, $file)
    {

        $path = '';

        if ($file) {
            // $request->validate([
            //     $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            $imagePath = $file;
            $imageName = $imagePath->getClientOriginalName();
            $path = $file->storeAs('public/thumbnailimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }

    public function saveCheckInAnswerImage(Request $request, $file)
    {

        $path = '';

        if ($file) {
            // $request->validate([
            //     $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            $imagePath = $file;
            $imageName = $imagePath->getClientOriginalName();
            $path = $file->storeAs('public/checkinquestionimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }


    function sendNotification($user_id,$name,$message,$url = null ,$type = null){
        Notification::create([
            'user_id' => $user_id,
            'name' => $name,
            'notification_type' => $type,
            'message' => $message,
            'url' => $url,
        ]);
        $user=User::find($user_id);
        switch ($type) {
           case 'ExerciseLibraryApproved':
               $email_name="Exercise Library Approved";
               break;
           case 'ExerciseLibraryRejected':
               $email_name="Exercise Library Rejected";
               break;
           case 'ProgramApproved':
               $email_name="Program Approved";
               break;
           case 'ProgramRejected':
               $email_name="Program Rejected";
               break;
           case 'WarmupApproved':
               $email_name="Warmup Approved";
               break;
           case 'WarmupRejected':
               $email_name="Warmup Rejected";
               break;
           case 'CoachClientAssigned':
               $email_name="Coach Client Assigned";
               break;
           case 'CoachClientRemoved':
               $email_name="Coach Client Removed";
               break;
           case 'ProgramDayCompleted':
               $email_name="Program Day Completed";
               break;
           case 'ExerciseLibraryCreated':
               $email_name="Exercise Library Created";
               break;
           case 'ProgramAssigned':
               $email_name="Program     Assigned";
               break;
           case 'ProgramRemoved':
               $email_name="Program Removed";
               break;
           case 'ProgramCreated':
               $email_name="Program Created";
               break;
           case 'ProgramShared':
               $email_name="Program Shared";
               break;
           case 'ProgramShareRemoved':
               $email_name="Program Share Removed";
               break;
           case 'WarmupCreated':
               $email_name="Warmup Created";
               break;

           default:
               $email_name="SomePage";
               break;
        }
        $details = [
           'email' => $user->email,
           'name' => $email_name,
           'title' => $name,
            'message' => $message,
           'user_name' => $user->first_name.' '.$user->last_name,

       ];
        SendEmail::dispatch($details);

    }


    function clientExerciseCompleted($day_id){
        $program_day=ProgramBuilderWeekDay::where('id',$day_id)->get()->first();
        ProgramBuilderWeekDay::where('id',$day_id)->update(['is_completed' => 1]);
        $max_day_id=ProgramBuilderWeekDay::where('program_builder_week_id',$program_day->program_builder_week_id)->max('id');
        if($max_day_id==$day_id){
            ProgramBuilderWeek::where('id',$program_day->program_builder_week_id)->update(['is_completed' => 1]);
        }
        $program_id=ProgramBuilderWeek::where('id',$program_day->program_builder_week_id)->first()->program_builder_id;
        $max_week_id=ProgramBuilderWeek::where('program_builder_id',$program_id)->max('id');
        if($max_week_id==$program_day->program_builder_week_id){
            UserProgram::where('program_builder_id',$program_id)->where('user_id',Auth::user()->id)->update(['is_completed' => 1]);
        }
    }

}
