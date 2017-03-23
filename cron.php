<?php
session_start();
require_once('include/function.php');
require_once ('include/config.php');
require_once ('include/student.email.class.php');
if(!check())
{
    exit('you are not login');
}

$email = new student_mail();
$emails = $email->selectemail();

foreach ($emails as $e){
    $emailselect = $e['username'];
    $emailfuture = $e['future'];
    //curent date
    $now = date('Y-m-d');


include("include/xmlapi.php");
$ip = '';
$account_pass = ''; // cpanel password
$account = '';  // cpanel username

$email_account = $emailselect; // email account name without @mydomain.com
$email_domain = ''; // domain associated with the email account

$xmlapi = new xmlapi($ip);
$xmlapi->password_auth($account, $account_pass);
$xmlapi->set_port(2083);
//$xmlapi->set_debug(1);  // uncomment for debugging

$args = array(
    'domain' => $email_domain,
    'email' => $email_account,
);
    // IF now date equel future date delete email
if($now == $emailfuture) {
    $xmlapi->api2_query($account, 'Email', 'delpop', $args);
    }
}