<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Requirement;
use Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMail $event): void
    {
        //
        $request = Requirement::find($event->reqID)->toArray();

        if($request['customer_email'] != ''){
            Mail::send('eventMial', $request, function($message) use($request){
                $message->to($request['customer_email']);
                $message->subject('Updates of request by prince.com');
    
            });
        }
    }
}
