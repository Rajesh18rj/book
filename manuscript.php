<?php
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php'); 
$setactive8 = "active";
include("adminheader.php"); 

  $sql = "select * from manuscript  where is_active='0'";
  $result = mysqli_query($db,$sql);

if(isset($_POST['delete'])){
   $row= $_POST['RID'];
  $sql = "update manuscript set is_active='1' where id=".$row;
 $result = mysqli_query($db,$sql);
header("Location:manuscript.php");
  
}
  ?>

<div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Submitted Manuscripts</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>#</th>
                      <th>First Name<!-- Product Name --></th>
                      <th>Last Name</th>
                      <th>Email Address <!-- Brand --></th>
                      <th>Phone Number<!-- Material --></th>
                      <th>Address<!-- Filter Size --></th>
                      <th>Book Title<!-- Actual Size --></th>
                      <th>Genre<!-- Group Name --></th>
                       <th>Review</th> 
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['first_name']; ?></td>
                        <td><?php echo $value['last_name'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td><?php echo $value['address'];?></td>
                        <td><?php echo $value['book_title'];?></td>
                        <td><?php echo $value['genre'];?></td>
	                        
                         <td>
                          <a target="_blank" href="<?php $folder= date('Y_m_d',strtotime($value['created_date'])); echo "manuscripts/".$folder."/".$value['file_url'];?>" name="edit" type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
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

