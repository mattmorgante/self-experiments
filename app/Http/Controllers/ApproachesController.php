<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Goal;
use App\Models\Approach;
use App\Models\GoalApproach;


class ApproachesController extends Controller
{
    public function index($goalId) { 
        $goal = Goal::where('id', $goalId)->first();
        $approachIds = GoalApproach::where('goal_id', $goalId)->pluck('approach_id')->toArray();
        $approaches = Approach::whereIn('id', $approachIds)->get();
        // display approaches associated with that goal  
        // select approach_id from goals_approaches where goal_id = $goalId
        // select name from approaches where approaches in (approach_ids)
        return view('approaches')->with([
            'approaches' => $approaches,
            'goal' => $goal
        ]);
    }

    public function saveApproach($approachId, $goalId) { 
        // passing through the goalID and the approachID 
        // save it to the user_goals table 
        // go to the plan 
    }
}