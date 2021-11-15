<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;
use App\Models\Plan;
use App\Models\Approach;
use App\Models\PlanDay;
use App\Models\Goal;
use Carbon\Carbon;

class SendTexts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:texts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Texts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info('starting send texts');

        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

        $currentHourUTC = Carbon::now()->format('H');
        $plansToSend = Plan::where('message_time', $currentHourUTC)->where('status', 'ACTIVE')->get();
        foreach ($plansToSend as $plan) { 
            $diffInDays = Carbon::parse($plan->created_at)->diffInDays(Carbon::now());
            if ($diffInDays > $plan->days) {
                $plan->status = 'PENDING';
                $plan->save();
                $goal = Goal::where('id', $plan->goal_id)->first();
                $client->messages->create($plan->phone_number,
                array(
                    'from' => env('TWILIO_NUMBER'),
                    'body' => 'You have completed your plan! What is your current ' . $goal->measurement . '?'
                    )
                );
            } else { 
                $planDay = new PlanDay();
                $planDay->plan_id = $plan->id;
                $planDay->day_number = $diffInDays;
                $planDay->save();
                $approach = Approach::where('id', $plan->approach_id)->first();
                $client->messages->create($plan->phone_number,
                array(
                    'from' => env('TWILIO_NUMBER'),
                    'body' => 'Did you ' . $approach->name . ' today?'
                    )
                );

            }
            
        }
        
        return Command::SUCCESS;
    }
}
