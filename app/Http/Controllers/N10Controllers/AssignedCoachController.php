<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\ClientCoach;
use Illuminate\Http\Request;
use App\Models\ProgramBuilder;
use Illuminate\Support\Facades\Auth;

class AssignedCoachController
{

    public function index(Request $request)
    {
        $data['coaches'] = ClientCoach::where('client_id', Auth::user()->id)->with('coach')->get();
        return view('N10Pages.coach')->with($data);
    }
}
