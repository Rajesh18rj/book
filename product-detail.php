<?php include 'header.php'; 
ini_set('display_errors' ,0);
session_start();
$getid = base64_decode($_GET['PID']);
 $productsql = "select * from products where id=".$getid;
$result = mysqli_query($db,$productsql);
  $productlist = mysqli_fetch_array($result,MYSQLI_ASSOC);
//$imgdata = json_decode($productlist['imagelist'],1);

$subcat_sql = "select id,category_name from category where id=".$productlist['category'];
$subcatlist =mysqli_query($db,$subcat_sql);
$brandsql = "select id,brand_name from brand where id=".$productlist['brand'];
$brandlist = mysqli_query($db,$brandsql);
$locsql = "select id,size_name from sizelist where id=".$productlist['filter_size'];
$loclist = mysqli_query($db,$locsql);
$materialsql = "select id,material_type from material where id=".$productlist['material'];
$matlist = mysqli_query($db,$materialsql);
 foreach ($subcatlist as $value) {
  $catarray[$value['id']] = $value;
  }
  foreach ($brandlist as $value1) {
  $brandarray[$value1['id']] = $value1;
  }
  foreach ($matlist as $value2) {
  $matarray[$value2['id']] = $value2;
  }
  foreach ($loclist as  $value3) {
  $sizarray[$value3['id']] = $value3;
  }
  /*print_r($sizarray[$productlist['filter_size']]['size_name']);*/
?>
<section class="breadcrumbSection" style="background-image: url('images/breadcrumb-img-1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbTitle" style="text-align: center;">
                    <h1  style="display: block;"><span>Books</span></h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li>Books</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="productSection">
    <div class="container">
        <div class="row">
            <div class="col-md-5 py-md-4">
                <div class="sticky-top">
                    <div class="productView mb-md-0 mb-3">
                        <div class="row">
                            <div class="col-3">
                                <div class="slider-nav">
                                    <?php foreach ($imgdata as $imgvalue) { ?>
                                    <div class="item">
                                        <img class="img-fluid mx-auto d-block" src="uploads/<?php echo $imgvalue; ?>">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="slider-for">
                                     <?php //foreach ($imgdata as $imgvalue) { ?>
                                    <div class="item">
                                       <img class="picZoomer img-fluid mx-auto d-block" width="150px" hight="150px"  src="aip-admin/uploads/product_images/<?php echo $productlist['imagelist']; ?>">
                                    </div>
                                    <?php //} ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 py-md-4 pt-3">
                <div class="sticky-top">
                    <div class="productDet">
                        <ul class="customBreadcrumb mb-2">
                            <li><a href="">Home</a></li>
                            <li><a href="">Products</a></li>
                            <li><?php $code = $productlist['id'];
                             echo $Fullname = $productlist['name'];?></li>
                        </ul>
                        <h1 class="mb-3"><?php echo $productlist['name'];?></h1>
                        <div class="productDes">
                            
                            <div class="row">
                                 <div class="col-sm-4 col-6 buyBtn">
                                    <div class="qty">
                                        <div class="form-group">
                                            <label><b>Unit Price</b></label>
                                            <input class="form-control"  readonly type="text" value=" ₹<?php echo $productlist['sqft_price'];?>">
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $book_name = $productlist['name'];
                                    $isbn_no = $productlist['group_name'];
                                ?>
                                <div class="col-12 pb-3">
                                    <h4>Ask Price for Bulk Order:</h4>
                                    <a target='_blank' href="https://api.whatsapp.com/send?phone=<?php echo WHATSAPP;?>&text=<?php echo MSG1.$book_name.' (ISBN:'.$isbn_no.')'.MSG2;?>" target="_blank" class="customBtn"><i class="fa fa-whatsapp"></i></a>
                                    <a target='_blank' href="tel:+<?php echo WHATSAPP;?>" target="_blank" class="customBtn"><i class="fa fa-phone"></i></a>
                                </div>

                                <div class="col-12 pb-3">
                                     <h4>Share this Product:</h4>
                                    <div class="shareLink">
                                        <a href="https://www.facebook.com/sharer.php?u=https://www.google.com/" onclick="window.open('https://www.facebook.com/sharer.php?u=https://www.google.com/','popup','width=600,height=600'); return false;"> 
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url=https://www.google.com/" onclick="window.open('https://twitter.com/intent/tweet?url=https://www.google.com/','popup','width=600,height=600'); return false;"> 
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a class="d-none d-md-inline-block" target="_blank" href="https://web.whatsapp.com/send?text=https://www.google.com/">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                        <a class="d-md-none" target="_blank" href="whatsapp://send?text=https://www.google.com/">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <h4>Specification:</h4>
                                    <div class="row specList">
                                       
                                        <div class="col-sm-6 mb-1">Book  Title</div>
                                        <div class="col-sm-6 mb-1"><?php if($productlist['name']!='') { echo $productlist['name']; }?></div>
                                        
                                        <div class="col-sm-6 mb-1">Author Name</div>
                                        <div class="col-sm-6 mb-1"><?php if($productlist['material']!='') { echo $productlist['material']; }?></div>
                                        
                                         <div class="col-sm-6 mb-1">ISBN </div>
                                        <div class="col-sm-6 mb-1"><?php if($productlist['group_name']!='') { echo $productlist['group_name']; }?></div>
                                        
                                    </div>                                
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