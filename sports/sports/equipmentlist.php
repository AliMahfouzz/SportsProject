<?php
ob_start();
session_start();

include('connection.php');

$query = "SELECT * FROM game_equipment";
$result = mysqli_query($con, $query);

include('editequipment.php');
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
                    All Game Equipment
                </h2>
                <hr>
            </div>

            <table class="table table-bordered eventList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Equipment Name</th>
                        <th>Equipment Description</th>
                        <th>Equipment Price</th>
                        <th>Equipment Category</th>
                        <th>Equipment Image</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
                                <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].' EGB.</td>
                                    <td>'.$row[3].'</td>
                                    <td>'.$row[5].'</td>
                                    <td><img src="uploads/'.$row[4].'" height="250px" width="250px"</td>
                                    ';
                                    echo '<td>
                                    <button type="button" class="btn btn-success editbtn1"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
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

<script>
        $(document).ready(function() {

            $('.editbtn1').on('click', function() {

                $('#editequipmentmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                // console.log(data);
                $('#m_id2').val(data[0].replaceAll(' ', ''));
                $('#m_name2').val(data[1]);
                $('#m_description2').val(data[2]);
                $('#m_price2').val(data[3].replaceAll(' ', ''));

            });
        });
    </script>

</html>