<?php
include('model/RegistrationForm.php');
include('../model/Db.php');
session_start();

if (!empty($_POST['code'])) {
    $dateNow   = (new DateTime('now'))->format('Y-m-d H:i:s');
    $codeInput = $_POST['code'];
    $phone     = $_SESSION['phone'];
    $email     = $_SESSION['email'];
    $password  = $_SESSION['pass'];

    $db = new Db();
    $db->insert('app_request_log', [
        'data_input'  => $codeInput,
        'date_create' => $dateNow,
        'phone'       => $phone,
    ]);
    $count = $db->count('app_request_log', [
        'data_input'  => $_POST['code'],
        'phone'       => $phone,
        'verificated' => 'is not null'
    ]);
    if ($count <= 3) {
        $createCode = $db->select('twilio_response', 'code', ['phone' => $phone]);
        if ($createCode == $codeInput) {
            include('../model/SendSmsForm.php');
            $message = 'Welcome to SMSBump!';
            //Sent data to Twilio Api
            $sendSms  = new SendSmsForm();
            $response = $sendSms->sendSMS($phone, $message);
            $objectResponse = json_decode($response);

            if ($objectResponse->more_info == '') {
                $db->insert('users', [
                    'email'       => $email,
                    'password'    => $password,
                    'date_create' => $dateNow,
                    'phone'       => $phone,
                ]);
                $db->update('app_request_log', ['verificated' => true], [
                    'data_input'  => $codeInput,
                    'phone' => $phone,
                ]);
            header('location: ../view/success.php');
            }
        } else {
            header('location: ../view/otpForm.php');
        }
    } else {
        sleep(60);
        header('location: ../view/otpForm.php');
    }
}