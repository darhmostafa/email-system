<?php
session_start();
include "../../mailer/PHPMailerAutoload.php";
$email = $_POST['to'];
$useremail = $_POST['subject'];
$body = $_POST['massage'];

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

    $mail->addAddress($email,$useremail);

    $mail->isHTML(true);

    $mail->Subject = $useremail;
    $mail->Body = $body;
    $mail->AltBody = "This is the plain text version of the email content";
    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Message has been sent successfully";
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
                <h1>message</h1>
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
            <form class="form-horizontal" action="sendemail.php" method="post" name="frmEmail">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Message</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <input class="form-control" placeholder="To:" name="to">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Subject:" name="subject">
                            </div>
                            <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="massage">

                    </textarea>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.content -->



    </div>
    <?php } ?>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../assets/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
