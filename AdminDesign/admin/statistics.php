<?php
session_start();
include("../../include/xmlapi.php");   //XMLAPI cpanel client class
require_once('../../include/function.php');
require_once('../../include/student.class.php');
require_once ('../../include/student.email.class.php');
require_once ('../../include/staff.email.class.php');
require_once ('../../include/config.php');
require '../../mailer/PHPMailerAutoload.php';
require_once ('../../include/user.class.php');
if(!check())
{
    exit('you are not login');
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
                <h1>statistics</h1>
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
            <!-- contint here -->

            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-user"></i>
                            </div>
                            <div class="text">
                                <var>
                                    <?php
                                    $student = new student_mail();
                                    $stu =  $student->geteall();
                                    echo count($stu);
                                    ?>

                                </var>
                                <label class="text-muted">email student</label>
                            </div>
                            <div class="options">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-user"></i>
                            </div>
                            <div class="text">
                                <var>
                                    <?php
                                    $staff = new staff_email();
                                    $st =  $staff->getall();
                                    echo count($st);
                                    ?>
                                </var>
                                <label class="text-muted">email staff</label>
                            </div>
                            <div class="options">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-user"></i>
                            </div>
                            <div class="text">
                                <var> <?php
                                    $m = new user();
                                   $user =  $m->getusers();
                                  echo count($user);
                                    ?> </var>
                                <label class="text-muted">user</label>
                            </div>
                            <div class="options">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-tags"></i>
                            </div>
                            <div class="text">
                                <var>3</var>
                                <label class="text-muted">ver number</label>
                            </div>
                            <div class="options">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>

    </div>
    <?php } ?>

    <!-- end contint -->
    
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../assets/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>

