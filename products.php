<?php include 'header.php'; 
ini_set('display_errors' ,0);
session_start();
$subcat_sql = "select id,category_name from category where is_active='1'";
$brandsql = "select id,brand_name from brand";
$locsql = "select id,size_name from sizelist";
$materialsql = "select id,material_type from material where is_active='0'";
$productsql = "select * from products where is_active='1'";

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

$productsql .= " ORDER BY id DESC";
//echo $productsql;
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

<style>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.pagination button {
    margin: 0 5px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: #f8f9fa;
    cursor: pointer;
}

.pagination button.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination button:disabled {
    background-color: #e9ecef;
    cursor: not-allowed;
}

.letter-space {
    letter-spacing: 0.1em;
}

</style>
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
                                <div id="collapseMaterial" class="card-body collapse show letter-space">
                                    <a href="https://alphainternationalpublication.com//products.php" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>    ALL </a> <br>
                                    <?php foreach ($subcatlist as $catvalue) { ?>
                                        <div class="custom-control">

                                            <input type="checkbox" id="c<?php echo $catvalue['id'];?>" class="custom-control-input" <?php echo $catvalue['id']==base64_decode($_GET['CID'])?'checked':'';?> name="category" onclick="listproduct('c','<?php echo $catvalue['id'];?>');">
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
<div class="row" id="product-list">
    <?php 
    $productsPerPage = 15; // Number of products per page
    $count = count($productlist);
    foreach ($productlist as $index => $pvalue) {
    ?>
    <div class="col-md-4 col-6 product-item">
        <div class="card product-card">
            <a href="product-detail.php?PID=<?php echo base64_encode($pvalue['id']); ?>">
                <img class="card-img-top card-img-back" src="aip-admin/uploads/product_images/<?php echo $pvalue["imagelist"];?>">
                <div class="card-info">
                    <div class="card-body">
                        <div class="product-title">
                            <a href="product-detail.php?PID=<?php echo base64_encode($pvalue['id']); ?>"><?php echo $pvalue['name']?></a>
                        </div>
                        <div class="mt-1">
                            <span class="product-price">Price : ₹<?php echo $pvalue['sqft_price'];?></span>
                        </div>
                    </div>
                     <?php 
                        $book_name = $pvalue['name'];
                        $isbn_no = $pvalue['group_name'];
                    ?>
                    <div class="card-footer bg-transparent border-0">
                        <div class="col-12 pb-3">
                            <center>
                                <a target='_blank' href="https://api.whatsapp.com/send?phone=<?php echo WHATSAPP;?>&text=<?php echo MSG1.$book_name.'(ISBN:'.$isbn_no.')'.MSG2;?>" target="_blank" class="customBtn"><i class="fa fa-whatsapp"></i></a>
                                <a target='_blank' href="tel:+<?php echo WHATSAPP;?>" target="_blank" class="customBtn"><i class="fa fa-phone"></i></a>
                            </center>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    if($count != 0){
        ?>

        <div id="pagination-controls" class="pagination">
        
            <button id="first-page" disabled>&laquo; First</button>
            <button id="prev-page" disabled>&lsaquo; Prev</button>
            <span id="page-buttons"></span>
            <button id="next-page">Next &rsaquo;</button>
            <button id="last-page">Last &raquo;</button>
        </div>
    
    <?php
    }else{

    echo '<p> No Data Found </p>';
    }
?>



         </div>

     </section>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
$(document).ready(function() {
    var productsPerPage = <?php echo $productsPerPage; ?>;
    var totalProducts = $('.product-item').length;
    var totalPages = Math.ceil(totalProducts / productsPerPage);
    var currentPage = 1;
    var visiblePages = 5; // Number of page buttons to show at a time

    function showPage(page) {
        if(totalPages == 0){
            $('#first-page').remove();
            $('#prev-page').remove();
            $('#next-page').remove();
            $('#last-page').remove();
            var append = '<strong> No  Data Found </strong>';
            $('.pagination').append(append);
        }
        $('.product-item').hide();
        var start = (page - 1) * productsPerPage;
        var end = start + productsPerPage;
        $('.product-item').slice(start, end).show();
        $('#page-info').text('Page ' + page + ' of ' + totalPages);

        // Update pagination buttons


    

        updatePaginationButtons(page);

        // Disable/enable pagination buttons
        $('#first-page').prop('disabled', page === 1);
        $('#prev-page').prop('disabled', page === 1);
        $('#next-page').prop('disabled', page === totalPages);
        $('#last-page').prop('disabled', page === totalPages);
    }

    function updatePaginationButtons(page) {
        var startPage = Math.max(1, page - Math.floor(visiblePages / 2));
        var endPage = Math.min(totalPages, startPage + visiblePages - 1);

        if (endPage - startPage < visiblePages - 1) {
            startPage = Math.max(1, endPage - visiblePages + 1);
        }

        $('#page-buttons').html('');
        for (var i = startPage; i <= endPage; i++) {
            var button = $('<button class="page-button"></button>').text(i);
            if (i === page) {
                button.addClass('active');
            }
            button.on('click', function() {
                showPage(parseInt($(this).text()));
            });
            $('#page-buttons').append(button);
        }
    }

    $('#first-page').click(function() {
        currentPage = 1;
        showPage(currentPage);
    });

    $('#prev-page').click(function() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    $('#next-page').click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    $('#last-page').click(function() {
        currentPage = totalPages;
        showPage(currentPage);
    });

    showPage(currentPage); // Initialize
});
</script>


<?php include 'footer.php'; ?>