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

 $sql = "INSERT INTO `manuscript`(`first_name`, `last_name`, `email`, `phone`, `address`, `book_title`, `genre`, `file_url`, `is_active`, `created_date`, `status`) VALUES ('$first_name','$last_name','$email','phone','$address','$book_title','$genre','$file_urls','0','$created_date', '$current_status')";
    
    $result = mysqli_query($db,$sql);

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
                    <h1 style="display: block;">Our Packages</h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Packages</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="packages">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-md-4">
                    <div class="mainTitle">
                        <h2>Our <span>Packages</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
             
                <div class="snip1214">
  <div class="plan"><div class="planb ">
    <h3 class="plan-title plbg1">
      PLAN-1
    </h3>
    <ul class="plan-features">
      <li><span class="plan-ld">No of copies</span> <span  class="plan-rd">-</span></li>
      <li><span class="plan-ld">Royalty </span> <span  class="plan-rd">0%</span></li>
      <li><span class="plan-ld">Promotions </span> <span  class="plan-rd">- <br> &nbsp;</span></li>
      <li><span class="plan-ld">Shipping fee </span> <span  class="plan-rd">-</span></li>
      <li><span class="plan-ld">Publication certificate</span> <span  class="plan-rd"> 	Yes</span></li>
      <li><span class="plan-ld">Cover page	</span> <span  class="plan-rd">-</span></li>
      <li><span class="plan-ld">Interior 	</span> <span  class="plan-rd">-</span></li>
      <li><span class="plan-ld">Laminations	</span> <span  class="plan-rd">-</span></li>
      <li><span class="plan-ld">Binding	</span> <span  class="plan-rd">- </span></li>
      <li><span class="plan-ld">Paper quality</span> <span  class="plan-rd">- </span></li>
      <li><span class="plan-ld">No of pages allowed	</span> <span  class="plan-rd">-</span></li>
    </ul>
    <div class="plan-select "><a href="#" class="plbg1"><span class="plan-price">Rs 3000</span><span class="plan-type">/-</span></a></div>
      </div></div>
  <div class="plan"><div class="planb">
    <h3 class="plan-title plbg2">
      PLAN-2
    </h3>
    <ul class="plan-features">
      <li><span class="plan-ld">No of copies</span> <span  class="plan-rd">5</span></li>
      <li><span class="plan-ld">Royalty </span> <span  class="plan-rd">30%</span></li>
      <li><span class="plan-ld">Promotions </span> <span  class="plan-rd">AIP, Flipkart <br> &nbsp;</span></li>
      <li><span class="plan-ld">Shipping fee </span> <span  class="plan-rd">Rs.300/-</span></li>
      <li><span class="plan-ld">Publication certificate</span> <span  class="plan-rd"> 	Yes</span></li>
      <li><span class="plan-ld">Cover page	</span> <span  class="plan-rd">Color</span></li>
      <li><span class="plan-ld">Interior 	</span> <span  class="plan-rd">B/W</span></li>
      <li><span class="plan-ld">Laminations	</span> <span  class="plan-rd">Glossy</span></li>
      <li><span class="plan-ld">Binding	</span> <span  class="plan-rd">Perfect </span></li>
      <li><span class="plan-ld">Paper quality</span> <span  class="plan-rd">Royal executive Bond Paper</span></li>
      <li><span class="plan-ld">No of pages allowed	</span> <span  class="plan-rd">0-250</span></li>
    </ul>
    <div class="plan-select "><a href="#" class="plbg2"><span class="plan-price">Rs 5000</span><span class="plan-type">/-</span></a></div>
      </div></div>
      
  <div class="plan"><div class="planb">
    <h3 class="plan-title plbg3">
      PLAN-3
    </h3>
    <ul class="plan-features">
      <li><span class="plan-ld">No of copies</span> <span  class="plan-rd">10</span></li>
      <li><span class="plan-ld">Royalty </span> <span  class="plan-rd">100%</span></li>
      <li><span class="plan-ld">Promotions </span> <span  class="plan-rd">AIP, Flipkart, Amazon </span></li>
      <li><span class="plan-ld">Shipping fee </span> <span  class="plan-rd">Free</span></li>
      <li><span class="plan-ld">Publication certificate</span> <span  class="plan-rd"> 	Yes</span></li>
      <li><span class="plan-ld">Cover page	</span> <span  class="plan-rd">Color</span></li>
      <li><span class="plan-ld">Interior 	</span> <span  class="plan-rd">B/W</span></li>
      <li><span class="plan-ld">Laminations	</span> <span  class="plan-rd">Glossy</span></li>
      <li><span class="plan-ld">Binding	</span> <span  class="plan-rd">Perfect </span></li>
      <li><span class="plan-ld">Paper quality</span> <span  class="plan-rd">Royal executive Bond Paper</span></li>
      <li><span class="plan-ld">No of pages allowed	</span> <span  class="plan-rd">0-300</span></li>
    </ul>
    <div class="plan-select "><a href="#" class="plbg3"><span class="plan-price">Rs 10,000</span><span class="plan-type">/-</span></a></div>
      </div></div>
  <div class="plan"><div class="planb">
    <h3 class="plan-title plbg4">
      PLAN-4
    </h3>
    <ul class="plan-features">
      <li><span class="plan-ld">No of copies</span> <span  class="plan-rd">15</span></li>
      <li><span class="plan-ld">Royalty </span> <span  class="plan-rd">100%</span></li>
      <li><span class="plan-ld">Promotions </span> <span  class="plan-rd">AIP, Flipkart, Amazon </span></li>
      <li><span class="plan-ld">Shipping fee </span> <span  class="plan-rd">Free</span></li>
      <li><span class="plan-ld">Publication certificate</span> <span  class="plan-rd"> 	Yes</span></li>
      <li><span class="plan-ld">Cover page	</span> <span  class="plan-rd">Color</span></li>
      <li><span class="plan-ld">Interior 	</span> <span  class="plan-rd">Color</span></li>
      <li><span class="plan-ld">Laminations	</span> <span  class="plan-rd">Glossy</span></li>
      <li><span class="plan-ld">Binding	</span> <span  class="plan-rd">Perfect </span></li>
      <li><span class="plan-ld">Paper quality</span> <span  class="plan-rd">Royal executive Bond Paper</span></li>
      <li><span class="plan-ld">No of pages allowed	</span> <span  class="plan-rd">0-400</span></li>
    </ul>
    <div class="plan-select "><a href="#" class="plbg4"><span class="plan-price">Rs 20,000</span><span class="plan-type">/-</span></a></div>
                    </div></div>
</div>
                
                
            </div>
        </div>
    </section>


<section class="products bg-white">
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