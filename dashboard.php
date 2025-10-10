<?php
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php'); 
  $sql = "select id from category where is_active='0'";
  $result = mysqli_query($db,$sql);
  $Categoryscount = mysqli_num_rows($result);


  $sql = "select id from products where is_active='0'";
  $result = mysqli_query($db,$sql);
  $Productscount = mysqli_num_rows($result);


  $sql = "select id from material where is_active='0'";
  $result = mysqli_query($db,$sql);
  $materialcount = mysqli_num_rows($result);


  $sql = "select id from sizelist where is_active='0'";
  $result = mysqli_query($db,$sql);
  $sizelistcount = mysqli_num_rows($result);


$setactive0 = "active";

include("adminheader.php"); ?>
 <div class="content">
        <div class="container-fluid">
          <div class="row">
            
            
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-twitter"></i>
                  </div>
                  <p class="card-category">Books</p>
                  <h3 class="card-title">Total :  <?php echo $Productscount; ?>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     <i class="material-icons"></i>
                    <a href="viewdetails.php?view=products">View Details</a>
                  </div>
                </div>
              </div>
            
           
          </div>
        </div>
      </div>
  