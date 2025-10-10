<?php include 'header.php'; 
ini_set('display_errors' ,0);
session_start();
$subcat_sql = "select id,category_name from category where is_active='0'";
$brandsql = "select id,brand_name from brand";
$locsql = "select id,size_name from sizelist";
$materialsql = "select id,material_type from material where is_active='0'";
$productsql = "select * from products where is_active='0'";

if($_GET['CID']!=''){
  $cat = base64_decode($_GET['CID']);
  $productsql .= " and category=".$cat;
}
if($_GET['BID']!=''){
  $cat = base64_decode($_GET['BID']);
  $productsql .= " and brand=".$cat;   
}
if($_GET['SID']!=''){
 $cat = base64_decode($_GET['SID']);
 $productsql .= " and filter_size=".$cat;
}
if($_GET['MID']!=''){
 $cat = base64_decode($_GET['MID']);
 $productsql .= " and material=".$cat;
}
$subcatlist =mysqli_query($db,$subcat_sql);
$brandlist = mysqli_query($db,$brandsql);
$sizelist = mysqli_query($db,$locsql);
$matlist = mysqli_query($db,$materialsql);
$productlist = mysqli_query($db,$productsql);

?>
<script type="text/javascript">

    function listproduct(category,filtervalue) {
     var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

     switch (category) {
        case 'c':
        message = 'CID';
        break;
        case 'b':
        message = 'BID';
        break;
        case 's':
        message = 'SID';
        break;
        case 'm':
        message = 'MID';
        break;
    }

    var encodedString = Base64.encode(filtervalue);
    window.location = "products.php?"+message+"="+encodedString;
}

</script>
<section class="breadcrumbSection" style="background-image: url('images/breadcrumb-img-1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbTitle">
                    <h1><span>Books</span></h1>
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
            <div class="col-lg-3 col-md-4">
                <div class="mFilter d-md-none">
                    <span><i class="fa fa-filter"></i> Filters</span>
                </div>
                <div class="filterWidget">
                    <h3>Filters</h3>
                    <div class="filterTab">
                        <form>
                            <div class="card mb-0">
                                <div class="card-header" data-toggle="collapse" href="#collapseMaterial">
                                    <a class="card-title"> Categories</a>
                                </div>
                                <div id="collapseMaterial" class="card-body collapse show">
                                    <?php foreach ($subcatlist as $catvalue) { ?>
                                        <div class="custom-control custom-radio">

                                            <input type="radio" id="c<?php echo $catvalue['id'];?>" class="custom-control-input" <?php echo $catvalue['id']==base64_decode($_GET['CID'])?'checked':'';?> name="category" onclick="listproduct('c','<?php echo $catvalue['id'];?>');">
                                            <label class="custom-control-label" for="c<?php echo $catvalue['id'];?>">
                                                <?php  echo $catvalue['category_name'];?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--
                                <div class="card-header" data-toggle="collapse" href="#collapseColor">
                                    <a class="card-title"> Brand Name</a>
                                </div>
                                <div id="collapseColor" class="card-body collapse show">
                                 <?php foreach ($brandlist as $brdvalue) { ?>
                                    <div class="custom-control custom-radio">

                                        <input type="radio" id="b<?php echo $brdvalue['id'];?>" class="custom-control-input" <?php echo $brdvalue['id']==base64_decode($_GET['BID'])?'checked':'';?> name="brand" onclick="listproduct('b','<?php echo $brdvalue['id'];?>');">
                                        <label class="custom-control-label" for="b<?php echo $brdvalue['id'];?>">
                                            <?php  echo $brdvalue['brand_name'];?>
                                        </label>
                                    </div>
                                <?php } ?>

                            </div> -->
                            <div class="card-header" data-toggle="collapse" href="#collapseApplication">
                                <a class="card-title"> Languages</a>
                            </div>
                            <div id="collapseApplication" class="card-body collapse show">
                               <?php foreach ($sizelist as $szvalue) { ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="s<?php echo $szvalue['id'];?>" class="custom-control-input" <?php echo $szvalue['id']==base64_decode($_GET['SID'])?'checked':'';?> name="size" onclick="listproduct('s','<?php echo $szvalue['id'];?>');">
                                    <label class="custom-control-label" for="s<?php echo $szvalue['id'];?>">
                                        <?php  echo $szvalue['size_name'];?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-header" data-toggle="collapse" href="#collapsePrice">
                            <a class="card-title">Authors</a>
                        </div>
                        <div id="collapsePrice" class="card-body collapse show">
                           <?php foreach ($matlist as $matvalue) { ?>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="m<?php echo $matvalue['id'];?>" class="custom-control-input" <?php echo $matvalue['id']==base64_decode($_GET['MID'])?'checked':'';?> name="mat" onclick="listproduct('m','<?php echo $matvalue['id'];?>');">
                                <label class="custom-control-label" for="m<?php echo $matvalue['id'];?>">
                                    <?php  echo $matvalue['material_type'];?>
                                </label>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </form>
        </div>
        <div class="m-applyBtn d-md-none">
            <span>Close</span>
            <span class="active">Apply</span>
        </div>
    </div>
</div>
<div class="col-lg-9 col-md-8">
    <div class="row">
        <?php 
        foreach ($productlist as $pvalue) {
        $imgdata = json_decode($pvalue['imagelist'],1);
         ?>
        <div class="col-md-4 col-6">
            <div class="card product-card">
                <a href="product-detail.php?PID=<?php echo base64_encode($pvalue['id']); ?>"><img class="card-img-top card-img-back" src="uploads/<?php echo $imgdata[0];?>">
                    <div class="card-info">
                        <div class="card-body">
                            <div class="product-title">
                                <a href="product-detail.php?PID=<?php echo base64_encode($pvalue['id']); ?>"><?php echo $pvalue['name']?></a>
                            </div>
                            <div class="mt-1">
                                <span class="product-price">Price : ₹<?php echo $pvalue['sqft_price'];?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                         <div class="col-12 pb-3">

                             <center><a href="https://api.whatsapp.com/send?phone=<?php echo WHATSAPP;?>" class="customBtn"><i class="fa fa-whatsapp"></i></a>
                                 <a href="tel:+<?php echo WHATSAPP;?>" class="customBtn"><i class="fa fa-phone"></i></a></center>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         <?php } ?>
         </div>

         </div>

     </section>
     <?php include 'footerlv.php'; ?>