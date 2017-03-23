<?php

session_start();
include('../../include/function.php');
include ('../../include/user.class.php');
include ('../../include/config.php');
if(!check())
{
    exit('you are not login');
}

$id = (isset($_GET['id']))? (int)$_GET['id'] : 0;
$user = new user();
if($user->deleteuser($id)){
    header('LOCATION:alluser.php');
}
else
{
    echo 'Invalid user selected';
}