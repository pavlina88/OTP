<?php
include('../model/RegistrationForm.php');
include('../model/SendSmsForm.php');
include('../model/Db.php');

if (!empty($_POST['email'] && $_POST['phone'] && ['password'])) {
    $dateNow = (new DateTime('now'))->format('Y-m-d H:i:s');

    //prepare data to send
    $form    = new RegistrationForm();
    $email   = $_POST['email'];
    $pass    = $form->hashPassword($_POST['password']);
    $phone   = $form->validatePhone($_POST['phone']);
    $otp     = (string)mt_rand(100000, 999999);
    $message = 'How: You can mock an SMS provider by saving the messages in the database? Your Code: ' . $otp;

    //Sent data to Twilio Api
    $sendSms        = new SendSmsForm();
    $response       = $sendSms->sendSMS($phone, $message);
    $objectResponse = json_decode($response);

    if ($objectResponse->more_info == '') {
        //We success send the message through twilio and create record with this request in database
        session_start();
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        $_SESSION['pass']  = $pass;

        //Create connection to database and insert record for send SMS
        $db = new Db();
        $db->insert('twilio_response', ['code' => $otp, 'phone' => $phone, 'response' => 'success', 'date_create' => $dateNow]);
        header('location: ../view/otpForm.php');
    } else {
        //We were unable to send the message through twilio and create record with this request in database
        $db     = new Db();
        $record = $db->insert('twilio_response', ['code' => $otp, 'phone' => $phone, 'response' => $objectResponse->more_info, 'date_create' => $dateNow]);
        header('location: ../index.php');
    }
}