<?php
  $title = "Quotation Details | Zriya Solutions";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php include('header.php'); ?>
<?php 


    include_once 'class/category_class.php';
    $id = $_GET["id"];
    $cate = new Category();

if (isset($_POST['submit'])) { 
    extract($_POST); 
    if(isset($cate_name)){
        $status = $cate->update_category($cate_name,$id);
        if ($status) {
            // Registration Success
            $_SESSION['success'] = "Upload Successfully";
        } else {
            // Registration Failed
            //echo 'Wrong username or password';
            $_SESSION['error'] = "Upload Failed";
        }
    }else{
        echo "error";
    }
     
  }


//include_once 'class/award_class.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="quotation_view.php">Add Category</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   

	  <!-- Main content -->
	<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">    
                <a href="category.php">
                  <button class="btn btn-zo">Category List</button>
                </a>

                <br><br>         

                    <div class="card">

                    
                        <div class="card-header card-zg">
                            <h3 class="card-title">Award Details</h3>

                            
                        </div>

                        <?php
                            
                            $fetch_cate = new Category();

                            $datas = $fetch_cate->fetch_one_record($id);

                            foreach($datas as $data){
                        ?>

                            <div class="card-body">
                                <form action="" name="Add_category" method="post" enctype="multipart/form-data">
                                <div class="input-group row">

                                    <label class="form-control col-sm-3">Category Name </label>
                                        <label class="form-control col-sm-3"><?php echo $data['category_name']; ?> </label> 
                                       

                                    
                                        
                                    </div><br>

                                
                                </form>

                           
                            </div>  


                        <?php


                            }


                        ?>
                        
                                        
                    </div>
                    <!-- /.card -->
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
      <!-- /.container-fluid -->
    </section>

   
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
  
  ?>   
   

<?php include('footer.php'); ?>