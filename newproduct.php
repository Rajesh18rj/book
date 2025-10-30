<?php
global $db, $db;
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php');

$subcat_sql = "select id,category_name from category where is_active='0'";
$subcatlist =mysqli_query($db,$subcat_sql);

//$brandsql = "select id,brand_name from brand where is_active='0'";
//$brandlist = mysqli_query($db,$brandsql);

$locsql = "select id,size_name from sizelist where is_active='0'";
$loclist = mysqli_query($db,$locsql);
$materialsql = "select id,material_type from material where is_active='0'";
$matlist = mysqli_query($db,$materialsql);

$submit_name = "Save";

$RID = $_GET['RID'] ?? null;

if (isset($_GET['RID']) && $_GET['RID'] != "") {
    $submit_name = "Update";

 $sql = "select * from products where id = '".$_GET['RID']."'";
  $result = mysqli_query($db,$sql);
  $value = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $sqft_price = $value['sqft_price'];
  $name = $value['name'];
  $brand = $value['brand'];
  $category = $value['category'];
  $actual_size = $value['actual_size'];
  $material = $value['material'];
  $details = implode(',', json_decode($value['details'],1)) ;
  $description = implode(',', json_decode($value['description'],1)) ;
  $applications = implode(',', json_decode($value['applications'],1)) ;
  $group_name = $value['group_name'];
  $filter_size = $value['filter_size'];
  $finish = $value['finish'];
  $sink_type = $value['sink_type'];
  $has_sample = $value['has_sample'];
  $quality = $value['quality'];
  $coverage_area = $value['coverage_area'];
  $no_pcs_inbox = $value['no_pcs_inbox'];
  $subcat_sql = "select id,category_name from Category where id='$category'";
  $subcatlist =mysqli_query($db,$subcat_sql);
  foreach ($subcatlist as $value) {
  $catarray[$value['id']] = $value;
  }
//  foreach ($brandlist as $value1) {
//  $brandarray[$value1['id']] = $value1;
//  }
  foreach ($matlist as $value2) {
  $matarray[$value2['id']] = $value2;
  }
  foreach ($loclist as  $value3) {
  $sizarray[$value3['id']] = $value3;
  }
}

if(isset($_POST['formsubmit'])) {
    $created_date = date("Y-m-d h:i:sa");
    $created_by = $_SESSION['user_id'];
	$sqft_price = $_POST['sqft_price'];
	$name = $_POST['name'];
	$brand = $_POST['brand'];
	$category = $_POST['category'];
	$actual_size = $_POST['actual_size'];
	$material = $_POST['material'];
  $details = explode(',', $_POST['details']);
	$details = json_encode($details,1);
  $description = explode(',', $_POST['description']);
	$description = json_encode($description,1);
	$group_name = $_POST['group_name'];
	$filter_size = $_POST['filter_size'];
	$finish = $_POST['finish'];
  $sink_type = $_POST['sink_type'];
  $has_sample = $_POST['has_sample'];
  $quality = $_POST['quality'];
  $coverage_area = $_POST['coverage_area'];
  $no_pcs_inbox = $_POST['no_pcs_inbox'];
  $applications = explode(',', $_POST['applications']);
	$applications = json_encode($applications,1);
 $total = count($_FILES['Filename']['name']);
for( $i=0 ; $i < $total ; $i++ ) {
  $file_tmp =$_FILES['Filename']['tmp_name'][$i];
  $file_name = $_FILES['Filename']['name'][$i];
  $ext=explode(".",$file_name);
  $Filename=  "file_".time()."_".uniqid().'.'.$ext[1];
  $Filenames[] = $Filename;

  $target_dir = "./uploads/";
  $target_file = $target_dir . basename($file_name);
  if(!move_uploaded_file($file_tmp, $target_dir.$Filename)) {
    echo '<script>alert("Sorry, there was a problem uploading your file.")</script>';
  }
}

    if (isset($_GET['RID']) && $_GET['RID'] != '') {
        $sql = "update products set `name`='$name', `sqft_price`='$sqft_price', `category`='$category', `brand`='$brand', `actual_size`='$actual_size', `material`='$material', `details`='$details', `description`='$description', `group_name`='$group_name', `filter_size`='$filter_size', `sink_type`='$sink_type', `finish`='$finish', `applications`='$applications', `has_sample`='$has_sample', `quality`='$quality', `coverage_area`='$coverage_area', `no_pcs_inbox`='$no_pcs_inbox',  `updated_by`='$created_by', `updated_date`='$created_date' where id = '".$_GET['RID']."'";
        $result = mysqli_query($db,$sql);
        echo '<script>alert("Book updated successfully!");</script>';
        header("Location:viewdetails.php?view=products");

        // Generate ISBN password
        $isbn = $_POST['group_name']; // ISBN
        $generated_password = 'Login@123';
        $check_login = mysqli_query($db, "SELECT * FROM book_login WHERE isbn='$isbn'");
        if(mysqli_num_rows($check_login) > 0){
            mysqli_query($db, "UPDATE book_login SET password='$generated_password' WHERE isbn='$isbn'");
        } else {
            mysqli_query($db, "INSERT INTO book_login (isbn, password) VALUES ('$isbn', '$generated_password')");
        }

    } else {
        $Filename = json_encode($Filenames,1);

        $sql = "INSERT INTO `products`(`name`, `sqft_price`, `category`, `brand`, `actual_size`, `material`, `details`, `description`, `group_name`, `filter_size`, `sink_type`, `finish`, `applications`, `has_sample`, `quality`, `coverage_area`, `no_pcs_inbox`, `imagelist`, `additional_attributes`, `is_active`, `created_by`, `created_date`) values ('$name','$sqft_price','$category','$brand','$actual_size','$material','$details','$description','$group_name','$filter_size','$sink_type','$finish','$applications','$has_sample','$quality','$coverage_area','$no_pcs_inbox','$Filename','','1','$created_by','$created_date')";
        $result = mysqli_query($db,$sql);
        echo '<script>alert("Book saved successfully!");</script>';

        // Generate ISBN password
        $isbn = $_POST['group_name']; // ISBN
        $generated_password = 'Login@123';
        $check_login = mysqli_query($db, "SELECT * FROM book_login WHERE isbn='$isbn'");
        if(mysqli_num_rows($check_login) > 0){
            mysqli_query($db, "UPDATE book_login SET password='$generated_password' WHERE isbn='$isbn'");
        } else {
            mysqli_query($db, "INSERT INTO book_login (isbn, password) VALUES ('$isbn', '$generated_password')");
        }
    }


$created_date = '';
  $created_by = '';
  $sqft_price = '';
  $name = '';
  $brand = '';
  $category = '';
  $actual_size = '';
  $material = '';
  $details = '';
  $details = '';
  $description = '';
  $description = '';
  $group_name = '';
  $filter_size = '';
  $finish = '';
  $sink_type = '';
  $has_sample = '';
  $quality = '';
  $coverage_area = '';
  $no_pcs_inbox = '';
  $applications = '';
  $applications = '';
  $Filename = '';
}

