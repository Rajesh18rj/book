<?php
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php'); 
$submit_name = "Save";


if($_GET['RID']!="")
{
$submit_name = "Update";
  
 $sql = "select * from material where id = '".$_GET['RID']."'";
  $result = mysqli_query($db,$sql);
  $value = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $name = $value['material_type'];
}


if(isset($_POST['formsubmit'])) {
   $created_date = date("Y-m-d h:i:sa");
  $created_by = $_SESSION['user_id'];
	$catename = $_POST['name'];
   if($_GET['RID']!='')
  { 
     $sql = "update material set `material_type`='".$catename."' where id = '".$_GET['RID']."'";
     $result = mysqli_query($db,$sql);
     header("Location:viewdetails.php?view=material");
  }else {
	$sql = "insert into material(`material_type`,`is_active`) values ('$catename','0')"; // exit;
	$result = mysqli_query($db,$sql);
  }
}

$setactive5 = "active";

include("adminheader.php"); ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Author</h4>
                  <p class="card-category">Complete the details</p>
                </div>
                <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                  

                       <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Author Name</label>
                          <input type="text" name="name" value="<?php echo $name;?>" class="form-control">
                        </div>
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
      