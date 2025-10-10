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
                <div class="breadcrumbTitle">
                    <h1><span>Our Packages</span></h1>
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
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="package bgcolor-white">
                        <div class="packageHeader dark-bg">
                            <h3>Starter Plan</h3>
                            <div class="sub-heading"><span class="strong"><i class="fa fa-inr"></i> 8,000</span> - Indian Author</div>
                            <div class="sub-heading"><span class="strong">$ 250</span> - International Author</div>
                        </div>
                        <div class="package-features">
                            <ul>
                                <li>
                                    <div class="column-9p">Sell your book in stores across countries</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Interior Specification(Black & White)</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Coverpage Specification(Color)</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Basic marketing services , Sales collaterals and launch promotions</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Get 100% profits from book sales</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                            </ul>
                            <div class="bottom-row">
                                <div class="column-5p">
                                    <h6><i class="fa fa-inr"></i> 8,000 for Indian Author</h6>
                                </div>
                                <div class="column-5p">
                                    <div class="cta-1">
                                        <a class="secondary-button" href="#">Start Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="package bgcolor-white boxActive">
                        <div class="packageHeader color-bg">
                            <h3>Basic Plan</h3>
                            <div class="sub-heading"><span class="strong"><i class="fa fa-inr"></i> 10,000</span> - Indian Author</div>
                            <div class="sub-heading"><span class="strong">$ 300</span> - International Author</div>
                        </div>
                        <div class="package-features">
                            <ul>
                                <li>
                                    <div class="column-9p">Sell your book in stores across countries</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Interior Specification(Black & White)</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Coverpage Specification(Color)</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Listing on Ecommerce Website,Flipkart, Amazon and Our Store</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Get 100% profits from book sales</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                            </ul>
                            <div class="bottom-row">
                                <div class="column-5p">
                                    <h6><i class="fa fa-inr"></i> 10,000 for Indian Author</h6>
                                </div>
                                <div class="column-5p">
                                    <div class="cta-1">
                                        <a class="btn primary-button" href="#">Start Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="package bgcolor-white">
                        <div class="packageHeader dark-bg">
                            <h3>Advance Plan</h3>
                            <div class="sub-heading"><span class="strong"><i class="fa fa-inr"></i> 20,000</span> - Indian Author</div>
                            <div class="sub-heading"><span class="strong">$ 500</span> - International Author</div>
                        </div>
                        <div class="package-features">
                            <ul>
                                <li>
                                    <div class="column-9p">Sell your book in stores across countries</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Interior Specification(Full Color)</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Coverpage Specification(Full Color)</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Listing on Ecommerce Website,Flipkart, Amazon and Our Store</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                                <li>
                                    <div class="column-9p">Get 100% profits from book sales</div>
                                    <div class="column-1p"><span class="icon_check"></span></div>
                                </li>
                            </ul>
                            <div class="bottom-row">
                                <div class="column-5p">
                                    <h6><i class="fa fa-inr"></i> 20,000 for Indian Author</h6>
                                </div>
                                <div class="column-5p">
                                    <div class="cta-1">
                                        <a class="secondary-button" href="#">Start Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section class="products bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-md-4">
                <div class="mainTitle">
                    <h2>Trending <span>Products</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="productSlider owl-carousel owl-theme">
                    <div class="card product-card">
                        <div class="productImg">
                            <img class="card-img-top card-img-back" src="images/product-img-1.png">
                            <div class="productShare">
                                <span class="shareBtn"><i class="fa fa-share-alt"></i>
                                    <div class="shareLink">
                                        <a href="https://www.facebook.com/sharer.php?u=" 
                                        onclick="window.open('https://www.facebook.com/sharer.php?u=','popup','width=600,height=600'); return false;"> 
                                            <i class="fa fa-facebook" style="color:#3b5998;"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url=" 
                                        onclick="window.open('https://twitter.com/intent/tweet?url=; return false;"> 
                                            <i class="fa fa-twitter" style="color:#00acee;"></i>
                                        </a>
                                        <a class="d-none d-md-inline-block" target="_blank" 
                                        href="https://web.whatsapp.com/send?text=">
                                            <i class="fa fa-whatsapp" style="color:#4fce5d;"></i>
                                        </a>
                                        <a class="d-md-none" target="_blank" 
                                        href="whatsapp://send?text=">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </span>
                                <span class="proOffer">30%</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div class="card-body">
                                <div class="product-title">
                                    <a href="#">Reduction In Environmental Problems Using Agricultural Solid Waste In Reactive Powder Concrete</a>
                                </div>
                                <div class="mt-1">
                                    <span class="product-price"><i class="fa fa-inr"></i> 199.00</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <div class="product-link d-flex align-items-center justify-content-center">
                                    <a class="customBtn" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card product-card">
                        <img class="card-img-top card-img-back" src="images/product-img-2.jpg">
                        <div class="card-info">
                            <div class="card-body">
                                <div class="product-title">
                                    <a href="#">Assay Of Valuable Components In By-products Of Mango Industry</a>
                                </div>
                                <div class="mt-1">
                                    <span class="product-price"><i class="fa fa-inr"></i> 299.00</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <div class="product-link d-flex align-items-center justify-content-center">
                                    <a class="customBtn" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card product-card">
                        <img class="card-img-top card-img-back" src="images/product-img-3.jpg">
                        <div class="card-info">
                            <div class="card-body">
                                <div class="product-title">
                                    <a href="#">Impact Of Human Resource Management Practices On Operational Excellence : A Study On Pharmaceutical Industry, Hyderabad, Telangana, India</a>
                                </div>
                                <div class="mt-1">
                                    <span class="product-price"><i class="fa fa-inr"></i> 499.00</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <div class="product-link d-flex align-items-center justify-content-center">
                                    <a class="customBtn" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card product-card">
                        <img class="card-img-top card-img-back" src="images/product-img-4.jpg">
                        <div class="card-info">
                            <div class="card-body">
                                <div class="product-title">
                                    <a href="#">Sports Psychology And Sociology</a>
                                </div>
                                <div class="mt-1">
                                    <span class="product-price"><i class="fa fa-inr"></i> 299.00</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <div class="product-link d-flex align-items-center justify-content-center">
                                    <a class="customBtn" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card product-card">
                        <img class="card-img-top card-img-back" src="images/product-img-5.jpg">
                        <div class="card-info">
                            <div class="card-body">
                                <div class="product-title">
                                    <a href="#">Sugarcane Production Manual</a>
                                </div>
                                <div class="mt-1">
                                    <span class="product-price"><i class="fa fa-inr"></i> 399.00</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <div class="product-link d-flex align-items-center justify-content-center">
                                    <a class="customBtn" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card product-card">
                        <img class="card-img-top card-img-back" src="images/product-img-3.jpg">
                        <div class="card-info">
                            <div class="card-body">
                                <div class="product-title">
                                    <a href="#">Sports Psychology And Sociology</a>
                                </div>
                                <div class="mt-1">
                                    <span class="product-price"><i class="fa fa-inr"></i> 299.00</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <div class="product-link d-flex align-items-center justify-content-center">
                                    <a class="customBtn" href="#">Buy Now</a>
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