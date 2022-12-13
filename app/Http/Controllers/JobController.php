<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Http\Controllers\Controller;
class JobController extends Controller
{
/**
 *
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
 */
public function enqueue(Request $request)
{
    $variable="ExerciseLibraryApproved";
     switch ($variable) {
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
        'email' => 'zc.arshadseja@gmail.com',
        'name' => $email_name
    ];
     SendEmail::dispatch($details);
}
}
