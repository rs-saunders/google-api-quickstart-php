<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/gmail.setup.php';

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);

$user = 'me';

$mail = new PHPMailer();
$mail->CharSet = "UTF-8";
$from = "someone@somedomain.com";
$fname = "Somebodys Name";
$mail->From = $from;
$mail->FromName = $fname;
$mail->AddAddress("tosomeone@somedomain.com");
$mail->AddReplyTo($from, $fname);
$mail->Subject = "Testing";
$mail->Body = "hey there!";
$mail->preSend();
$mime = $mail->getSentMIMEMessage();

$m = new Google_Service_Gmail_Message();
$data = base64_encode($mime);
$data = str_replace(
    array('+', '/', '='), array('-', '_', ''), $data
); // url safe
$m->setRaw($data);

$service->users_messages->send('me', $m);
