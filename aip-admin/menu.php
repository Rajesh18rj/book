<?php
  $title = "Menu Script Details";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php include('header.php'); ?>
<?php 

if (file_exists('class/menu_class.php')) {
    include_once 'class/menu_class.php';
    //echo "hello";
} else {
    echo 'File not found.'; 
}

if(isset($_GET["delete"]) && $_GET["delete"] == "delete"){
  $id_delete = $_GET["id"];

  $result = new Menuscript();
  $datas = $result->delete($id_delete);

  if ($datas['status']) {
    // Registration Success
    $_SESSION['success'] = $datas['message'];
} else {
    // Registration Failed
    //echo 'Wrong username or password';
    $_SESSION['error'] = $datas['message'];
}

}



//include_once 'class/award_class.php'; ?>


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


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
        .edit_class:hover{
            color:#FFFFFF; 
        }
        .edit-zo:hover {
            background-color: #363061 !important; /* A darker shade for hover effect */
        }
        .edit{
          color: white;
        }
      </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu Script</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php" class="color_class">Home</a></li>
              <li class="breadcrumb-item active"><a href="menu.php.php" class="color_class">Menu</a></li>
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
                <a href="add_menu.php">
                  <button class="btn btn-zo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg>  <i class="bi bi-plus-circle"></i> Add Menu </button>
                </a>

                <br><br>            

                    <div class="card">
                        <div class="card-header card-zg">
                            <h3 class="card-title">Menu Details</h3>

                             
                        </div>
                        
                        <div class="card-body">
                            

                            <table id="example" class="table table-striped table-bordered">                  
                           
                                <thead>
                                    <tr>
                                    <th>S .No </th>
                                        <th>Name </th>
                                        <th>Email </th>
                                        <th>Phone </th>
                                        <th>Address </th>
                                        <th>Book Title </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $result = new Menuscript();
                                    $datas = $result->fetch_menu();
                                    $i = 1;
                                    foreach ($datas as $data) {  
                                       
                                ?>

                                            <tr>
                                                <td><?php echo $i++ ?> </td>
                                                <td><?php echo $data['first_name'] ." ," . $data['last_name']  ?> </td>
                                                <td><?php echo $data['email'] ?> </td>
                                                <td><?php echo $data['phone'] ?> </td>
                                                <td><?php echo $data['address'] ?> </td>
                                                <td><?php echo $data['book_title'] ?> </td>
                                               
                                                <td>

                                                <a href="edit_menu.php?id=<?php echo $data['id'] ?>"  class="edit_class">
                                                <button class="btn edit" style="background-color: #68cf29;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>   
                                                                
                                                </a>

                                               

                                                </td>
                                            </tr>



                                    <?php


                                            }
                                             
                                                                    
                                    ?>



                                  


                                </tbody>
                            
                            
                                
                            </table>
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

<script src="dist/js/sweetalert2.all.min.js"></script>
   
  <?php
  if(isset($_SESSION['success'])){
  ?>   
    <script type="text/javascript">
      Swal.fire({
        title: "Success!",
        text: "<?php  echo $_SESSION['success']; ?>!",
        icon: "success",
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

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        });
    });
    </script>
<?php include('footer.php'); ?>