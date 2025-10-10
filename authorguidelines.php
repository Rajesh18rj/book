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
                    <h1><span>Author Guidelines</span></h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Author Guidelines</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="steps">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-md-4">
                <div class="mainTitle">
                    <h2>Publish In <span>Just 4 Steps</span></h2>
                    <p>Publishing process with Educreation simplifies your publishing requirements. You just need a manuscript for submission. After receiving it, we will guide you throughout the publishing process to transform your manuscript to a masterpiece book. Following is the flowchart of Book Publishing your book.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="icon-box text-center p-5 border bg-white">
                    <div class="card-icon mb-4">
                        <img src="images/icon-1.svg" alt="icon" width="60" class="img-fluid">
                    </div>
                    <h2 class="h5">Registration to Start / Create a publishing plan</h2>
                    <p class="mb-0">Firstly, you have to visit our submit manuscript page , and upload your manuscript Submit Manuscript. We will review it and will forward you a publishing proposal. Thereafter, you have to accept the same to start publishing.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="icon-box text-center p-5 border bg-white">
                    <div class="card-icon mb-4">
                        <img src="images/icon-2.svg" alt="icon" width="60" class="img-fluid">
                    </div>
                    <h2 class="h5">Publishing Process</h2>
                    <p class="mb-0">Once you accepts the proposal, we will ask you to submit the manuscript and other inputs through Publishing Book Uploading Form. After receiving inputs, the publishing process gets started. You will be updated about interior and cover designing.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="icon-box text-center p-5 border bg-white">
                    <div class="card-icon mb-4">
                        <img src="images/icon-3.svg" alt="icon" width="60" class="img-fluid">
                    </div>
                    <h2 class="h5">Launch & Distribution</h2>
                    <p class="mb-0">After confirming from you, the book will be forwarded for printing and distribution to worldwide platforms as print and eBook. Pre-order support will also be provided for your book once it will be on distribution stage. Author copies will also be shipped to you.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="icon-box text-center p-5 border bg-white">
                    <div class="card-icon mb-4">
                        <img src="images/icon-4.svg" alt="icon" width="60" class="img-fluid">
                    </div>
                    <h2 class="h5">Publish, Market and Sell / Support and Royalty</h2>
                    <p class="mb-0">Once your book is completely published and live, You will get an update of Royalty on Monthly Cycle. For any support or information, you will have an option to reach author support by our email id or phone call.</p>
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