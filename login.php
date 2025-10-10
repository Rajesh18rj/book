<?php
//ini_set('display_errors' ,0);
session_start();
include('dbconfig.php');    
if(isset($_SESSION['user_id'])){
            header("Location:dashboard.php");
    }
if(isset($_REQUEST['login'])) {
    $username = stripslashes($_REQUEST['username']);
         $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
       $sql = "SELECT id,username FROM login_users WHERE username = '$myusername' and password ='".$mypassword."'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       $count = mysqli_num_rows($result);  
      if($count == 1) {
         $_SESSION['login_user'] = $row['username'];
         $_SESSION['user_id'] = $row['id'];
         header("Location: dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
     }    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo COMPANY_NAME;?></title>
        <link href="css/adminstyle.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="#">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input name="username" class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Enter User Name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                            
                                                <input type="submit" class="btn btn-primary" name="login" value="Login" /> 
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="http://www.lakeviewtiles.com"> <?php echo COMPANY_NAME; ?> </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <?php echo COMPANY_NAME; ?> 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
