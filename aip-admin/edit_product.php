<?php
  $title = "Product Update";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/product_class.php');


$product = new Product();
$id = $_GET["id"];


if (isset($_POST['submit'])) { 
    extract($_POST); 
    extract($_FILES);   
    if(isset($name,$sqft_price,$category,$author,$hidden_image,$isbn_no,$file,$active,$id)){
        $status = $product->update_product($name,$sqft_price,$category,$author,$hidden_image,$isbn_no,$file,$active,$id);
        if ($status['status']) {
            // Registration Success
            $_SESSION['success'] = $status['message'];
        } else {
            // Registration Failed
            //echo 'Wrong username or password';
            $_SESSION['error'] = $status['message'];
        }
    }else{
        echo "error";
    }
     
  }

  

  require_once('phpqrcode/qrlib.php');

// if(isset($_POST["submit"])){
//     extract($_POST);
//     extract($_FILES);
//     $data = $product->update_product($name,$sqft_price,$category,$author,$hidden_image,$isbn_no,$file,$active,$id);
//     if ($data['status']) {
//         // Registration Success
//         $_SESSION['success'] = $data['message'];
//     } else {
//         // Registration Failed
//         //echo 'Wrong username or password';
//         $_SESSION['error'] = $data['message'];
//     }
// }

?>
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
    #hidden_svg {
            display: none;
        }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php" class="color_class">Home</a></li>
              <li class="breadcrumb-item active"><a href="product.php" class="color_class">Product</a></li>
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
                <a href="product.php">
                  <button class="btn btn-zo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>   Product  List</button>
                </a><br><br>

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New Product</h3>
              </div>             

              <div class="card-body">  

                <?php
                    $fetch = new Product();
                    $results = $fetch->fetchoneproduct($id);
                    foreach($results as $result){
                     $value = $result["category"];
                    $author =  $result["material"];
                    $ISBN_No = $result["group_name"];
                    $imagelist = $result['imagelist'];
                    $is_active =  $result['is_active'];

                    $path = 'uploads/qrcodes/';
                    $file = $path.uniqid().".png";
                    $id = base64_encode($_GET["id"]);
                    $text = "https://alphainternationalpublication.com/product-detail.php?PID=".$id;
                    QRcode::png($text , $file, 'L', 5, 2);
                ?>

                <form method="post" name="product_form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                        <!-- text input -->
                            <div class="form-group">
                                <label>Book Title</label>
                                <input type="text" class="form-control" value="<?php echo $result["name"]; ?>" placeholder="Enter the  Name" id="name" name="name" required>
                            </div>
                        </div>  
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>MRP</label>
                                <input type="text" class="form-control" value="<?php echo $result["sqft_price"]; ?>" placeholder="Enter the MRP" name="sqft_price" required>
                            </div>
                        </div>
                    </div>                  

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    <option value="0"> Select </option>
                                <?php 
                                    $result = new Product();
                                    $datas = $result->fetch_category();
                                    
                                    foreach ($datas as $data) {  
                                        $cate_id = $data["id"];
                                        $category_name = $data["category_name"];
                                        if($value == $cate_id){
                                            echo "$value";
                                    ?>
                                        
                                <option value="<?php echo $cate_id?>" selected="selected"><?php echo $category_name ?></option>
                                     

                                <?php
                                    }else{
                                ?>

                                    
                                <option value="<?php echo $cate_id ?>"><?php echo $category_name ?> </option>
                                     

                                <?php
                                    }
                                ?>    


                                <?php
                                    }  
                                ?>

                                </select>                                
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" class="form-control" value="<?php echo $author ?>" placeholder="Enter the Author" name="author" required>
                            </div>   
                        </div>        
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ISBN No</label>
                                <input type="text" class="form-control" value="<?php echo $ISBN_No; ?>" rows="4" placeholder="Enter the ISBN No" name="isbn_no" required>
                            </div> 
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" class="form-control" name="file">

                                <img src = 'uploads/product_images/<?php echo $imagelist; ?>' width = "56px"
                                height= "50px">

                                <input type="hidden" name="hidden_image" value="<?php echo $imagelist; ?>">
                            </div> 
                        </div>                        
                    </div>  
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Active</label> <br>
                                <input type="checkbox" id="active_check"  value ="1"<?=$is_active == '1' ? ' checked="checked"' : '';?>>
                                <input type="hidden" name="active" id="active" value="<?php $is_active; ?>">
                            </div> 
                          
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>URL</label> <br>

                                     <div class="flex shadow-sm row"> 
                                      <input
                                        value="<?php echo $text; ?>"
                                        readonly=""
                                        class="form-control col-sm-10"
                                        type="text"
                                        style="width: 40vh;"
                                        id="copy_text"
                                      >
                                
                                      <button class="btn btn-success  col-sm-2" id="copy_button"  onclick="copyText()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                        </svg> <svg xmlns="http://www.w3.org/2000/svg" id="hidden_svg" style="display:none;" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
</svg>     Copy</button>
                                      </div> 
                                  



                                <!-- <p class="paragraph_tag">https://sipinternationalpublishers.com/product-detail.php?PID=<?php //echo base64_encode($id);  ?>  </p>
                                 -->
                                
                            </div> 
                          
                          </div>

                    </div>

                  
                  <br>



                  <div class="row">

                  <div class="col-sm-6">
                            <div class="form-group">
                                <label>QR Code OR Click To Download</label> <br>
                                <img src='<?php echo $file ?>' id="triggerImage" alt="Downloadable Image" style="cursor:pointer;">
                              </div> 

                              <a id="downloadLink" href="path_to_your_image.jpg" download="image.jpg" style="display:none;"></a>
    

                          
                        </div>

                  </div>
                  
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">  
                          <button type="submit" class="btn btn-success" name="submit" id="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z"/>
</svg> Update</button>

<a href="<?php echo $text; ?>"  target="_blank" class="btn btn-primary a-btn-slide-text">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
</svg>       View
                                                            
                          </a>
                          <a href="product.php"  class="btn btn-secondary a-btn-slide-text">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>       Cancel
                                                            
                          </a>

                          <a href="product.php?id=<?php echo $_GET["id"];?>&&delete=delete" id="delete" class="btn btn-danger a-btn-slide-text">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>               Delete
                                                            
                          </a>
                        </div>
                      </div>                    
                    </div>                  
                </form>
                <?php
                    }
                ?>              
            </div>
                <!-- Main content -->           

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
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
            window.location.href = 'product.php';
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


