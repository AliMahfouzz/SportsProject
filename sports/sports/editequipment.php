<?php
ob_start();
?>
 <div class="modal fade"  id="editequipmentmodal" tabindex="-1" role="dialog" aria-labelledby="editequipmentmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editequipmentmodalLabel"> Edit Equipment </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="editequipment.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <input type="hidden" name="m_id2" id="m_id2">
                        <div class="row">

                            <div class="form-group col">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" required name="mname" class="form-control" id="m_name2">
                            </div>

                            
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label>Description</label>
                                <textarea required name="description" id="m_description2" class="form-control" style="resize: none; height:150px" rows="50"></textarea>
                            </div>
                            <div class="form-group ">
                <label class="mb-0"><small>Category</small></label>
                <select required name="categories" class="form-control form-control-sm">
                    <option selected disabled>Select a category</option>
                    <option value="Baseball Equipment">Baseball Equipment</option>
                    <option value="Football Equipment">Football Equipment</option>
                    <option value="Basketball Equipment">Basketball Equipment</option>
                    <option value="Swimming Equipment">Swimming Equipment</option>
                    <option value="Others">Others</option>
                </select>
            </div>
                        </div>

                        
                        <div class="row">

                            <div class="form-group col">
                                <label for="exampleInputEmail1">Price </label>
                                <input type="number" min="0" step="any" required name="price" class="form-control" id="m_price2">
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

            $m_id = $_POST["m_id2"];

            $profile_pic = "";

            if($m_id != ""){

                $mname = $_POST['mname'];
                $mdescription = $_POST['description'];
                $mprice = $_POST['price'];
                $category = $_POST['categories'];
            
            
            
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
                    $query = "UPDATE game_equipment SET category = ?, name = ?,description = ?,price = ?,image = ? WHERE idgame_equipment = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["m_id2"];

                    $stmt->bind_param('sssssi', $category, $mname,$mdescription,$mprice,$profile_pic, $id);

                    $stmt->execute();

                }
                else{
                    $query = "UPDATE game_equipment SET category = ?, name = ?,description = ?,price = ? WHERE idgame_equipment = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["m_id2"];

                    $stmt->bind_param('ssssi', $category, $mname,$mdescription,$mprice, $id);

                    $stmt->execute();

                }


                
                if ($stmt) {
                    header("Location: equipmentlist.php");
                    exit();
                } else {
                    header("Location: equipmentlist.php");
                    exit();
                }

                //echo var_dump($stmt);
            }
            
            
            
        }


    ?>