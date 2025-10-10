<?php include 'header.php'; 

if(isset($_POST['submit'])){    

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    
    $to = 'editoraippublications@gmail.com'; 
    $from = 'info@alphainternationalpublication.com'; 
    $fromName = 'AIP'; 
           
    $subject = 'Contact Form Details'; 

    $htmlContent = ' 
              <html> 
              <head> 
                  <title>Welcome to AIP</title> 
              </head> 
              <body> 
                  <table style="border: 1px solid #a6a6a6; width: 500px; border-collapse: collapse;" > 
                      <tr> 
                          <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                            <img src="https://alphainternationalpublication.com/images/aip-logo.png">
                          </th>
                      </tr>
                      <tr> 
                          <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                            Hi! Here the Contact details for you.
                          </th>
                      </tr>
                      <tr> 
                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Name</th>
                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$name.'</td> 
                      </tr>
                      <tr> 
                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email.'</td> 
                      </tr> 
                      <tr> 
                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Phone</th>
                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$phone.'</td> 
                      </tr>
                  </table> 
              </body> 
              </html>'; 

    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
   
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    //$headers .= 'Cc:'.$participants . "\r\n";  
   
    // Send email 
    if(mail($to, $subject, $htmlContent, $headers)){ 
        echo '<script>alert("Email has sent successfully!");
        window.location = "contactus.php";</script>';  
    }else{ 
        echo '<script>alert("Email not sent. Try again.")</script>';           
    }

}
?>
<section class="breadcrumbSection" style="background-image: url('images/breadcrumb-img-1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbTitle" style="text-align: center;">
                    <h1 style="display: block;"><span>Contact Us</span></h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="submitSection">
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-8 mb-md-0 mb-4">
                <div class="row">
                    <div class="col-12">
                        <h4>Publish with us</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name*</label>
                            <input type="text" class="form-control" required name="name" placeholder="Name">
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
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" name="submit" class="simpleBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="addressWidget">
                   
                    <div class="rightLogo">
                        <img src="images/side-logo.jpg">
                    </div>
                    <div class="addBox">
                        <h5>Address</h5>
                        <p>Alpha International Publication (AIP), <br>3/725/2, Kammangudi, Adichapuram, Thiruvarur District, Tamilnadu- 614717, India</p>
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