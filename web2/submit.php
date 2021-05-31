<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$msgdata = $_POST['message'];

// Validate first
// if( $name="" && $email="" && $phone="" )
// {
//     echo "Name and email are mandatory!";
//     exit;
// 	if(IsInjected($email))
// 	{
// 		echo "Bad email value!";
// 		exit;
// 	}
// }
$htmltable = "<table><tr><td>Name:</td><td>$name</td></tr><tr><td>Email:</td><td>$email</td></tr>
<tr><td>Phone:</td>$phone<td></td></tr>
<tr><td>Message:</td><td>$msgdata</td></tr><tr></table>";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require  './PHPMailer/src/SMTP.php';

// require '/PHPMailer/src/Exception.php';
// require '/PHPMailer/src/PHPMailer.php';
// require '/PHPMailer/src/SMTP.php';
// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'mbilaliqbal1998@gmail.com'; // YOUR gmail email
    $mail->Password = 'bherka12345'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('bilaliqbal@gmail.com');
    $mail->addAddress('phppot@example.com');
    // $mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "New Contact Us";
    $mail->Body = $htmltable;
    // $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

	$mail ->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
    $mail->send();
    echo "Email message sent.";
	// header('location:index.html');
	// echo '<script>alert("Thanks");</Script>';
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}

?>