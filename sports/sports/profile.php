<?php
ob_start();
session_start();

include('connection.php');

$idusers = $_SESSION['userid'];

$query = "SELECT * FROM users WHERE idusers = '$idusers' ";
$result = mysqli_query($con, $query);

$name = "";
$phone = "";
$subscriptionmonthly = "";
$image = "";

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
    $phone = $row["phone"];
    $image = $row["image"];
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <style>
        hr {
            border: 2px solid var(--primary)
        }
    </style>
</head>

<body>
    <?php
    if ($_SESSION['userrole'] == 'admin') {
        include('adminnavbar.php');
    } else if ($_SESSION['userrole'] == 'academy') {
        include('academynavbar.php');
    } else if ($_SESSION['userrole'] == 'client') {
        include('clientnavbar.php');
    } else {
        header('Location: index.php');
        die();
    }


    ?>
    <div class="p-5 bg-light">
        <div class="row m-0 shadow-sm bg-white rounded overflow-hidden" style="height:70vh">
            <div class="col-md-6 p-0">
                <img src="uploads/<?php echo $image?>" class="w-100 h-100">
            </div>

            <div class="col-md-6 py-4">
                <h4><?php echo $name; ?></h4>
                <hr>
                <form class="row m-0" action="profile.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (isset($_SESSION["profile_message"])) {
                        echo '<div class="alert alert-primary w-100">
                                                ' . $_SESSION["profile_message"] . '
                                                </div>';
                    } else if (isset($_SESSION["eprofile_message"])) {
                        echo '<div class="alert alert-danger w-100">
                                                ' . $_SESSION["eprofile_message"] . '
                                                </div>';
                    }

                    ?>


                    <div class="form-group col-md-12">
                        <label class="mb-0"><small>Name</small></label>
                        <input type="text" value="<?php echo $name; ?>" name="username" required class="form-control ">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="mb-0"><small>Phone</small></label>
                        <input type="text" value="<?php echo $phone; ?>" name="phone" required class="form-control ">
                    </div>

                    <?php if($_SESSION["userrole"] == "academy"){ ?>
                    <div class="form-group col-md-12 companyy">
                        <label class="mb-0"><small>Subscription Monthly</small></label>
                        <input type="number" value="<?php echo $subscriptionmonthly; ?>" step="any" name="subscription" class="form-control ">
                    </div>
                    <?php } ?>
                    <div class="form-group col-md-12">
                        <label class="mb-0"><small>Image</small></label>
                        <input type="file" name="fileToUpload" class="form-control ">
                    </div>


                    <div class="form-group col-md-12 text-center">
                        <button type="submit" name="submit" class="btn btn-primary ">Update</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

</html>

<?php

if (isset($_POST["submit"])) {

    $name = $_POST["username"];
    $phone = $_POST["phone"];
    $subscription_monthly = $_POST["subscription_monthly"];


    $target_dir = "uploads/";
    $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

    //get all emails to be validated


    if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
        } else {
            $error_msg = "Sorry, there was an error uploading your file.";
        }
    }


    if ($profile_pic != "") {
        $query = "UPDATE users SET name = ?,phone = ?,subscription_monthly = ?,image = ? WHERE idusers = ?";

        $stmt = $con->prepare($query);


        $id = (int)$_SESSION["userid"];

        $stmt->bind_param('ssssi', $name, $phone, $subscription_monthly, $profile_pic, $id);

        $stmt->execute();
    } else {
        $query = "UPDATE users SET name = ?,phone = ?,subscription_monthly = ? WHERE idusers = ?";

        $stmt = $con->prepare($query);


        $id = (int)$_SESSION["userid"];

        $stmt->bind_param('sssi', $name, $phone, $subscription_monthly, $id);

        $stmt->execute();
    }



    if ($stmt) {
        $_SESSION["profile_message"] = "Your Profile is Updated Successfully";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION["eprofile_message"] = "Your Profile is not updated !!!, try again";
        header("Location: profile.php");
        exit();
    }
}


?>