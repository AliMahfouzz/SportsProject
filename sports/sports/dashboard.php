<?php
ob_start();
session_start();

include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="p-5">
    <section class="department_section p-2" id="services">
<div class="department_container">
  <div class="container ">
    <div class="heading_container heading_center">
      <h2>
        Our Services
      </h2>
      <p>
      We offer the full spectrum of services to help you work better.
      </p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="box ">
          <div class="img-box">
            <img src="images/chating.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
            Chatting
            </h5>
            <p>
            Contact with Academy or Trainer.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box ">
          <div class="img-box">
            <img src="images/subscribe.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
            Subscriptions
            </h5>
            <p>
            Subscribe in events provided by Academy / Trainer.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box ">
          <div class="img-box">
            <img src="images/sport.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
            Equipments
            </h5>
            <p>
            Buy game equipments
            </p>
          </div>
        </div>
      </div>
     
    </div>
    <!-- <div class="btn-box">
      <a href="">
        View All
      </a>
    </div> -->
  </div>
</div>
</section>
    </div>

    <?php  include('footer.php');?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

</html>