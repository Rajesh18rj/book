<?php
session_start();
include_once 'class/class_user.php';
$user = new User();

$id = $_SESSION['id'];

if (!$user->get_session()) {
  header("location:login.php");
}

if (isset($_GET['logout'])) {
  $user->user_logout();
  header("location:login.php");
}
//echo $user->get_fullname($uid);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo isset($title) ? $title : "Aip Admin Panel"; ?>
  </title>
  <link rel="icon" type="image/x-icon" href="dist/img/favicon.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


  <style type="text/css">
    .dataTables_length {
      display: contents;
    }

    .dataTables_length label {
      margin-left: 20px;
    }

    .dataTables_length .custom-select-sm {
      font-size: 100%;
    }

    #profile_image {
      width: 2.5em;
      border-radius: 4px;
      border: 1px solid #f4f4f4;
    }

    .user-panel {
      align-items: center;
    }

    .brand-image {
      border: 1px solid #f4f4f4 !important;
      padding: 2px !important;
      border-radius: 4px !important;
    }

    .nav li a,
    .user-panel a,
    .nav p {
      font-family: 'Play', sans-serif !important;
      font-weight: 600;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    th {
      font-family: 'Play', sans-serif;
      font-weight: 600;
    }

    .brand-text,
    .navbar-light .navbar-nav .nav-link {
      font-family: 'Play', sans-serif;
      font-weight: 600 !important;
    }

    .navbar-light .navbar-nav .nav-link {
      color: #17353d !important;
    }

    .card-zg {
      background-color: #17353d !important;
      color: #fff !important;
    }

    td,
    p,
    label,
    button,
    textarea.form-control,
    .form-control,
    .breadcrumb-item {
      font-family: 'ABeeZee', sans-serif;
      font-size: 15px !important;
    }

    .btn-zg {
      background-color: #17353d !important;
      border: 1px solid #17353d !important;
      color: #fff;
    }

    .btn-zg:hover {
      background-color: #1d3f48 !important;
      border: 1px solid #17353d !important;
      color: #fff !important;
    }

    .btn-zo {
      background-color: #c67e32 !important;
      border: 1px solid #c67e32 !important;
      color: #fff;
    }

    .btn-zo:hover {
      background-color: #d18b42 !important;
      border: 1px solid #c67e32 !important;
      color: #fff;
    }

    .center {
      text-align: center !important;
    }

    .bg-zg {
      background-color: #205866 !important;
      border: 1px solid #205866 !important;
      color: #fff;
    }

    .bg-zo {
      background-color: #c67e32 !important;
      border: 1px solid #c67e32 !important;
      color: #fff;
    }

    .text-zg {
      color: #205866 !important;
    }

    .text-zo {
      color: #c67e32 !important;
    }

    button.close {
      font-size: 25px !important;
    }

    .alert {
      padding: 0.5rem 1.25rem;
    }

    .export_options {
      display: flex !important;
    }

    .table thead th {
      border-bottom: none !important;
      vertical-align: top;
    }

    .tooltip-inner {
      max-width: 200px;
      padding: 3px 8px;
      color: #fff;
      text-align: center;
      background-color: #17353d;
      border-radius: .25rem;
    }

    .tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before,
    .tooltip.bs-tooltip-top .arrow::before {
      /*margin-left: -3px;*/
      content: "";
      border-width: 5px 5px 0;
      border-top-color: #17353d;
    }

    tfoot tr th {
      border-bottom: 1px solid #dee2e6 !important;
    }

    .page-item.active .page-link {
      background-color: #17353d !important;
      border: 1px solid #17353d !important;
      color: #fff;
    }

    .btn-group {
      display: contents !important;
    }

    .buttons-excel,
    .buttons-csv {
      background-color: #f4f6f9 !important;
      border-radius: 4px !important;
      border: 1px solid #1f6e43 !important;
      color: #1f6e43 !important;
      margin-right: 3px;
    }

    .buttons-excel:hover,
    .buttons-csv:hover {
      background-color: #1f6e43 !important;
      border-radius: 4px !important;
      border: 1px solid #1f6e43 !important;
      color: #fff !important;
    }

    .buttons-pdf {
      background-color: #f4f6f9 !important;
      border-radius: 4px !important;
      border: 1px solid #f20f00 !important;
      color: #f20f00 !important;
    }

    .buttons-pdf:hover {
      background-color: #f20f00 !important;
      border-radius: 4px !important;
      border: 1px solid #f20f00 !important;
      color: #fff !important;
    }

    .btn-zw {
      background-color: #295394 !important;
      border: 1px solid #295394 !important;
      color: #fff;
    }

    .btn-zw:hover {
      background-color: #263a58 !important;
      border: 1px solid #263a58 !important;
      color: #fff !important;
    }

    .btn-zp {
      background-color: #f20f00 !important;
      border: 1px solid #f20f00 !important;
      color: #fff;
    }

    .btn-zp:hover {
      background-color: #c11f15 !important;
      border: 1px solid #c11f15 !important;
      color: #fff !important;
    }

    .d-block {
      white-space: normal;
      word-break: break-word;
    }
    .color_class{
      color: #995b5b;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/favicon.png" alt="AdminLTELogo" height="134" width="200">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <img src="dist/img/favicon.png" style="width: 20vh"; >
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=logout" role="button">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-purple elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/favicon.png" alt="AdminLTE Logo" class="brand-image elevation-1">
        <span class="brand-text font-weight-light">AIP Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
          
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $user->get_fullname($id); ?> </a>
          </div>
        </div>

       

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Category
                  </p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="menu.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Menu Script
                  </p>
                </a>
              </li> -->

              
              <!-- <li class="nav-item">
                <a href="material.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Material
                  </p>
                </a>
              </li> -->

              

              
              <li class="nav-item">
                <a href="product.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Product
                  </p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="awards.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Awards
                  </p>
                </a>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
    
    <!-- /.sidebar -->
    </aside>

    <style type="text/css">
      #example1_filter label {
        float: right;
        margin-bottom: 20px;
      }

      #example1_filter {
        display: contents;
      }
    </style>