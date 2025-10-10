<?php
  $title = "Menu Script Update";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php include('header.php'); ?>
<?php 


    include_once 'class/menu_class.php';

    $id = $_GET["id"];
    $menu = new Menuscript();

if (isset($_POST['submit'])) { 
    extract($_POST); 
     
    if(isset($Fname, $Lname, $email, $phone, $address, $book_title, $gender, $file_url,$active)){
        $datas = $menu->update_menu($Fname, $Lname, $email, $phone,$address, $book_title,$gender, $file_url,$active,$id);
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
                  <button class="btn btn-zo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>   Menu List</button>
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


                            <div class="row">
                                <div class="col-sm-6">
                                <!-- text input -->
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="<?php echo $data["first_name"] ?>"  placeholder="Enter the  First Name" id="Fname" name="Fname" required>
                                    </div>
                                </div>  
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo $data["last_name"] ?>"  placeholder="Enter the Last Name" id="Lname" name="Lname" required>
                                    </div>
                                </div>
                            </div>                  

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" id="email" class="form-control" value="<?php echo $data["email"] ?>"  placeholder="Enter the Email" name="email" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" id="phone"  class="form-control" value="<?php echo $data["phone"] ?>"  placeholder="Enter the Phone" name="phone" required>
                                    </div>   
                                </div>

                            
                            
                                                
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="4" placeholder="Enter the Address" name="address"><?php echo $data["address"] ?></textarea>>
                                    </div> 
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Book Title</label>
                                        <input type="text" class="form-control" value="<?php echo $data["book_title"] ?>"   placeholder="Enter the Book Title" name="book_title" required>
                                    </div>
                                </div>
                            </div>    


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>File URL</label>
                                        <input type="text" class="form-control" value="<?php echo $data["file_url"] ?>"  rows="4" placeholder="Enter the File URL" name="file_url" required>
                                    </div> 
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender">
                                        <option value="Male"<?=$data['genre'] == 'Male' ? ' selected="selected"' : '';?>>Male</option>
                                        <option value="Female"<?=$data['genre'] == 'Female' ? ' selected="selected"' : '';?>>Female</option>

                                       </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Active</label> <br>
                                        <input type="checkbox" id="active_check"  value ="1"<?=$data['is_active'] == '1' ? ' checked="checked"' : '';?>>
                                        <input type="hidden" name="active" id="active" value="<?php $data['is_active']; ?>">
                                    </div> 

                                

                                
                                </div>
                            </div>   <br>

                                
                                
                                
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">  
                                    <button type="submit" class="btn btn-success" name="submit" id="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/>
</svg>  Update</button>
                                    <a href="menu.php" class="btn btn-secondary a-btn-slide-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>                 Cancel
                                                                        
                                    </a>

                                    <a href="menu.php?id=<?php echo $data['id'] ?>&&delete=delete" id="delete" class="btn btn-danger a-btn-slide-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>                    Delete
                                                                        
                                                            </a>
                                    </div>
                                </div>                    
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function() {
    var value = $('#active_check').val();
    $('#active').val(value);
   });





                              $('#active_check').change(function() {
                                  if ($(this).is(':checked')) {
                                      $('#active').val('1');
                                  } else {
                                      $('#active').val('0');
                                  }
                              });
                            
                          </script>

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

<script>
        document.getElementById('delete').addEventListener('click', function() {
            alert("hello");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Done!',
                        'Your action has been confirmed.',
                        'success'
                    )
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your action has been cancelled.',
                        'error'
                    )
                }
            })
        });
    </script>

    
<script>
        document.getElementById('delete').addEventListener('click', function() {
            var name= $('#Fname').val();
            var Lname = $('#Lname').val();
            var userConfirmed = confirm('Are you sure you want to Delete? '+ name + Lname);

            if (userConfirmed) {
                // User clicked "OK"
                //alert('You clicked OK.');
                // Redirect to a different page (e.g., confirmed.php)
                
            } else {
                // User clicked "Cancel"
                //alert('You clicked Cancel.');
                // Redirect to a different page (e.g., cancelled.php)
                //window.location.href = 'cancelled.php';
                event.preventDefault();
            }
           
        });
    </script>