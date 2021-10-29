<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Goal;

class OnboardingController extends Controller
{
    public function start()
    {
        return view('start');
    }

    public function showGoals()
    {
        $goals = Goal::take(10)->get();

        return view('goals')->with([
            'goals' => $goals
        ]);
    }

    public function saveGoal($goalid)
    {
        // pass through the goal 
        // save it to the db table users_goals 
        // call approaches 
    }

    public function showApproaches($goalid) { 
        // display approaches associated with that goal  
        // select approach_id from goals_approaches where goal_id = $goalId
        // select name from approaches where approaches in (approach_ids)
        return view('approaches');
    }

    public function saveApproach($approachId, $goalId) { 
        // passing through the goalID and the approachID 
        // save it to the user_goals table 
        // go to the plan 
    }

    public function showPlan() 
    { 
        // 
        return view('plan');
    }

    public function savePlan() 
    { 
        // take the number of days & time of message and save to plans tablw 
    }

    public function saveUser() 
    {

    }
}