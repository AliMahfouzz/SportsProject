<?php
ob_start();
session_start();

include('connection.php');

$query = "SELECT * FROM events ";
$result = mysqli_query($con, $query);
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
        @keyframes down-btn {
            0% {
                bottom: 20px;
            }

            100% {
                bottom: 0px;
            }

            0% {
                opacity: 0;
            }

            100% {
                opaicty: 1;
            }
        }

        @-webkit-keyframes down-btn {
            0% {
                bottom: 20px;
            }

            100% {
                bottom: 0px;
            }

            0% {
                opacity: 0;
            }

            100% {
                opaicty: 1;
            }
        }

        @-moz-keyframes down-btn {
            0% {
                bottom: 20px;
            }

            100% {
                bottom: 0px;
            }

            0% {
                opacity: 0;
            }

            100% {
                opaicty: 1;
            }
        }

        @-o-keyframes down-btn {
            0% {
                bottom: 20px;
            }

            100% {
                bottom: 0px;
            }

            0% {
                opacity: 0;
            }

            100% {
                opaicty: 1;
            }
        }




        /* Image Card */
        .img-card {

            position: relative;
            border-radius: 5px;
            text-align: left;

            -webkit-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
            -o-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        }

        .img-card .card-image {
            position: relative;
            margin: auto;
            overflow: hidden;
            border-radius: 5px 5px 0px 0px;
            height: 200px;
        }

        .img-card .card-image img {
            width: 100%;
            border-radius: 5px 5px 0px 0px;
height: 100%;
            -webkit-transition: all 0.8s;
            -moz-transition: all 0.8s;
            -o-transition: all 0.8s;
            transition: all 0.8s;
        }

        .img-card .card-image:hover img {
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -o-transform: scale(1.1);
            transform: scale(1.1);
        }

        .img-card .card-text {
            padding: 0 15px 15px;
            line-height: 1.5;
        }

        .img-card .card-link {
            padding: 20px 15px 30px;
            width: -webkit-fill-available;
        }

        .img-card .card-link a {
            text-decoration: none;
            position: relative;
            padding: 10px 0;
        }

        .img-card .card-link a:after {
            top: 30px;
            content: "";
            display: block;
            height: 2px;
            left: 50%;
            position: absolute;
            width: 0;

            -webkit-transition: width 0.3s ease 0s, left 0.3s ease 0s;
            -moz-transition: width 0.3s ease 0s, left 0.3s ease 0s;
            -o-transition: width 0.3s ease 0s, left 0.3s ease 0s;
            transition: width 0.3s ease 0s, left 0.3s ease 0s;
        }

        .img-card .card-link a:hover:after {
            width: 100%;
            left: 0;
        }

        .img-card.iCard-style1 .card-title {
            position: absolute;
            font-family: 'Open Sans', sans-serif;
            z-index: 1;
            top: 10px;
            left: 10px;
            font-size: 30px;
            color: #fff;
        }

        .img-card.iCard-style1 .card-text {
            color: #795548;
        }

        .img-card.iCard-style1 .card-link a {
            color: #FF9800;
        }

        .img-card.iCard-style1 .card-link a:after {
            background: #FF9800;
        }

        .img-card.iCard-style2 .card-title {
            padding: 15px;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
        }

        .img-card.iCard-style2 .card-image {
            margin-bottom: 15px;
        }

        .img-card.iCard-style2 .card-caption {
            text-align: center;
            top: 80%;
            font-size: 17px;
            color: #fff;
            position: absolute;
            width: 100%;
            font-family: 'Roboto', sans-serif;
            z-index: 1;
        }

        .img-card.iCard-style2 .card-link a {
            border: 1px solid  var(--primary);
            padding: 8px;
            border-radius: 3px;
            
            font-size: 13px;

            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            -o-transition: all 0.4s;
            transition: all 0.4s;
        }

        .img-card.iCard-style2 .card-link a:hover {
            background: var(--primary);
        }

        .img-card.iCard-style2 .card-link a:hover span {
            color: #fff;
        }
        span.text-primary{
            font-weight: 500;
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
    <div class="row m-0 p-5">
    <?php

        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class=" col-lg-4">
                    <div class="img-card iCard-style2 m-2">
                        <div class="card-content">
                            <div class="card-image">
                                
                                <img src="uploads/'.$row["eimage"].'" />
                            </div>

                            <span class="card-title d-flex align-items-center justify-content-between"><span>'.$row["ename"].' </span> <span class="text-primary ml-2"><b>'.$row["eprice"].' EGB</b></span></span>

                            <div class="card-text">
                                <p class="m-0">
                                    <small> <span  class="text-primary"> Description:</span> <span>'.$row["edescription"].'</span>
                                    </small>
                                    
                                </p>
                                 <small class="d-block"><span class="text-primary">Category:</span> '.$row["category"].'
                                    </small>
                                     <small class="d-block"><span class="text-primary">
                                     Duration:</span> '.$row["eduration"].'
                                    </small>
                                     <small class="d-block"><span class="text-primary">
                                     Min. Age:</span> '.$row["age"].'
                                    </small>
                            </div>

                        </div>

                        <div class="card-link text-center">
                            <a href="eventdetails.php?id='.$row["idevents"].'" title="Subscribe"><span>Subscribe</span></a>
                        </div>
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