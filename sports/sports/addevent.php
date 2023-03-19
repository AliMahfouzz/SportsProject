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
</head>

<body>
<?php
        if($_SESSION['userrole'] == 'admin'){
            include('adminnavbar.php');
        }
        else if($_SESSION['userrole'] == 'academy'){
            include('academynavbar.php');
        }
        else if($_SESSION['userrole'] == 'client'){
            include('clientnavbar.php');
        }
        else{
          header('Location: index.php');
          die();
        }
    
    
    ?>
    <div class="p-4">
        <div class="text-center mb-3">
            <h3 style="width:max-content" class="m-auto">Add new event
                <hr>
            </h3>

        </div>
        <?php
            if (isset($_SESSION["evmessage"])) {
                echo '<div class="alert alert-primary row m-2">
                                                ' . $_SESSION["evmessage"] . '
                                                </div>';
            } else if (isset($_SESSION["e_evmessage"])) {
                echo '<div class="alert alert-danger row m-2">
                                                ' . $_SESSION["e_evmessage"] . '
                                                </div>';
            }

            ?>
        <form class="row m-0" action="addevent.php" method="POST" enctype="multipart/form-data">
           
            <div class="form-group col-md-6">
                <label class="mb-0"><small>Event Name</small></label>
                <input type="text" required class="form-control form-control-sm" placeholder="Event Name" name="ename">
            </div>


            <div class="form-group col-md-6">
                <label class="mb-0"><small>Event Price</small></label>
                <input type="number" required step="any" name="price" class="form-control form-control-sm" placeholder="Event Price">
            </div>
            <div class="form-group col-md-6">
                <label class="mb-0"><small>Event Duration</small></label>
                <input type="text" required name="duration" class="form-control form-control-sm" placeholder="Event Duration">
            </div>
            <div class="form-group col-md-6">
                <label class="mb-0"><small>Minimum Age</small></label>
                <input type="number" required name="age" class="form-control form-control-sm" placeholder="Minimum Age">
            </div>


            <div class="form-group col-md-6">
                <label class="mb-0"><small>Event Description</small></label>
                <textarea required name="description" class="form-control form-control-sm"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label class="mb-0"><small>Event Image</small></label>
                <input required name="fileToUpload" class="form-control form-control-sm" type="file" />
            </div>
            <div class="form-group col-md-12">
                <label class="mb-0"><small>Event Category</small></label>
                <select name="category" required class="form-control form-control-sm" placeholder="Category">
                    <option value="zumba">Zumba</option>
                    <option value="running">Running</option>
                    <option value="soccer">Soccer</option>
                    <option value="basketball">Basketball</option>
                    <option value="gulf">Gulf</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" name="submit" class="btn btn-primary ">Add Event</button>
            </div>


        </form>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>

<?php

include('connection.php');

if (isset($_POST["submit"])) {

    $ename = $_POST['ename'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $idusers = $_SESSION["userid"];


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

    $query = "insert into events (ename,edescription,eprice,eduration,age,idusers,eimage,category) values ('$ename','$description','$price','$duration','$age','$idusers','$profile_pic','$category')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['evmessage'] = 'Your event is registered successfully';
        header('Location: addevent.php');
    } else {
        $_SESSION['e_evmessage'] = 'Your event is not registered, try again !!!!';
        header('Location: addevent.php');
    }
}

?>