$setactive7 = "active";
$setactive7 = "active";
include("adminheader.php"); ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Books</h4>
                  <p class="card-category">Complete the details</p>
                </div>
                <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" value="0" name="category" class="form-control">
                  <input type="hidden" value="0" name="brand" class="form-control">
                     <input type="hidden" value="0"  name="filter_size" class="form-control">

                         <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Book Title</label>
                          <input type="text" name="name" value="<?php echo $name;?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Author</label>
                         <input type="text" name="material" class="form-control"  value="<?php echo $material;?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">ISBN</label>
                          <input type="text" name="group_name" class="form-control" value="<?php echo $group_name;?>" >
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Book Price</label>
                          <input type="text" name="sqft_price" value="<?php echo $sqft_price;?>" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" value="" name="actual_size" value="<?php echo $actual_size;?>" class="form-control">
                      <input type="hidden" value=""  name="sink_type" value="<?php echo $sink_type;?>" class="form-control">
                        <input type="hidden" value=""  name="finish" value="<?php echo $finish;?>" class="form-control">
                        <input type="hidden" value=""  name="quality" value="<?php echo $quality;?>" class="form-control">
                        <input type="hidden" value=""  name="coverage_area" value="<?php echo $coverage_area;?>" class="form-control">
                        <input type="hidden"  name="has_sample"  value="1" <?php echo $has_sample=='1'?'checked':'';?> >
                          <input type="hidden"   name="has_sample" value="0" <?php echo $has_sample=='0'?'checked':'';?> >
<input type="hidden" value="" name="no_pcs_inbox" value="<?php echo $no_pcs_inbox;?>" class="form-control">
                        <input type="hidden" value=""  name="details" class="form-control">

                        <input type="hidden" value=""  name="description" class="form-control">
                        <input type="hidden" name="applications" value="">
                      <div class="col-md-4">
                      <?php
                      if(empty($_GET['RID'])){ ?>

                          <label class="bmd-label-floating">Upload Image</label> <?php foreach ($Filenamelist as $key => $value) { ?>
                              <img src="uploads/<?php echo $value; ?>" width="50px"/>
                          <?php } ?>


                          <input id="file-input" type="file" class="form-control" multiple name="Filename[]">
                          <?php } ?>
                      </div>

                        <div class="col-md-4"><br>
                          <button type="submit" name="formsubmit" class="btn btn-primary pull-right"><?php echo $submit_name ?></button>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>