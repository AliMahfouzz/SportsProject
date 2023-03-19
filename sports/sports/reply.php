<div class="modal fade" id="replymodal" tabindex="-1" role="dialog" aria-labelledby="replymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replymodalLabel"> Reply </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="reply.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="q_id" id="q_id">


                    <div class="form-group">
                        <label>Reply Comment</label>
                        <textarea name="description" placeholder="Reply Comment" class="form-control" name="description" cols="45" rows="8" required></textarea>

                    </div>



                    <div class="form-group">
                        <label>Reply File</label>
                        <input type="file" name="fileToUpload" class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-success" type="submit" id="submit1" name="reply" value="Reply">
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="lib/easing/easing.min.js"></script> -->
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/scrollreveal/scrollreveal.min.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>


<?php
    include('connection.php');

    if(isset($_POST["reply"])){
        session_start();
        $description = $_POST['description'];

        $idquestions = $_POST["q_id"];

        $idusers = $_SESSION["userid"];


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

        if($profile_pic != ""){
            $query = "UPDATE questions SET reply_comment = '$description',reply_file='$profile_pic' WHERE idquestions = '$idquestions'";
            $result = mysqli_query($con, $query);
        }
        else{
            $query = "UPDATE questions SET reply_comment = '$description' WHERE idquestions = '$idquestions'";
            $result = mysqli_query($con, $query);
        }
        
        if ($result) {
            $_SESSION['q_message'] = 'Your Reply is created successfully';
            header('Location: questions.php');
        } else {
            $_SESSION['eq_message'] = 'Your Reply is not created, try again !!!!';
            header('Location: questions.php');
        }

    }
?>