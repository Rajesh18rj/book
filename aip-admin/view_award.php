<?php
  $title = "Quotation Details | Zriya Solutions";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php include('header.php'); ?>
<?php 


    include_once 'class/award_class.php';
   
     
  


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
              <li class="breadcrumb-item active"><a href="quotation_view.php">Quotations</a></li>
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
                <a href="awards.php">
                  <button class="btn btn-zo">Award List</button>
                </a>

                <br><br>         

                    <div class="card">

                    
                        <div class="card-header card-zg">
                            <h3 class="card-title">Award Details</h3>

                            
                        </div>
                        <?php 
                        if(isset($_GET["id"])){
                            $id = $_GET["id"];
                            $result = new Awrd();
                            $datas = $result->fetchoneaward($id);
                            
                            foreach ($datas as $data) {  
                        
                        
                        ?>
                             <div class="card-body">
                        <form action="" name="Add_awards" method="post" enctype="multipart/form-data">
                            <div class="input-group row">

                                <label class="form-control col-sm-3">Name </label>
                                <label class="form-control col-sm-3"><?php echo $data['name']; ?> </label> 
                                <label class="form-control col-sm-3">Award Type </label>
                                 <label class="form-control col-sm-3"><?php echo $data['award_type']; ?> </label>
                               
                            </div> <br>

                            <div class="input-group row">
                                <label class="form-control col-sm-3">Department </label>
                                <label class="form-control col-sm-3"><?php echo $data['department']; ?> </label> 
                                <label class="form-control col-sm-3">College </label>
                                 <label class="form-control col-sm-3"><?php echo $data['college']; ?> </label>
                               
                            </div><br>

                            <div class="input-group row">

                            <label class="form-control col-sm-3">Year </label>
                                <label class="form-control col-sm-3"><?php echo $data['year']; ?> </label> 
                                <label class="form-control col-sm-3">Additional Attribute </label>
                                 <label class="form-control col-sm-3"><?php echo $data['additional_attributes']; ?> </label>
                               
                            </div><br>

                            <div class="input-group row">

                            <label class="form-control col-sm-3">Created By </label>
                                <label class="form-control col-sm-3"><?php echo $data['created_by']; ?> </label> 
                                <label class="form-control col-sm-3">Images </label>
                                <img src = "uploads/award_images/<?php echo $data['imagelist']; ?>" width = "56px"
                                height= "50px">
                            
                              
                                
                            </div><br>

                            <div class="input-group row">
                                

                               
                               
                                
                            </div><br>

                           
                           
                            <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark btn-block btn-flat" id="submit" name="submit">Submit</button>
                            </div> 
                            <!-- /.col -->
                            </div>

                           
                        </form>

                           
                        </div>    


                        <?php                      
                           }
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