<?php
session_start();

include("../../include/xmlapi.php");   //XMLAPI cpanel client class
require_once('../../include/function.php');
require_once('../../include/staff.class.php');
require_once ('../../include/staff.email.class.php');
require_once ('../../include/config.php');
require '../../mailer/PHPMailerAutoload.php';
if(!check())
{
    exit('you are not login');
}

$ip = "localhost";           // should be server IP address or 127.0.0.1 if local server
$account = "";        // cpanel user account name
$passwd ="";        // cpanel user password
$port =2083;                 // cpanel secure authentication port unsecure port# 2082

$email_domain = ''; // email domain (usually same as cPanel domain)
$email_quota = 50; // default amount of space in megabytes


/*************End of Setting***********************/

function getVar($name, $def = '') {
    if (isset($_REQUEST[$name]))
        return $_REQUEST[$name];
    else
        return $def;
}
// check if overrides passed

$email_pass = getVar('pass', $passwd);
$email_vpass = getVar('vpass', $vpasswd);
$email_domain = getVar('domain', $email_domain);
$email_quota = getVar('quota', $email_quota);
$dest_email = getVar('forward', '');
$email_id  = getVar('instid', '');
$email_lastname  = getVar('lastname', '');
$email_firstname = getVar('firstname', '');
$email_user  = $email_firstname.=$email_lastname;


$msg = '';
if (!empty($email_user))
    while(true) {


        if ($email_pass !== $email_vpass){       //check password
            $msg = "Email password does not match";
            break;
        }

        $xmlapi = new xmlapi($ip);

        $xmlapi->set_port($port);  //set port number. cpanel client class allow you to access WHM as well using WHM port.

        $xmlapi->password_auth($account, $passwd);   // authorization with password. not as secure as hash.

// cpanel email addpop function Parameters
        $call = array(domain=>$email_domain, email=>$email_user, password=>$email_pass, quota=>$email_quota);
// cpanel email fwdopt function Parameters
        $call_f  = array(domain=>$email_domain, email=>$email_user, fwdopt=>"fwd", fwdemail=>$dest_email);
        $xmlapi->set_debug(0);      //output to error file  set to 1 to see error_log.

// making call to cpanel api
        $result = $xmlapi->api2_query($account, "Email", "addpop", $call );

        $result_forward = $xmlapi->api2_query($account, "Email", "addforward", $call_f); //create a forward
//for debugging purposes. uncomment to see output
//echo 'Result\n<pre>';
//print_r($result);
//echo '</pre>';


        if ($result->data->result == 1){
            $name = $_SESSION['user']['username'];
            $user_create = $_SESSION['user']['institute_id'];
            $id = $_POST['instid'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $emailf = $_POST['forward'];
            $level = $_POST['level'];
            $password = $_POST['pass'];
            $username = $_POST['firstname'].=$_POST['lastname'];
            $conpassword = $_POST['vpass'];
            $staff = new staff();
            $email = new staff_email();
            //$student->add($id,$firstname,$lastname,$phone,$dest_email,$major,$grade);
            //$email->add($id,$email_user,$email_pass,$dest_email,$user_create);
            $staff->add($id,$firstname,$lastname,$phone,$dest_email,$level);
            $email->add($id,$email_user,$email_pass,$dest_email,$user_create);
            header('LOCATION:sendStaff.php');
//end class
            $msg = $email_user.'@'.$email_domain.' account created';

            if ($result_forward->data->result == 1){
                $msg = $email_user.'@'.$email_domain.' forward to '.$dest_email;


            }
        } else {
            $msg = $result->data->reason;
            break;
        }

        break;
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="email system">
    <meta name="author" content="mohamed amr">
    <title>control panel</title>

    <!-- FontAwesome -->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-panel">
<div class="admin-panel__sidebar">
    <h2>Admin Panel</h2>
    <div class="welcome">

    </div>

    <div class="home">
        <a href="add.php" class="btn"><i class="fa fa-home"></i> Admin Home</a>
    </div>

    <div class="panel-group" id="admincontrols" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#admincontrols" href="#student" aria-expanded="false"><i class="fa fa-graduation-cap"></i> student</a>
                </h4>
            </div>
            <div id="student" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <ul>
                        <li><a href="add.php">Add student</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#admincontrols" href="#staff" aria-expanded="false"><i class="fa fa-user"></i> staff </a>
                </h4>
            </div>
            <div id="staff" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <ul>
                        <li><a href="addStaff.php">Add staff</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $permission = $_SESSION['user']['task'];
        if($permission == 2 ){
            ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#admincontrols" href="#send" aria-expanded="false"><i class="fa fa-comments"></i>  send email </a>
                    </h4>
                </div>
                <div id="send" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <ul>
                            <li><a href="sendemail.php">  send</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#admincontrols" href="#adduser" aria-expanded="false"><i class="fa fa-user"></i>   user </a>
                    </h4>
                </div>
                <div id="adduser" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <ul>
                            <li><a href="addnewuser.php">  add user</a></li>
                            <li><a href="alluser.php">  delete user</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#admincontrols" href="#staticts" aria-expanded="false"><i class="fa fa-signal"></i> statistics </a>
                    </h4>
                </div>
                <div id="staticts" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <ul>
                            <li><a href="statistics.php">  statistics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="logout">
            <a href="../../logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>
</div>
<div class="admin-panel__content">

    <div class="row">
        <div class="col-md-12">
            <div class="section-header">
                <h1>Add staff</h1>
            </div>
            <?php if(strlen($succes)>0) { ?>
                <div class="alert alert-success">
                    <p><?php echo $succes; ?></p>
                </div>
            <?php } ?>
            <?php if(strlen($error)>0 ) { ?>
                <div class="alert alert-danger">
                    <p><?php echo $error; ?></p>
                </div>
            <?php }else{ ?>
        </div>
        <div class="col-md-8">
            <form class="form-horizontal" action="addStaff.php" method="post" name="frmEmail">
                <!--
                <div class="form-group">
                    <label for="email-address" class="col-sm-3 control-label">username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="user"  placeholder="user name">
                    </div>
                </div>
                -->
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">institute id</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="instid" placeholder="id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email-address" class="col-sm-3 control-label">first name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="firstname"  placeholder="first name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">last name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="lastname"  placeholder="last name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone"  placeholder="phone">
                    </div>
                </div>
                <?php
                $min=10000000;
                $max=100000000;
                $random = rand($min,$max);
                ?>

                <div class="form-group">
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" name="pass"  value="<?php echo $random?>" placeholder="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" name="vpass" value="<?php echo $random?>" placeholder="password again">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email-address" class="col-sm-3 control-label">Email forward</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="forward"  placeholder="Email forward">
                    </div>
                </div>
                <div class="form-group">
                    <label for="grade" class="col-sm-3 control-label">level</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="level">
                            <option value="6">دكتور</option>
                            <option value="7">معيد</option>
                            <option value="5">عامل</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input name="submit" type="submit" value="Create Email" class="btn btn-success fa fa-user" />
                    </div>
                </div>
            </form>
        </div>

    </div>
    <?php } ?>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../assets/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>

