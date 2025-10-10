<?php
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php'); 

$setactive1 = "active";
include("adminheader.php"); 

if(isset($_POST['delete'])){
  $row= $_POST['RID'];

  $sql = "update ".$_GET['view']." set is_active='1' where id=".$row;
  $result = mysqli_query($db,$sql);
}

$subcat_sql = "select id,category_name from category where is_active='0'";
$subcatlist =mysqli_query($db,$subcat_sql);
foreach ($subcatlist as $ckey => $cvalue) {
  $subcatarray[$cvalue['id']] = $cvalue;
}
//print_r($subcatarray[5]);

$brandsql = "select id,brand_name from brand where is_active='0'";
$brandlist = mysqli_query($db,$brandsql);
foreach ($brandlist as $ckey1 => $cvalue1) {
  $brandarray[$cvalue1['id']] = $cvalue1;
}

$sizsql = "select id,size_name from sizelist where is_active='0'";
$sizeslist = mysqli_query($db,$sizsql);
foreach ($sizeslist as $ckey => $cvalue) {
  $sizarray[$cvalue['id']] = $cvalue;
}
//print_r($sizarray[5]);

$materialsql = "select id,material_type from material where is_active='0'";
$matlist = mysqli_query($db,$materialsql);
foreach ($matlist as $ckey => $cvalue) {
  $matarray[$cvalue['id']] = $cvalue;
}



if($_GET['view']=='category'){
  $sql = "select * from category where is_active='0'";
  $result = mysqli_query($db,$sql);
  ?>
<div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Category</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>#</th>
                      <th>Name</th>
                       <th>Edit</th> 
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['category_name']; ?></td>
  <td>       <a href="category.php?RID=<?php echo $value['id'];?>" name="edit" type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </a>
                            </td>  <td>
                                 <form method="post" action="">
                            <input type="hidden" name="RID" value="<?php echo $value['id'];?>">
                              <button type="submit" rel="tooltip" name="delete" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button> </form> </td>
                          
                      </tr>
                      <?php 
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

  <?php
}

if($_GET['view']=='brand'){
  $sql = "select * from brand  where is_active='0'";
  $result = mysqli_query($db,$sql); ?>
  <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Brands</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>#</th>
                      <th>Name</th>
                       <th>Edit</th> 
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['brand_name']; ?></td>
                          <td><a href="brands.php?RID=<?php echo $value['id'];?>" name="edit" type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </a></td>  <td>
                                 <form method="post" action="">
                            <input type="hidden" name="RID" value="<?php echo $value['id'];?>">
                              <button type="submit" rel="tooltip" name="delete" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button> </form> </td>
                          
                      </tr>
                      <?php 
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
<?php
}




if($_GET['view']=='material'){
  $sql = "select * from material where is_active='0'";
  $result = mysqli_query($db,$sql);
  ?>
<div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Material</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>#</th>
                      <th>Name</th>
                       <th>Edit</th> 
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['material_type']; ?></td>
  <td>       <a href="material.php?RID=<?php echo $value['id'];?>" name="edit" type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </a>
                            </td>  <td>
                                 <form method="post" action="">
                            <input type="hidden" name="RID" value="<?php echo $value['id'];?>">
                              <button type="submit" rel="tooltip" name="delete" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button> </form> </td>
                          
                      </tr>
                      <?php 
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

  <?php
}

if($_GET['view']=='sizelist'){
  $sql = "select * from sizelist  where is_active='0'";
  $result = mysqli_query($db,$sql); ?>
  <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Size</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>#</th>
                      <th>Name</th>
                       <th>Edit</th> 
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['size_name']; ?></td>
                          <td><a href="sizes.php?RID=<?php echo $value['id'];?>" name="edit" type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </a></td>  <td>
                                 <form method="post" action="">
                            <input type="hidden" name="RID" value="<?php echo $value['id'];?>">
                              <button type="submit" rel="tooltip" name="delete" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button> </form> </td>
                          
                      </tr>
                      <?php 
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
<?php
}
if($_GET['view']=='products'){
  $sql = "select * from products  where is_active='0'";
  $result = mysqli_query($db,$sql);
  ?>

<div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Products</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>#</th>
                      <th>Book Title</th>
                      <th>Author</th>
                      <th>ISBN</th>
                      <th>Price</th>
                      <th  style="width:40px; ">Image </th>
                       <th style="width:50px; ">Edit</th> 
                      <th style="width:50px; ">Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="product-detail.php?PID=<?php echo base64_encode($value['id']); ?>" target="_blank"><?php echo $value['name']; ?></td>
                        <td><?php echo $value['material'];?></td>
                        <td><?php echo $value['group_name'];?></td>
                        
                        <td><?php echo $value['sqft_price'];?></td>
                        
                        <?php $imglist = json_decode($value['imagelist'],1); ?>
                        <td> <?php foreach ($imglist as $ivalue) { ?>
                         <a href="<?php echo "../uploads/".$ivalue;?>" target="_blank"> <img src="<?php echo "../uploads/".$ivalue;?>" width="30px"/> </a>
                      <?php } ?></td>
                         <td>
                          <a href="newproduct.php?RID=<?php echo $value['id'];?>" name="edit" type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </a></td>  <td>
                                 <form method="post" action="">
                            <input type="hidden" name="RID" value="<?php echo $value['id'];?>">
                              <button type="submit" rel="tooltip" name="delete" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button> </form> </td>
                          
                      </tr>
                      <?php 
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

  <?php
}
      ?>