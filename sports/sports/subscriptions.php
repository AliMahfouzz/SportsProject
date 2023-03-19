<?php
ob_start();
session_start();

include('connection.php');

$idusers = $_SESSION["userid"];

if($_SESSION['userrole'] == 'admin'){
    $query = "SELECT us.*, u.name as client_name, u2.name as academy_name, u2.subscription_monthly as subscription_monthly FROM users_subscriptions us LEFT JOIN users u on u.idusers = us.idusers LEFT JOIN users u2 on u2.idusers = us.idsubscriptions";
}
else if($_SESSION['userrole'] == 'academy'){
    $query = "SELECT us.*, u.name as client_name, u2.name as academy_name, u2.subscription_monthly as subscription_monthly FROM users_subscriptions us LEFT JOIN users u on u.idusers = us.idusers LEFT JOIN users u2 on u2.idusers = us.idsubscriptions WHERE us.idsubscriptions = '$idusers'";
}
else if($_SESSION['userrole'] == 'client'){
    $query = "SELECT us.*, u.name as client_name, u2.name as academy_name, u2.subscription_monthly as subscription_monthly FROM users_subscriptions us LEFT JOIN users u on u.idusers = us.idusers LEFT JOIN users u2 on u2.idusers = us.idsubscriptions WHERE us.idusers = '$idusers'";
}
else{
  header('Location: index.php');
  die();
}

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
    <link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
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
    <div class="p-5 bg-light">
        <div class="table-responsive w-100 bg-white p-2 rounded shadow-sm">
            <div class=" mx-auto" style="width:max-content">
                <h2>
                    Reserved Subscriptions
                </h2>
                <hr>
            </div>

            <table class="table table-bordered eventList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Subscription Price</th>
                        <th>Academy/Trainer Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
                                <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[3].'</td>
                                    <td>'.$row[5].' EGB</td>
                                    <td>'.$row[4].'</td>
                                    </tr>
                            ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $(".eventList").DataTable();
    });
</script>



</html>