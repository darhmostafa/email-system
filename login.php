<?php
session_start();
include('include/user.class.php');
include('include/function.php');

if(check()){
    exit('you are login');
}

$error = '';
$sucss = '';

if(count($_POST)>0)
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = new user();
    $data =  $login->login($username,$password);

    if($data && count($data)>0){

        $_SESSION['user'] = $data;

        $sucss = 'you are logged in ';

    }
    else
    {
        $error = 'invalid user';
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soft Masr - Project">
    <meta name="author" content="Ahmed ElShahat">
    <title>admin login</title>

    <!-- FontAwesome -->
    <link href="AdminDesign/assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="AdminDesign/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="AdminDesign/assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-login">
<div class="container">

    <div class="col-md-12">
        <div class="content">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="page-header">
                        <h1>Login <small>Admin Panel</small></h1>
                    </div>

                    <?php if(strlen($error)>0) { ?>

                        <div class="alert alert-danger">
                            <strong>Error:</strong>
                            <ul>
                                <li> <?php echo $error; ?> </li>
                            </ul>
                        </div>

                    <?php } ?>

                    <?php if(strlen($sucss)>0) { ?>
                        <div class="alert alert-success">
                            <ul>
                                <li> <?php echo $sucss; ?> to goto admin page <a href="AdminDesign/admin/add.php">click here</a> </li>
                            </ul>
                        </div>


                    <?php }else{ ?>

                    <form class="form-horizontal" action="login.php" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="clearfix">
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-sign-in"></i> Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php } ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="AdminDesign/assets/js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="AdminDesign/assets/js/bootstrap.min.js"></script>
</body>
</html>