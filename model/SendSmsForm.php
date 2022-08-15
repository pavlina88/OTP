<?php
class SendSmsForm
{
    function sendSMS($numbers, $message): bool|string
    {

        // Account details Your Account SID and Auth Token from twilio.com/console
        $accountSid = 'AC94f21f4058f84adea86c86c3e5cd8150';
        $authToken = '36f2cb4f956092b0cb1d0d03bb458e57';
        $credentials = $accountSid . ':' . $authToken;
        // A Twilio number you own with SMS capabilities
        $twilio_number = "+18043957221";
        $url = 'https://api.twilio.com/2010-04-01/Accounts/'.$accountSid . '/Messages.json';
        $data = [
            'To'                  => $numbers,
            'Body'                => $message,
            'From' => $twilio_number
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERPWD, $credentials);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
         return $response;
    }
}