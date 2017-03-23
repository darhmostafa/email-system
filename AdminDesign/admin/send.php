<?php
session_start();

include "../../mailer/PHPMailerAutoload.php";
include "../../include/student.email.class.php";
$email = new student_mail();
$emails = $email->getemail();

foreach ($emails as $e){
   $useremail = $e['username'];
   $passwordemail = $e['password'];
    //email
    $emaile = $useremail.="";
//start mail
$mail = new PHPMailer;
//Enable SMTP debugging.
$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "";
$mail->Password = "";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;

$mail->From = "";
$mail->FromName = "";

$mail->addAddress($emaile,$useremail);

$mail->isHTML(true);
    $oneYearOn = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));

$mail->Subject = "info";
$mail->Body = "<i> email $emaile</i><br><i>password your email $passwordemail</i><br><i>to mange your mail visite http://capsulesolution.net/email </i><br><i>expair date $oneYearOn </i>";
$mail->AltBody = "This is the plain text version of the email content";
if(!$mail->send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message has been sent successfully";
}

}
?>