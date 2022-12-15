<?php

namespace App\Http\Controllers;

use App\Models\UserProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    function index() {
        $data['page_heading'] = "Dashboard";
        $data['sub_page_heading'] = "main dashboard";
        $data['program']=UserProgram::where('user_id',Auth::user()->id)->with('program')->get()->first();
        return view('dashboard')->with($data);
    }
}
