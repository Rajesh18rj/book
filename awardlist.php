<?php
ini_set('display_errors' ,0);
session_start();
include('dbconfig.php'); 
$setactive10 = "active";
include("adminheader.php"); 

  $sql = "select * from awards  where is_active='0'";
  $result = mysqli_query($db,$sql);

if(isset($_POST['delete'])){
   $row= $_POST['RID'];
  $sql = "update awards set is_active='1' where id=".$row;
 $result = mysqli_query($db,$sql);
header("Location:awardlist.php");
  
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
                      <th>Name<!-- Product Name --></th>
                      <th>Award Type</th>
                      <th>Department <!-- Brand --></th>
                      <th>College<!-- Material --></th>
                      <th>Year<!-- Filter Size --></th>
                      <th>Review</th> 
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php $i=0;
                      foreach ($result as $value) {
                       $i++;?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['award_type'];?></td>
                        <td><?php echo $value['department'];?></td>
                        <td><?php echo $value['college'];?></td>
                        <td><?php echo $value['year'];?></td>
                        <td><a target="_blank" href="./awards-view.php?AID=<?php echo base64_encode($value['id']);?>&APP=<?php echo base64_encode('0');?>">View</td>
                       
	                        
                         <td>
                         
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

