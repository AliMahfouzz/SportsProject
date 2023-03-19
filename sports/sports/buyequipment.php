<?php
ob_start();
session_start();

include 'connection.php';

$query = "SELECT * FROM game_equipment";
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

    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <style>
        .dataTables_filter input {
            border: 1px solid lightgray !important;
            border-radius: 4px
        }

        .paginate_button {
            border: 1px solid lightgray;
            border-radius: 4px;
            padding: 5px 10px;
            margin: 0 2px;
            cursor: pointer;
        }

        .dataTables_paginate a.active {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }


        .product_container .box {
            margin-top: 15px;
            background-color: #f4f5f6;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
        }

        .product_container .box a {
            color: inherit;
        }

        .product_container .box .img-box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            width: 100%;
            height: 150px;
            padding: 30px 10px;
            margin-top: 20px;

        }

        .product_container .box .img-box img {
            width: auto;
            height: 100%;
            max-width: 100%;
            min-height: 100%;
            border-radius: 10px
        }

        .product_container .box .p_cart {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
            border-radius: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;

            color: #ffffff;
        }

        .product_container .box .p_cart input[type="checkbox"] {
            width: 100% !important;
            height: 100% !important;
            border-radius: 50%;
        }

        .product_container .box .detail-box {
            width: 100%;
            padding: 15px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .product_container .box .detail-box .p_rating {
            color: #f1b723;
        }

        .product_container .box .detail-box .p_name {
            display: inline-block;
            font-size: 20px;
            font-weight: 500;
            margin: 5px 0;
        }

        .product_container .box .detail-box .p_price {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .product_container .box .detail-box .p_price .new_price {
            margin-right: 5px;
        }

        .product_container .box .detail-box .p_price .old_price {
            text-decoration: line-through;
        }

        .product_container .box .detail_bottom {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .product_container .box .price a {
            color: inherit;
            font-weight: 600;
        }

        .btn-box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-top: 45px;
        }

        .btn-box button {
            display: inline-block;
            padding: 10px 45px;
            background-color: var(--color1);
            color: #ffffff;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 15px;
            border: 1px solid var(--color1);
            -webkit-transition: all .3s;
            transition: all .3s;
        }

        .btn-box button:hover {
            background-color: transparent;
            color: var(--color1);
        }

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
        hr{
            border:2px solid var(--primary) !important
        }
    </style>
</head>

<body>
    <?php
    if ($_SESSION['userrole'] == 'admin') {
        include 'adminnavbar.php';
    } else if ($_SESSION['userrole'] == 'academy') {
        include 'academynavbar.php';
    } else if ($_SESSION['userrole'] == 'client') {
        include 'clientnavbar.php';
    } else {
        header('Location: index.php');
        die();
    }

    ?>
    <div class="p-5 ">
        <form method="POST"  action="buyequipment.php">
            <div class="product_container">
                <div class="row equipments">


                    <?php

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
            <div class="col-sm-6 col-lg-4 ">
              <div class="box">
                <a href="" class="p_cart">
                  <input type="checkbox" name="elements[]" value="' . $row[0] . '" >
                </a>
                <div class="img-box">
                  <img src="uploads/' . $row[4] . '" alt="" >
                </div>
                <div class="detail-box">

                  <div class="d-flex align-items-center justify-content-between w-100">
                  <a href="" class="p_name">
                  ' . $row[1] . '
                  </a>
                  <h6 class="p_price text-primary" style="margin:5px 0;">
                    <span class="new_price">
                    ' . $row[3] . ' EGB.
                    </span>
                  </h6>
                  </div>
                  <span  class="text-muted">
                  <small>' . $row[2] . '</small>
                  </span>

                </div>
              </div>
            </div>
            ';
                    }
                    ?>

                </div>
            </div>
<hr>
            <div class=" col-md-8 m-auto">
                <div class="card p-2" style="align-items:center;">

                    <aside><small class=" text-muted">Card Number</small></aside>
                    <div class="card-container">
                        <!--- ".card-type" is a sprite used as a background image with associated classes for the major card types, providing x-y coordinates for the sprite --->
                        <div class="card-type"></div>
                        <input placeholder="0000 0000 0000 0000" required onkeyup="$cc.validate(event)" name="creditcard" />
                        <!-- The checkmark ".card-valid" used is a custom font from icomoon.io --->
                        <div class="card-valid">&#x2713;</div>
                    </div>

                    <div class="card-details clearfix">

                        <div class="expiration">
                            <aside class="text-muted">Expiration Date</aside>
                            <input onkeyup="$cc.expiry.call(this,event)" required maxlength="7" name="expiration_date" placeholder="mm/yyyy" />
                        </div>

                        <div class="cvv">
                            <aside  class="text-muted">CVV</aside>
                            <input placeholder="XXX" required name="cvv" />
                        </div>

                    </div>
                </div>

                <!-- </div> -->
                <div class="text-center">
                    <input type="submit" value="Submit" name="submit" class="btn btn-sm btn-primary mt-3">

                </div>
            </div>
        </form>

    </div>
    <?php include 'footer.php'; ?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js-CreditCardValidator-master/creditCardValidator.js"></script>



<?php

if (isset($_POST['submit'])) {

    $idusers = $_SESSION["userid"];

    foreach ($_POST["elements"] as $element) {
        $query = "insert into users_equipments (idusers, idequipments) values ('$idusers','$element')";
        $result = mysqli_query($con, $query);
    }

    header('Location: usersequipments.php');
    die();
    // echo var_dump($_POST);
    // echo var_dump('<br>'.$idusers);

}

?>