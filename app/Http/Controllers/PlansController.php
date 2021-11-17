<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\Goal;
use App\Models\Approach;
use App\Models\Plan;
use App\Models\PlanDay;

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
        $existingPlan = Plan::where('phone_number', request('phone_number'))->where('status', 'ACTIVE')
            ->first();
        if ($existingPlan) { 
            return redirect('/existing');
        }
        $plan = new Plan();
        $plan->goal_id = request('goal_id');
        $plan->approach_id = request('approach_id');
        $plan->days = request('days');
        $plan->goal_initial = request('goal_initial');
        $plan->phone_number = '+' . request('countryCode') . request('phone_number');
        // convert time request to UTC 
        // example i say i want my text at 16:00 
        // and i live in eastern time (UTC -5)
        // save my message_time to be 21; (16 - -5) = 21
        $plan->message_time = request('message_time') - request('timezone');
        
        $plan->save();
        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $client->messages->create($plan->phone_number,
                array(
                    'from' => env('TWILIO_NUMBER'),
                    'body' => 'Thanks for signing up! We will text you from this number for the next ' . $plan->days . ' days to check on your experiment. Reply STOP to unsubscribe.'
                    )
                );
        return redirect('/thanks');
    }

    public function thanks() {
        return view('thanks');
    }

    public function existing() {
        return view('existing');
    }

    public function summary() {
        $plan = Plan::where('summary', request('summary'))->first();
        $goal = Goal::where('id', $plan->goal_id)->first();
        $approach = Approach::where('id', $plan->approach_id)->first();
        $successDays = PlanDay::where('outcome', 1)->where('plan_id', $plan->id)->count();
        $percentCompleted = $successDays / $plan->days;
        $percentFriendly = number_format( $percentCompleted * 100, 0) . '%';
        return view('summary')->with([
            'plan' => $plan,
            'success_days' => $successDays,
            'percent' => $percentFriendly,
            'initial' => $plan->goal_initial,
            'end' => $plan->goal_end,
            'approach_name' => $approach->name,
            'goal_name' => $goal->name,
            'measurement' => $goal->measurement
        ]);
    }
}