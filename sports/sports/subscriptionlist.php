<?php
ob_start();
session_start();

include('connection.php');

$query = "SELECT * FROM users WHERE role='academy'";
$result = mysqli_query($con, $query);


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
    <style>
        hr {
            border: 1px solid lightgray
        }

        .fa-check,
        .fa-close {
            width: 30px;
            display: flex;
            justify-content: flex-start
        }
    </style>
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
    <div class="row m-0 p-5 bg-light">

    <?php 
    while ($row = mysqli_fetch_row($result)) { 
        echo '
            <div class=" col-lg-3 mb-2">
                <div class="text-center py-3 px-2 bg-white rounded">
                    <p class="text-muted">Plus</p>
                    <span class="d-block"><span style="font-size:40px">'.$row[4].'</span><small>/month</small></span>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-check mr-2"></i>
                        <span><small>'.$row[1].'</small></span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-envelope mr-2"></i>
                        <span><small>'.$row[2].'</small></span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-phone mr-2"></i>
                        <span><small>'.$row[9].'</small></span>
                    </div>
                    <a class="btn btn-sm btn-primary mt-3 w-100" href="subscriptiondetails.php?id='.$row[0].'">Subscribe</a>
                </div>
            </div>
        ';
    }
    ?>

    </div>
    <?php include('footer.php'); ?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

</html>