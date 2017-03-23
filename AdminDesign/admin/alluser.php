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
$all = new user();
$id = $_SESSION['user']['institute_id'];
$allusers =  $all->getusers("WHERE `institute_id` != $id");
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
                <h1>All Users</h1>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-hover table-bordered table-content">
                <thead>
                <tr>
                    <th>id</th>
                    <th>full name</th>
                    <th>username</th>
                    <th>password</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($allusers as $user)
                {
                    $id         = $user['institute_id'];
                    $fullname   = $user['full_name'];
                    $username      = $user['username'];
                    $password      = $user['password'];

                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $password; ?></td>
                        <td>
                            <a href="deleteuser.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../assets/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>


