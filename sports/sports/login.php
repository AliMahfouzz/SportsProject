<?php
ob_start();
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- slick slider -->
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div id="main-wrapper" class="py-5  px-2 bg-light" style="height: 100vh">
        <div class="row justify-content-center m-auto  w-75">
            <div class="col-xl-10 ">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <div class="mb-5">
                                        <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['error_message'])) {
                                        echo '<div class="alert alert-danger" role="alert">
                                    ' . $_SESSION['error_message'] . '
                                  </div>';
                                    }

                                    ?>
                                    <h6 class="h5 mb-0">Welcome back!</h6>
                                    <p class="text-muted mt-2 mb-5">Enter your email address and password to access our website.</p>

                                    <form action="login.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><small>Email address</small></label>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                                        </div>
                                        <div class="form-group mb-5">
                                            <label for="exampleInputPassword1"><small>Password</small></label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-6 d-none d-lg-inline-block">
                                <div class="account-block rounded-right">
                                    <div class="overlay rounded-right"></div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->

                <p class="text-muted text-center mt-3 mb-0">Don't have an account? <a href="register.html" class="text-primary ml-1">register</a></p>

                <!-- end row -->

            </div>
            <!-- end col -->
        </div>
        <!-- Row -->
    </div>
</body>

</html>


<?php

include('connection.php');

if (isset($_POST["submit"])) {
    //echo var_dump($_POST);

    $email = $_POST["email"];

    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);


        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] == $password) {

                if ($user_data['role'] == 'academy' && $user_data['approved'] == 0) {
                    $_SESSION['error_message'] =  "Your account is disabled!";
                    header("Location: login.php");
                    die;
                } else {
                    $_SESSION['username'] = $user_data['name'];
                    $_SESSION['userrole'] = $user_data['role'];
                    $_SESSION['userid'] = $user_data['idusers'];
                    header('Location: dashboard.php');
                    die;
                }
            }
            else{
                $_SESSION['error_message'] =  "Wrong Username Or Password!";
                header("Location: login.php");
                die;
            }
        } else {
            $_SESSION['error_message'] =  "Your account not exists!";
            header("Location: login.php");
            die;
        }
    }
}

?>