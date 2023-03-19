<?php
ob_start();
session_start();

include('connection.php');

$userid = $_SESSION["userid"];

if($_SESSION['userrole'] == 'admin'){
    $query = "SELECT * FROM users_equipments ue LEFT JOIN users u on u.idusers = ue.idusers LEFT JOIN game_equipment ge ON ge.idgame_equipment = ue.idequipments";
}
else if($_SESSION['userrole'] == 'academy'){
    $query = "SELECT * FROM users_equipments ue LEFT JOIN users u on u.idusers = ue.idusers LEFT JOIN game_equipment ge ON ge.idgame_equipment = ue.idequipments WHERE ue.idusers = '$userid'";
}
else if($_SESSION['userrole'] == 'client'){
    $query = "SELECT * FROM users_equipments ue LEFT JOIN users u on u.idusers = ue.idusers LEFT JOIN game_equipment ge ON ge.idgame_equipment = ue.idequipments WHERE ue.idusers = '$userid'";
}
else{
  header('Location: index.php');
  die();
}

$result = mysqli_query($con, $query);

$result2 = mysqli_query($con, $query);

$sum = 0.0;

while ($row2 = mysqli_fetch_assoc($result2)) {
    $sum += (float)$row2["price"];
}

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
                   Users Equipments
                </h2>
                <hr>
            </div>
            
            <div class="mt-4 mb-4">
                <span class="text-muted">Total Cost: <span class="text-primary"><?php echo $sum." EGB";?></span></span>
            </div>

            <table class="table table-bordered eventList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Equipment Name</th>
                        <th>Equipment Description</th>
                        <th>Equipment Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
                                <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[4].'</td>
                                    <td>'.$row[5].'</td>
                                    <td>'.$row[14].'</td>
                                    <td>'.$row[15].'</td>
                                    <td>'.$row[16].'</td>
                                    ';


                                                   
                        echo'        </tr>
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