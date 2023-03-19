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
            <h3 style="width:max-content" class="m-auto">Add Game Equipment
                <hr>
            </h3>

        </div>
        <?php
            if (isset($_SESSION["gemessage"])) {
                echo '<div class="alert alert-primary row m-2">
                                                ' . $_SESSION["gemessage"] . '
                                                </div>';
            } else if (isset($_SESSION["e_gemessage"])) {
                echo '<div class="alert alert-danger row m-2">
                                                ' . $_SESSION["e_gemessage"] . '
                                                </div>';
            }

            ?>
        <form class="m-0" style="align-items: center;" action="addgameequipment.php" method="POST" enctype="multipart/form-data">
           
            <div class="form-group col-md-6">
                <label class="mb-0"><small>Equipment Name</small></label>
                <input type="text" required class="form-control form-control-sm" placeholder="Equipment Name" name="ename">
            </div>


            <div class="form-group col-md-6">
                <label class="mb-0"><small>Equipment Price</small></label>
                <input type="number" required step="any" name="price" class="form-control form-control-sm" placeholder="Equipment Price">
            </div>
            

            <div class="form-group col-md-6">
                <label class="mb-0"><small>Equipment Description</small></label>
                <textarea required name="description" class="form-control form-control-sm"></textarea>
            </div>

            <div class="form-group col-md-6">
                <label class="mb-0"><small>Equipment Image</small></label>
                <input required name="fileToUpload" class="form-control form-control-sm" type="file" />
            </div>

            <div class="form-group col-md-6">
                <label class="mb-0"><small>Category</small></label>
                <select required name="categories" class="form-control form-control-sm">
                    <option selected disabled>Select a category</option>
                    <option value="Baseball Equipment">Baseball Equipment</option>
                    <option value="Football Equipment">Football Equipment</option>
                    <option value="Basketball Equipment">Basketball Equipment</option>
                    <option value="Swimming Equipment">Swimming Equipment</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            
            <div class="form-group col-md-12">
                <button type="submit" name="submit" class="btn btn-primary ">Add Equipment</button>
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
    $categories = $_POST['categories'];

    $description = $_POST['description'];
    $price = $_POST['price'];



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

    $query = "insert into game_equipment (name,description,price,image,category) values ('$ename','$description','$price','$profile_pic', '$categories')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['gemessage'] = 'Your game equipment is registered successfully';
        header('Location: addgameequipment.php');
    } else {
        $_SESSION['e_gemessage'] = 'Your game equipment is not registered, try again !!!!';
        header('Location: addgameequipment.php');
    }
}

?>