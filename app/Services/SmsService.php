<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\Customer;
use Carbon\Carbon;
use GuzzleHttp\Client;

class SmsService
{
    public static function send($to, $msg)
    {
        $domain = "https://api.sms.net.bd/sendsms";
        $api_key = config('services.sms.api_key');
        $recepient = htmlspecialchars($to);
        $shortMessage = htmlspecialchars($msg);
        $client = new Client(['verify' => false]);
        $request = $client->get($domain . '?api_key=' . $api_key . '&msg=' . $shortMessage . '&to=' . $recepient);
        $response = $request->getBody();
        return $response;
    }
    public static function sendFromPersonalAccount($to, $msg)
    {
        $domain = "https://api.sms.net.bd/sendsms";
        $api_key = "U0LTEMo9zNlJZwaGGth6j73g08vNp5iEwFbQFDx3";
        $recepient = htmlspecialchars($to);
        $shortMessage = htmlspecialchars($msg);
        $client = new Client();
        $request = $client->get($domain . '?api_key=' . $api_key . '&msg=' . $shortMessage . '&to=' . $recepient);
        $response = $request->getBody();
        return $response;
    }

    public static function sendFreeSmsRapidApi($to, $msg)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://sms77io.p.rapidapi.com/sms', [
            'multipart' => [
                [
                    'name' => 'to',
                    'contents' => $to
                ],
                [
                    'name' => 'text',
                    'contents' => $msg
                ]
            ],
            'headers' => [
                'x-rapidapi-host' => 'sms77io.p.rapidapi.com',
                'x-rapidapi-key' => '252c4380a8msh4e529fd8fe51916p128294jsn19dfb41f1c33',
            ],
        ]);

        echo $response->getBody();
    }

    public static function sendFreeSmsVonageNexmo($to, $msg)
    {
        define('BRAND_NAME', 'ESTORE');
        define('ONLY_REGISTERED_NUMBER', '"8801317242174"');
        $basic  = new \Vonage\Client\Credentials\Basic("e293e2c0", "Ul6uNWHzosbappT");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($to, BRAND_NAME, $msg . '47001 Grameenphone')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
