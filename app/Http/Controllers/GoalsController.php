<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Goal;

class GoalsController extends Controller
{
    public function index()
    {
        $goals = Goal::take(10)->get();

        return view('goals')->with([
            'goals' => $goals
        ]);
    }

    public function save($goalid)
    {
        // pass through the goal 
        // save it to the db table users_goals 
        // call approaches 
    }

}