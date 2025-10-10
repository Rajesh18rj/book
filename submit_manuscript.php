<?php include 'header.php'; 


if(isset($_POST['save_article'])){
$first_name= $_POST['first_name'];
$last_name= $_POST['last_name'];
$email= $_POST['email'];
$phone= $_POST['phone'];
$address= $_POST['address'];
$book_title= $_POST['book_title'];
$genre= $_POST['genre'];
$foldername = date('Y_m_d');
$current_status = 'Submitted';
$is_active = '0';
$created_date = date('Y-m-d');
$full_file ="";
if(!empty($_FILES['file_url']['name'])){
$file_urls = imageupload('file_url',$foldername,$full_file);
}

 $sql = "INSERT INTO `manuscript`(`first_name`, `last_name`, `email`, `phone`, `address`, `book_title`, `genre`, `file_url`, `is_active`, `created_date`, `status`) VALUES ('$first_name','$last_name','$email','$phone','$address','$book_title','$genre','$file_urls','0','$created_date', '$current_status')";
    
    $result = mysqli_query($db,$sql);
    echo "<script type='text/javascript'> alert('Request Submitted Successfully !');top.location='index.php';</script>";


}
function imageupload($filename,$foldername,$full_file){
    $name =  $full_file;
    if($_FILES[$filename]['name']!=""){
        $ext=explode(".",$_FILES[$filename]['name']);
        $name= $full_file.time()."_".uniqid().'.'.$ext[1];
        $path = 'manuscripts/'.$foldername.'/';
        if(!is_dir($path)) {        
            $dual_path = trim($path,'/');
            $dual_path = explode('/', $dual_path);
            $epath ="";
            foreach ($dual_path as $dpath) {
                $epath = $epath.$dpath."/";
                if(!is_dir($epath)){
                    mkdir($epath); 
                }
            }
            
        }
        move_uploaded_file($_FILES[$filename]['tmp_name'],$path.$name);
    }
    return $name;
}
?>
<section class="breadcrumbSection" style="background-image: url('images/breadcrumb-img-1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbTitle"  style="text-align: center;">
                    <h1 style="display: block;"><span>Submission</span></h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Submission</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="submitSection">
    <div class="container">
        <form method="post" action=""  enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-8 mb-md-0 mb-4">
                <div class="row">
                    <div class="col-12">
                        <h4>Publish with us</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name*</label>
                            <input type="text" class="form-control" required name="first_name" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name*</label>
                            <input type="text" class="form-control" required name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email Address*</label>
                            <input type="text" class="form-control" required name="email" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number*</label>
                            <input type="tel" class="form-control" required name="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address*</label>
                            <textarea class="form-control" name="address" required placeholder="Address"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Book Title*</label>
                            <input type="text" class="form-control" required name="book_title" placeholder="Book Title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>WhatsApp No*</label>
                          <input type="tel" name="genre" id="genre" class="form-control" required placeholder="WhatsApp No">
                                
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Manuscript *:(1 file only: Word Format)*</label>
                            <input type="file" name="file_url" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" name="save_article" class="simpleBtn">Submit Manuscript</button>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <p>or Submit your content through <a href="mailto:editoraippublications@gmail.com">editoraippublications@gmail.com</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="addressWidget">
                    <p style="text-align: justify;">Alpha International Publication (AIP) is one of the most prominent book publishers. AIP has produced a large number of publications in a variety of disciplines, including Computer Science, Mechanical, Electrical, Electronics, Arts, Science, Medicine, Pharmacy, and Managements, among others, and has a global consumer base. We give timely, high-quality services to our consumers. In a short period of time, AIP establishes a strong presence in the industry. We have a well-rounded group of people that are committed to achieving AIP's vision and goal. Our mission is to offer only high-quality book publishing services worldwide.</p>
                    <div class="rightLogo">
                        <img src="images/side-logo.jpg">
                    </div>
                    <div class="addBox">
                        <h5>Address</h5>
                        <p>3/725/2, Kammangudi, Adichapuram, Thiruvarur District, Tamilnadu- 614717 India</p>
                    </div>
                    <div class="addBox">
                        <h5>Email</h5>
                        <p>editoraippublications@gmail.com </p>
                    </div>
                    <div class="addBox">
                        <h5>Phone</h5>
                        <p>+91 8667569358, +91 7019991025, +91 6369794362</p>
                    </div>
                    <ul class="socialLinks blackBefore">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>


<section class="products" style="background-image: none;">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-md-4">
					<div class="mainTitle">
						<h2>NEW  <span>RELEASES</span></h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="productSlider owl-carousel owl-theme">
					    <div class="card product-card">
					    	<div class="productImg">
					        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-1.jpg">
					        	
					        </div>
					        <div class="card-info">
					           
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-2.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-3.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-4.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-6.jpg">
					        <div class="card-info">
					           
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-8.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-9.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-10.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-11.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-12.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-13.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-14.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-15.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
                        <div class="card product-card">
				        	<img class="card-img-top card-img-back" src="images/newbook/New-Release-16.jpg">
					        <div class="card-info">
					            
					            <div class="card-footer bg-transparent border-0">
					                <div class="product-link d-flex align-items-center justify-content-center">
					                	<a class="customBtn" href="products.php">Buy Now</a>
					                </div>
					            </div>
					        </div>
					    </div>
                        
        
                      
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include 'footer.php'; ?>