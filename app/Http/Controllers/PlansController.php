<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Goal;
use App\Models\Approach;

class PlansController extends Controller
{
    public function show($goal_id, $approach_id) 
    { 
        $goal = Goal::where('id', $goal_id)->first();
        $approach = Approach::where('id', $approach_id)->first();
        return view('plan')->with([
            'approach' => $approach,
            'goal' => $goal
        ]);
    }

    public function save() 
    { 
        // take the number of days & time of message and save to plans table
    }

}