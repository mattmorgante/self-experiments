<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Plan;
use App\Models\PlanDay;



class SMSController extends Controller
{
    public function incoming(Request $request) 
    { 
        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $messageBody = $request->input('Body');
        $phoneNumber = $request->input('From');
        \Log::info($messageBody);

        $activePlan = Plan::where('phone_number', $phoneNumber)
            ->where('status', 'ACTIVE')
            ->orderBy('created_at', 'DESC')
            ->first();
        \Log::info(json_encode($activePlan));

        if (!$activePlan) { 
            $client->messages->create($phoneNumber,
            array(
                'from' => env('TWILIO_NUMBER'),
                'body' => 'It looks like you do not have any active plans, go to selfexperiments.com to create a new one!'
                )
            );
            return true;
        }
        
        $planDay = PlanDay::where('plan_id', $activePlan->id)
            ->whereNull('outcome')
            ->orderBy('day_number', 'DESC')
            ->first();
        
        if (!$planDay) { 
            $client->messages->create($phoneNumber,
            array(
                'from' => env('TWILIO_NUMBER'),
                'body' => 'You already checked in for today! Wait until tomorrow\'s prompt to respond again.'
                )
            );
            return true;
        }
    

        $firstCharacter = strtolower(substr($messageBody, 0, 1));
        if ($firstCharacter === 'y') {  
            \Log::info('positive response');
            $planDay->outcome = TRUE;
            $planDay->save();
            $client->messages->create($phoneNumber,
                array(
                    'from' => env('TWILIO_NUMBER'),
                    'body' => 'Nice, keep up the good work!'
                    )
                );
            return true;
            // update plan days
        } 
        if ($firstCharacter === 'n') { 
            \Log::info('negative response');
            $planDay->outcome = FALSE;
            $planDay->save();
            $client->messages->create($phoneNumber,
            array(
                'from' => env('TWILIO_NUMBER'),
                'body' => 'Don\'t be too hard on yourself. Try again tomorrow!'
                )
            );
            return true;
            // update plan days
        }
        $client->messages->create($phoneNumber,
        array(
            'from' => env('TWILIO_NUMBER'),
            'body' => "Please respond either 'Yes' or 'No' to have your response recorded."
            )
        );
        return true;
    }
}
