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
        <div class="row justify-content-center m-auto  w-100">
            <div class="col-xl-10 ">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <div class="mb-5">
                                        <h3 class="h4 font-weight-bold text-theme">Register</h3>
                                    </div>
                                    <form class="row m-0" action="register.php" method="POST" enctype="multipart/form-data">
                                        <?php
                                            if(isset($_SESSION["message"])){
                                                echo '<div class="alert alert-primary">
                                                '.$_SESSION["message"].'
                                                </div>';
                                            }
                                            else if(isset($_SESSION["e_message"])){
                                                echo '<div class="alert alert-danger">
                                                '.$_SESSION["e_message"].'
                                                </div>';
                                            }
                                        
                                        ?>
                                        <div class="form-group col-md-12">
                                            <label class="mb-0"><small>User Type</small></label>
                                            <div class="row m-0 ">
                                                <div class="row m-0 w-100" id="radios">
                                                    <div class="form-check col-md-6">
                                                        <input class="form-check-input" type="radio" name="userrole" id="exampleRadios1" value="academy">
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            <small>Academy/Trainer</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-check col-md-6">
                                                        <input class="form-check-input" type="radio" name="userrole" id="exampleRadios2" value="client">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            <small>Client</small>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-0"><small>Name</small></label>
                                            <input type="text" name="username" required class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-0"><small>Phone</small></label>
                                            <input type="text" name="phone" required class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-0"><small>Email</small></label>
                                            <input type="email" name="email" required class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-0"><small>Password</small></label>
                                            <input type="password" name="password" required class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6 client" style="display: none;">
                                            <label class="mb-0"><small>Age</small></label>
                                            <input type="number" name="age" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6 companyy" style="display: none;">
                                            <label class="mb-0"><small>Subscription Monthly</small></label>
                                            <input type="number" step="any" name="subscription" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="mb-0"><small>Image</small></label>
                                            <input type="file" required name="fileToUpload" class="form-control form-control-sm">
                                        </div>


                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" class="btn btn-primary ">Register</button>
                                        </div>


                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-6 d-none d-lg-inline-block">
                                <div class="account-block-1 rounded-right">
                                    <div class="overlay rounded-right"></div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->

                <p class="text-muted text-center mt-3 mb-0">Have an account? <a href="login.php" class="text-primary ml-1">login</a></p>

                <!-- end row -->

            </div>
            <!-- end col -->
        </div>
        <!-- Row -->
    </div>
</body>

<script src="js/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function(){
        $("#radios").change(function(e){
            var ele = e.target.value;
            console.log(ele);
            if(ele == 'academy'){
                $(".companyy").css('display','block');
                $(".client").css('display','none');
            }
            else{
                $(".companyy").css('display','none');
                $(".client").css('display','block');
            }
        });
    });
</script>

</html>

<?php

include('connection.php');

if (isset($_POST["submit"])) {

    //echo var_dump($_POST);

    $email = $_POST["email"];

    $emails = [];

    $query1 = "
    SELECT email from users
  ";

    $result = mysqli_query($con, $query1);

    while ($row = mysqli_fetch_assoc($result)) {
        $emails[] = $row['email'];
    }


    if (!in_array($email, $emails)) {

        $username = $_POST['username'];
        $role = $_POST['userrole'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $subs = $_POST['subscription'];
        $password = $_POST['password'];


        $profile_pic = "";

        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);



        if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }

        $approved = 0;


        $query = "insert into users (name,email,password,phone,image,role,approved,subscription_monthly,age) values ('$username','$email','$password','$phone','$profile_pic','$role','$approved','$subs','$age')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['message'] = 'Your account is registered successfully';
            header('Location: register.php');
        } else {
            $_SESSION['e_message'] = 'Your account is not registered, try again !!!!';
            header('Location: register.php');
        }

    }
    else{
        $_SESSION['e_message'] = 'Email already in use, try again !!!!';
        header('Location: register.php');
    }
}

?>