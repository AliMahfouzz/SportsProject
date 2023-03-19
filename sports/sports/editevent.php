<?php
ob_start();
?>
 <div class="modal fade"  id="editeventmodal" tabindex="-1" role="dialog" aria-labelledby="editeventmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editeventmodalLabel"> Edit Event </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="editevent.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <input type="hidden" name="m_id" id="m_id">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" required name="mname" class="form-control" id="m_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <select class="form-control" name="category" id="m_category">
                                    <option value="zumba">Zumba</option>
                                    <option value="running">Running</option>
                                    <option value="soccer">Soccer</option>
                                    <option value="basketball">Basketball</option>
                                    <option value="gulf">Gulf</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea required name="description" id="m_description" class="form-control" style="resize: none; height:150px" rows="50"></textarea>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1111">Duration </label>
                                <input type="text"  required name="duration" class="form-control" id="m_duration">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword111111">Min. Age </label>
                                <input type="text" required  name="age" class="form-control" id="m_age">
                            </div>
                        </div>
                        
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Price </label>
                                <input type="number" min="0" step="any" required name="price" class="form-control" id="m_price">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Image </label>
                                <input type="file"  name="fileToUpload" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="update">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["update"])) {
            include("connection.php");

            $m_id = $_POST["m_id"];

            $profile_pic = "";

            if($m_id != ""){

                $mname = $_POST['mname'];
                $mdescription = $_POST['description'];
                $mprice = $_POST['price'];
                $mcategory = $_POST['category'];
                $duration = $_POST['duration'];
                $age = $_POST['age'];
            
            
            
                    $target_dir = "uploads/";
                    $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);
            
                    //get all emails to be validated
            
            
                    if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
                        } else {
                            $error_msg = "Sorry, there was an error uploading your file.";
                        }
                    }
            
            
                if($profile_pic != ""){
                    $query = "UPDATE events SET ename = ?,edescription = ?,category = ?,eprice = ?,eduration = ?,age = ?,image = ? WHERE idevents = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["m_id"];

                    $stmt->bind_param('sssssssi', $mname,$mdescription,$mcategory,$mprice,$duration,$age,$profile_pic, $id);

                    $stmt->execute();

                }
                else{
                    $query = "UPDATE events SET ename = ?,edescription = ?,category = ?,eprice = ?,eduration = ?,age = ? WHERE idevents = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["m_id"];

                    $stmt->bind_param('ssssssi', $mname,$mdescription,$mcategory,$mprice,$duration,$age, $id);

                    $stmt->execute();

                }


                
                if ($stmt) {
                    header("Location: eventlist.php");
                    exit();
                } else {
                    header("Location: eventlist.php");
                    exit();
                }

                //echo var_dump($stmt);
            }
            
            
            
        }


    ?>