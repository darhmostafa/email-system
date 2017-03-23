<?php
session_start();
include('../../include/function.php');
include ('../../include/user.class.php');
include ('../../include/config.php');
if(!check())
{
    exit('you are not login');
}

$error= '';
$succes = '';

if(count($_POST)>0)
{
    $u = new user();
    $id = $_POST["id"];
    $fullname = $_POST["name"];
    $username = $_POST["user"];
    $password = $_POST["pass"];
    $task = $_POST["task"];
    $u->adduser($id,$fullname,$username,$password,$task);

}
?>
<!--
<form action="addnewuser.php" method="post">
    <input type="text" name="id">
    <input type="text" name="name">
    <input type="text" name="user">
    <input type="text" name="pass">
    <input type="text" name="task">
    <input type="submit" name="add" value="add user">
</form>
-->

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
                <h1>Add new user</h1>
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
            <form class="form-horizontal" action="addnewuser.php" method="post" name="frmEmail">
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
                        <input type="text" class="form-control" name="id" placeholder="id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">full name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name"  placeholder="fullname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="user"  placeholder="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email-address" class="col-sm-3 control-label">password</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pass"  placeholder="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="grade" class="col-sm-3 control-label">task</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="task">
                            <option value="1">user</option>
                            <option value="2">admin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input name="submit" type="submit" value="add new user" class="btn btn-success fa fa-user" />
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


