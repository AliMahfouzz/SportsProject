<?php
ob_start();
session_start();

include('connection.php');

$idacademy = $_GET["id"];

$query = "SELECT * FROM users WHERE role='academy'";
$result = mysqli_query($con, $query);

$image = "";
$phone = "";
$name = "";
$email = "";

while ($row = mysqli_fetch_row($result)) {
    $name = $row[1];
    $email = $row[2];
    $phone = $row[9];
    $image = $row[8];

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
    <div class="p-5 row m-0 position-relative justify-content-between">
        <div class="col-md-5  border-right border-gray card">
            <div class="rounded  p-3">
                <div class="form-group ">
                    <?php
                        echo '<img src="uploads/'.$image.'" class="w-100" height="400px">';
                    ?>
                </div>
                <div class="form-group ">
                    <label class="col-form-label">Name</label>
                    <span class=" text-muted"><?php echo $name; ?></span>
                </div>
                <div class="form-group ">
                    <label class="col-form-label ">Email</label>
                    <span class=" text-muted"><?php echo $email; ?></span>
                </div>
                <div class="form-group ">
                    <label class="col-form-label">Phone</label>
                    <span class=" text-muted"><?php echo $phone; ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 border-right border-gray ml-2 card">
        <?php
                                            if(isset($_SESSION["smessage"])){
                                                echo '<div class="alert alert-primary mt-3">
                                                '.$_SESSION["smessage"].'
                                                </div>';
                                            }
                                            else if(isset($_SESSION["e_smessage"])){
                                                echo '<div class="alert alert-danger mt-3">
                                                '.$_SESSION["e_smessage"].'
                                                </div>';
                                            }
                                        
                                        ?>
            <form method="POST" class="rounded  p-3" action="subscriptiondetails.php?id=<?php echo $idacademy?>">

            <div>
    <h4>Subscriptions</h4>
    <hr>
</div>
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
                                        <aside>Expiration Date</aside>
                                        <input onkeyup="$cc.expiry.call(this,event)" required maxlength="7" name="expiration_date" placeholder="mm/yyyy" />
                                    </div>

                                    <div class="cvv">
                                        <aside>CVV</aside>
                                        <input placeholder="XXX" required name="cvv" />
                                    </div>

                                </div>

                <input type="hidden" name="idacademy" value="<?php echo $idacademy; ?>" class="form-control form-control-sm">
                <!-- </div> -->
<div class="text-center">
<input type="submit" value="Submit" name="submit" class="btn btn-sm btn-primary mt-3">

</div>
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

if(isset($_POST['submit'])){

    $idusers = $_SESSION["userid"];

    $idsubscriptions = $_POST["idacademy"];

    $query = "insert into users_subscriptions (idusers, idsubscriptions) values ('$idusers','$idsubscriptions')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['smessage'] = 'You are subscribed successfully';
        header('Location: subscriptiondetails.php?id='.$idsubscriptions);
    } else {
        $_SESSION['e_smessage'] = 'You are not subscribed, try again !!!!';
        header('Location: subscriptiondetails.php?id='.$idsubscriptions);
    }

}

?>