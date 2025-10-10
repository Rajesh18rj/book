<?php
ini_set('display_errors',0);
session_start();
include('dbconfig.php'); 
$setactive10 = "active";
include("header.php"); 
$id = base64_decode($_GET['AID']);
$is_active = base64_decode($_GET['APP']);

$sql = "select * from awards  where is_active='".$is_active."' and id=".$id;
$result = mysqli_query($db,$sql);

foreach ($result as $value) {
	$result_name = $value['name'];
	$result_award_type = $value['award_type'];
	$result_department = $value['department'];
	$result_college = $value['college'];
	$result_imagelist = $value['imagelist'];
	$result_year = $value['year'];

}


/*  	$result_name = "name";
	$result_award_type = "award_type";
	$result_department = "department";
	$result_college ="college";
	$result_imagelist = "imagelist";
	$result_year = "year";
  */

  ?>
<section class="breadcrumbSection" style="background-image: url('images/breadcrumb-img-1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbTitle">
                    <h1><span>Awards</span></h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Awards</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="awards-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="printPage">
                        <div class="idTitle">
                            <h2>AIP AWARD</h2>
                            <div class="idDate"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<h2> <?php echo $result_year;?></h2>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
                        </div>
                        <div class="idPhoto">
                            <img src="aip-admin/uploads/award_images/<?php echo $result_imagelist;?>"/>
                        </div>
                        <ul class="idDetails">
                            <li><span>Name</span>: <?php echo $result_name;?> </li>
                            <li><span>Award Type</span>:  <?php echo $result_award_type;?> </li>
                            <li><span>Department</span>:  <?php echo $result_department;?></li>
                            <li><span>College</span>:  <?php echo $result_college;?></li>
                        </ul>
                        <img src="images/bottom-bg.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>