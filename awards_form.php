<?php
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php'); 

$submit_name = "Save";


if(isset($_POST['formsubmit'])) {
    $created_date = date("Y-m-d h:i:sa");
  $created_by = $_SESSION['user_id'];
	$name = $_POST['name'];
	$award_type = $_POST['award_type'];
	$department = $_POST['department'];
	$college = $_POST['college'];
	$year = $_POST['year'];
	
  $file_tmp =$_FILES['Filename']['tmp_name'];
  $file_name = $_FILES['Filename']['name'];
	
  $ext=explode(".",$file_name);
		
  $Filename=  "file_".time()."_".uniqid().'.'.$ext[1];

  $target_dir = "./uploads/";
  $target_file = $target_dir . basename($file_name);

  if(!move_uploaded_file($file_tmp, $target_dir.$Filename)) {
    echo '<script>alert("Sorry, there was a problem uploading your file.")</script>'; 
  } 
	  $sql = "INSERT INTO `awards`(`name`, `award_type`, `department`, `college`, `year`, `imagelist`, `additional_attributes`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) values ('$name','$award_type','$department','$college','$year','$Filename','','0','$created_by','$created_date','','')";
	
	$result = mysqli_query($db,$sql);
}

$setactive9 = "active";
include("adminheader.php"); ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Awards</h4>
                  <p class="card-category">Complete the details</p>
                </div>
                <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                         <input type="text" name="name" value="<?php echo $name;?>" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                          
                        <div class="form-group">
                          <label class="bmd-label-floating">Award Type</label>
                           <input type="text" name="award_type" value="<?php echo $name;?>" class="form-control">
                      </div>
                      </div>

                      <div class="col-md-4">
                          
                        <div class="form-group">
                          <label class="bmd-label-floating">Department</label>
                          <input type="text" name="department" value="<?php echo $name;?>" class="form-control">
                      </div>
                      </div>
                      
                    </div>
                     
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">College/Company</label>
                          <input type="text" name="college" value="<?php echo $name;?>" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Year</label>
                          <input type="text" name="year" class="form-control" value="<?php echo $group_name;?>" >
                        </div>
                      </div>
                     
                    </div>
                    
                      
                      <div class="col-md-6">
                          <label class="bmd-label-floating">Upload Image</label> 
                            
                          
                          <input id="file-input" type="file" class="form-control" name="Filename">
                      </div>
                     
                    </div>
                
                    
                     <button type="submit" name="formsubmit" class="btn btn-primary pull-right"><?php echo $submit_name ?></button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
         
          </div>
        </div>
      </div>