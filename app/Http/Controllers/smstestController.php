<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class smstestController extends Controller
{
    public function sms(){
        $basic  = new \Vonage\Client\Credentials\Basic("b0dd7d9a", "9iF6Y6q9x69Rj1Bh");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("639173194129", 'laravel', 'A text message sent using the Nexmo SMS API')
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
