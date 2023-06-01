<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: ../index.php');
};
$con = new mysqli('localhost', 'root', '', 'crm');
$id = $_GET['id'];
$query = "SELECT * FROM leads WHERE id=" . $id;
$result = $con->query($query);
$data=$result->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <?php
  require('../menu.php');
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lead Manager</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Edit lead Manager</h5>
              </div>
              <div class="card-body">
                <div class="container">
                  <form action="lead_update.php?id=<?php echo $id ?>" method="post">
                      <table class="table table-bordered">
                            <tr>
                              <th>Admin id</th>
                              <td>
                                <input type="number" name="admin_id" value="<?php echo($data['admin_id']) ?>" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>
                                <input type="text" name="email" value="<?php echo($data['email']) ?>" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <th>Phone</th>
                              <td>
                                <input type="text" name="phone" value="<?php echo($data['phone']) ?>" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <th>Address</th>
                              <td>
                                <input type="text" name="address" value="<?php echo($data['address']) ?>" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <th>Company name</th>
                              <td>
                                <input type="text" name="company_name" value="<?php echo($data['company_name']) ?>" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <th>District</th>
                              <td>
                                <input type="text" name="district" value="<?php echo($data['district']) ?>" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <th>Upazilla</th>
                              <td>
                                <input type="text" name="upazilla" value="<?php echo($data['upazilla']) ?>" class="form-control">
                              </td>
                            </tr>
                   <tr>
                          <th>status</th>
                          <td>
                              <select name="status" id="status" class="form-control">
                                  <option value=""></option>
                                  <option value="active">active</option>
                                  <option value="inactive">inactive</option>
                              </select>
                           
                          </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <input type="submit" value="update" class="btn btn-block btn-primary">
                      </td>
                    </tr>

                      </table>
                  </form>
                </div>
                 
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
