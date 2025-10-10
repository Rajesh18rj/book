<?php
  $title = "Menu Script Adding";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php include('header.php'); ?>
<?php 


    include_once 'class/menu_class.php';
    $menu = new Menuscript();

if (isset($_POST['submit'])) { 
    extract($_POST); 
     
    if(isset($Fname, $Lname, $email, $phone, $address, $book_title, $gender, $file_url)){
        $datas = $menu->add_menu($Fname, $Lname, $email, $phone,$address, $book_title,$gender, $file_url);
        if ($datas['status']) {
            // Registration Success
            $_SESSION['success'] = $datas['message'];
        } else {
            // Registration Failed
            //echo 'Wrong username or password';
            $_SESSION['error'] = $datas['message'];
        }
    }else{
        echo "error";
    }
     
  }


//include_once 'class/award_class.php'; ?>

<style>
        .error {
            color: red;
        }
    </style>

    
<style>
       .btn-zo {
          background-color: #8686e9 !important;
        
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-zo:hover {
            background-color: #363061 !important; /* A darker shade for hover effect */
        }
        .card-zg {
          background-color: #ffffff !important;
          color: #282828 !important;
        }
        a{
          color:#ffffff;
        }
        .cancel_class:hover{
            color:#FFFFFF;
        }
        .card-zg {
           background-color: #ffffff !important;
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
              <li class="breadcrumb-item"><a href="index.php" class="color_class">Home</a></li>
              <li class="breadcrumb-item active"><a href="menu.php" class="color_class">Menu Script</a></li>
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
                  <button class="btn btn-zo">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg> Menu List</button>
                </a>

                <br><br>         

                    <div class="card">

                    
                        <div class="card-header card-zg">
                            <h3 class="card-title">Menu Details</h3>

                            
                        </div>
                        
                        <div class="card-body">
                        <form action="" id="validationForm" name="Add_awards" method="post" enctype="multipart/form-data">

                        <div class="row">
                        <div class="col-sm-6">
                        <!-- text input -->
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Enter the  First Name" name="Fname" required>
                            </div>
                        </div>  
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter the Last Name" name="Lname" required>
                            </div>
                        </div>
                    </div>                  

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="email" class="form-control" placeholder="Enter the Email" name="email" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" id="phone"  class="form-control" placeholder="Enter the Phone" name="phone" required>
                            </div>   
                        </div>

                    
                     
                                        
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" rows="4" placeholder="Enter the Address" name="address" required>
                            </div> 
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Book Title</label>
                                <input type="text" class="form-control"  placeholder="Enter the Book Title" name="book_title" required>
                            </div>
                        </div>
                    </div>    


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>File URL</label>
                                <input type="text" class="form-control" rows="4" placeholder="Enter the File URL" name="file_url" required>
                            </div> 
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>

                            </select>
                        </div>
                    </div>    

                   
                           
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">  
                          <button type="submit" class="btn btn-success" name="submit" id="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/>
</svg> Save</button>


                          <a href="menu.php" class="btn btn-secondary a-btn-slide-text cancel_class"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>
                                                    Cancel
                                                            
                          </a>
                        </div>
                      </div>                    
                    </div>
                           
                          

                           
                           
                           

                           
                        </form>

                           
                        </div>                  
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
  
  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="dist/js/sweetalert2.all.min.js"></script>
   
  <?php
  if(isset($_SESSION['success'])){
  ?>   
    <script type="text/javascript">
      Swal.fire({
        title: "Success!",
        text: "<?php  echo $_SESSION['success']; ?>!",
        icon: "success",
        willClose: () => {
            // Redirect to a different page when the alert is about to close
            window.location.href = 'menu.php';
        }
      });
    </script>
  <?php   
    unset($_SESSION['success']);
  }
  if(isset($_SESSION['error'])){
  ?>               
    <script type="text/javascript">
      Swal.fire({
        title: "Oops!",
        text: "<?php  echo $_SESSION['error']; ?>!",
        icon: "error",
      });
    </script>                  
  <?php                   
    unset($_SESSION['error']);
  }
  ?>
   

<?php include('footer.php'); ?>