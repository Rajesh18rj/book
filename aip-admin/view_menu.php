<?php
  $title = "Quotation Details | Zriya Solutions";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php include('header.php'); ?>
<?php 


    include_once 'class/menu_class.php';

    $id = $_GET["id"];




//include_once 'class/award_class.php'; ?>

<style>
        .error {
            color: red;
        }
    </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="quotation_view.php">Menu Script</a></li>
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
                <a href="menu.php">
                  <button class="btn btn-zo">Menu List</button>
                </a>

                <br><br>         

                    <div class="card">

                    
                        <div class="card-header card-zg">
                            <h3 class="card-title">Menu Details</h3>

                            
                        </div>

                        <?php
                            
                            $menu = new Menuscript();
                            $datas = $menu->fetch_one_record($id);
                            foreach($datas as $data){
                        ?>

                        <div class="card-body">
                        <form action="" id="validationForm" name="Add_awards" method="post" enctype="multipart/form-data">

                        <div class="input-group row">
                            <label class="form-control col-sm-3">First name </label>
                                <label class="form-control col-sm-3"><?php echo $data['first_name']; ?> </label> 
                                <label class="form-control col-sm-3">Last Name </label>
                                 <label class="form-control col-sm-3"><?php echo $data['last_name']; ?> </label>
                               

                            </div>
                            <br>
                           

                            <div class="input-group row">



                                
                            <label class="form-control col-sm-3">Email </label>
                                <label class="form-control col-sm-3"><?php echo $data['email']; ?> </label> 
                                <label class="form-control col-sm-3">Phone </label>
                                 <label class="form-control col-sm-3"><?php echo $data['phone']; ?> </label>
                               


                               
                                
                              
                            </div><br>

                            <div class="input-group row">

                                      
                            <label class="form-control col-sm-3">Address </label>
                                <label class="form-control col-sm-3"><?php echo $data['address']; ?> </label> 
                                <label class="form-control col-sm-3">Book Title </label>
                                 <label class="form-control col-sm-3"><?php echo $data['book_title']; ?> </label>
                               

                                
                           
                            </div><br>

                            <div class="input-group row">


                                            
                            <label class="form-control col-sm-3">File URL </label>
                                <label class="form-control col-sm-3"><?php echo $data['file_url']; ?> </label> 
                                <label class="form-control col-sm-3">Gender </label>
                                 <label class="form-control col-sm-3"><?php echo $data['genre']; ?> </label>
                               

                           

                               
                                
                                
                            </div><br>

                            <div class="input-group row">
                                

                               
                               
                                
                            </div><br>

                           
                           
                            <div class="row">
                           
                            </div>

                           
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

<script>
        $(document).ready(function() {
            $('#validationForm').on('submit', function(event) {
                var isValid = true;
                var email = $('#email').val();
                var phone = $('#phone').val();

                // Email validation
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    $('#emailError').text('Invalid email address.');
                    isValid = false;
                } else {
                    $('#emailError').text('');
                }

                // Phone validation
                var phonePattern = /^[0-9]{10}$/; // Example pattern for a 10-digit phone number
                if (!phonePattern.test(phone)) {
                    $('#phoneError').text('Invalid phone number.');
                    isValid = false;
                } else {
                    $('#phoneError').text('');
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>




<?php
  
  ?>   
   

<?php include('footer.php'); ?>