<?php
ob_start();
session_start();

include('connection.php');

$idacademy = $_GET["id"];

$query = "SELECT * FROM users WHERE idusers = '$idacademy'";
$result = mysqli_query($con, $query);

$name = "";
$email = "";
$image = "";
$phone = "";

while ($row = mysqli_fetch_row($result)) {
    $name = $row[1];
    $email = $row[2];
    $image = $row[8];
    $phone = $row[9];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <!-- bootstrap core css -->
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
        .form-group {
            margin-bottom: 0
        }
    </style>
    <style>
        .card-bounding {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            /* top:50%; */
            /* transform: translateY(-50%); */
            padding: 30px;
            border: 1px solid #2eca6a;
            border-radius: 6px;
            font-family: 'Roboto';
            background: #ffffff;
        }

        .card-bounding aside {
            font-size: 24px;
            padding-bottom: 8px;
        }

        .card-container {
            width: 100%;
            padding-left: 80px;
            padding-right: 40px;
            position: relative;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 0 auto 30px auto;
        }

        .card-container input {
            width: 100%;
            letter-spacing: 1px;
            font-size: 30px;
            padding: 15px 15px 15px 25px;
            border: 0;
            outline: none;
            box-sizing: border-box;
        }

        .card-type {
            width: 80px;
            height: 56px;
            background: url("cards.png");
            background-position: 0 -291px;
            background-repeat: no-repeat;
            position: absolute;
            top: 3px;
            left: 4px;
        }

        .card-type.mastercard {
            background-position: 0 0;
        }

        .card-type.visa {
            background-position: 0 -115px;
        }

        .card-type.amex {
            background-position: 0 -57px;
        }

        .card-type.discover {
            background-position: 0 -174px;
        }

        .card-valid {
            position: absolute;
            top: 0;
            right: 15px;
            line-height: 60px;
            font-size: 40px;
            font-family: 'icons';
            color: #ccc;
        }

        .card-valid.active {
            color: green;
        }

        .card-details {
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
            transition: 300ms ease;
        }

        .card-details input {
            font-size: 30px;
            padding: 15px;
            box-sizing: border-box;
            width: 100%;
        }

        .card-details input.error {
            border: 1px solid #2eca6a;
            box-shadow: 0 4px 8px 0 rgba(238, 76, 87, 0.3);
            outline: none;
        }

        .card-details .expiration {
            width: 50%;
            float: left;
            padding-right: 5%;
        }

        .card-details .cvv {
            width: 45%;
            float: left;
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
    <div class="p-5 row m-0 position-relative justify-content-between">
        <div class="col-md-5 card border-right border-gray">
            <div class="rounded  p-3 text-center">
                <div class="form-group ">
                    <?php
                    echo '<img src="uploads/' . $image . '" class="w-100" height="400px" style="border-radius:10px">';
                    ?>
                </div>

                <div class="form-group ">
                    <label class="col-form-label text-muted">Name</label>
                    <span><?php echo $name; ?></span>
                </div>
                <div class="form-group ">
                    <label class="col-form-label text-muted">Email</label>
                    <span><?php echo $email; ?></span>
                </div>
                <div class="form-group ">
                    <label class="col-form-label text-muted">Phone</label>
                    <span><?php echo $phone; ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 card ml-1">
            <?php
            if (isset($_SESSION["ccmessage"])) {
                echo '<div class="alert alert-primary mt-3">
                                                ' . $_SESSION["ccmessage"] . '
                                                </div>';
            } else if (isset($_SESSION["e_ccmessage"])) {
                echo '<div class="alert alert-danger">
                                                ' . $_SESSION["e_ccmessage"] . '
                                                </div>';
            }

            ?>
            <form method="POST" class="rounded  p-3" style="flex-grow:1;display:flex;flex-direction:column;justify-content:space-between" action="contact.php" enctype="multipart/form-data">
                <div>
                    <h4>Contact Academy/Trainer</h4>
                    <hr>
                </div>

                <div class="form-group">
                    <label class="mb-0"><small>Title</small></label>
                    <input type="text" name="title" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label class="mb-0"><small>Description</small></label>
                    <textarea required name="description" class="form-control form-control-lg"></textarea>
                </div>
                <div class="form-group">
                    <label class="mb-0"><small>File To Upload</small></label>
                    <input type="file" name="fileToUpload" class="form-control form-control-lg">
                </div>

                <input type="hidden" name="idacademy" value="<?php echo $idacademy; ?>" class="form-control form-control-sm">
                <!-- </div> -->
                <input type="submit" value="Submit" name="submit" class="btn btn-sm btn-primary mt-3">
            </form>
        </div>

    </div>
    <?php include('footer.php'); ?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js-CreditCardValidator-master/creditCardValidator.js"></script>

</html>

<?php

if (isset($_POST['submit'])) {

    $idusers = $_SESSION["userid"];

    $idacademy = $_POST["idacademy"];
    $title = $_POST["title"];
    $description = $_POST["description"];

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

    $query = "insert into questions (title, description, file, idusers, reply_user) values ('$title','$description','$profile_pic','$idusers','$idacademy')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['ccmessage'] = 'You question is sent successfully';
        header('Location: contact.php?id=' . $idacademy);
    } else {
        $_SESSION['e_ccmessage'] = 'You question is sent not subscribed, try again !!!!';
        header('Location: contact.php?id=' . $idacademy);
    }
}

?>