<?php
ob_start();
session_start();

include('connection.php');

$userid = $_SESSION["userid"];

if($_SESSION['userrole'] == 'admin'){
    $query = "SELECT q.*, u.name as client_name, u1.name as reply_name FROM questions q LEFT JOIN users u on u.idusers = q.idusers LEFT JOIN users u1 on u1.idusers = q.reply_user";
}
else if($_SESSION['userrole'] == 'academy'){
    $query = "SELECT q.*, u.name as client_name, u1.name as reply_name FROM questions q LEFT JOIN users u on u.idusers = q.idusers LEFT JOIN users u1 on u1.idusers = q.reply_user WHERE q.reply_user = '$userid'";
}
else if($_SESSION['userrole'] == 'client'){
    $query = "SELECT q.*, u.name as client_name, u1.name as reply_name FROM questions q LEFT JOIN users u on u.idusers = q.idusers LEFT JOIN users u1 on u1.idusers = q.reply_user WHERE q.idusers = '$userid'";
}
else{
  header('Location: index.php');
  die();
}

$result = mysqli_query($con, $query);

include('reply.php');
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
                   Questions
                </h2>
                <hr>
            </div>
            <?php
            if (isset($_SESSION["q_message"])) {
                echo '<div class="alert alert-primary">
                                                ' . $_SESSION["q_message"] . '
                                                </div>';
            } else if (isset($_SESSION["eq_message"])) {
                echo '<div class="alert alert-danger">
                                                ' . $_SESSION["eq_message"] . '
                                                </div>';
            }

            ?>
            <table class="table table-bordered eventList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Question Title</th>
                        <th>Question Description</th>
                        <th>Question File</th>
                        <th>Reply User</th>
                        <th>Reply Comment</th>
                        <th>Reply File</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
                                <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[8].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>';
                                    if($row[3] != "" && isset($row[3])){

                                        echo "<td><a href='uploads/".$row[3]."' download><i class='fa fa-download text-info'></i></a></td>";
                                    }
                                    else{
                                        echo "<td></td>";
                                    }

                                    echo '
                                    <td>'.$row[9].'</td>
                                    <td>'.$row[5].'</td>
                                    ';

                                    if($row[6] != "" && isset($row[6])){
                                        echo "<td><a href='uploads/".$row[6]."' download><i class='fa fa-download text-info'></i></a></td>";
                                    }
                                    else{
                                        echo "<td></td>";
                                    }

                                    if($_SESSION["userid"] == $row[7] && !($row[5])){
                                        echo "
                                    <td>
                                        <a class='btn btn-success text-white reply' type='button'><i class='fa fa-reply'></i></a></td>";
                                    
                                    }
                                    else{
                                        echo "<td></td>";
                                    }

                                                   
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

<script>
        $(document).ready(function() {

            $('.reply').on('click', function() {

                $('#replymodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#q_id').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>

</html>