<script>
    document.getElementById('delete').addEventListener('click', function() {
      var name= $('#name').val();
        var userConfirmed = confirm('Are you sure you want to Delete? '+ name);

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

<script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("copy_text");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            document.execCommand("copy");

            // Alert the copied text (optional)
            //alert("Copied the text: " + copyText.value);


            
            event.preventDefault();
        }


        $('#copy_button').click(function() {
                var parent = $(this).parent();
                parent.find('svg').remove();
                $('#hidden_svg').css('display', 'block');
                parent.find('button').text("Copyed");


                // var newSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"'+'
                //               class="bi bi-check2-circle" viewBox="0 0 16 16">'+'
                //       <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>'+'
                //       <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>'+'
                //     </svg>';
                //     $('#copy_button').append(newSvg);
                    //parent.append(newSvg);
                    
            event.preventDefault();
                
            });
    </script>

<script>
        $(document).ready(function() {
            $('#triggerImage').click(function() {
                // Create an off-screen canvas
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                // Create a new image object
                var image = new Image();
                image.crossOrigin = 'Anonymous';
                image.src = $('#triggerImage').attr('src');

                image.onload = function() {
                    // Set canvas dimensions to the image dimensions
                    canvas.width = image.width;
                    canvas.height = image.height;
                    // Draw the image onto the canvas
                    ctx.drawImage(image, 0, 0);

                    // Create a link element
                    var name = $("#name").val();
                    var link = document.createElement('a');
                    link.href = canvas.toDataURL('image/jpeg');
                    link.download = name +' Product QR Code Image'+'downloaded_image.jpg';

                    // Append the link to the body
                    document.body.appendChild(link);
                    // Trigger the download
                    link.click();
                    // Remove the link from the document
                    document.body.removeChild(link);
                };
            });
        });
    </script>


