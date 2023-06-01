<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: ../index.php');
};
$_SESSION["mnu"]="leads";
$_SESSION["mnu_in"]="leas_mngr";

$con = new mysqli('localhost', 'root', '', 'crm');
$admin=$con->query("SELECT `id`,`name` FROM `admin` where role='admin'");
if(isset($_POST['name'])){
  $name=$_POST['name'];
  $admin_id=$_POST['admin_id'];
  $parent=$_POST['parent'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $company_name=$_POST['company_name'];
  $district=$_POST['district'];
  $upazilla=$_POST['upazilla'];
  $status=$_POST['status'];
  $query_admin="INSERT INTO `admin` ( `name`, `email`, `parent`, `phone`) VALUES ('$name', '$email', '$parent', '$phone')";
  $con->query($query_admin);
  $adminID=$con->insert_id;
  $query_lead="INSERT INTO `leads` (`admin_id`, `name`, `address`, `company_name`,`email`,`phone`,`district`, `upazilla`, `status`) VALUES ( '$admin_id', '$name', '$address', '$company_name','$email','$phone','$district', '$upazilla', '$status')";
  $con->query($query_lead);
  header('Location: lead_list.php');
}
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
  <link rel="stylesheet" href="../cstmStyle/style.css">
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
            <h1 class="m-0">Add leads</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
                <h5 class="m-0"></h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Leads Manager</h6>
                   <form action="" method="post">
                      <table class="table table-borderd">
                          <tr>
                            <th>Name</th>
                            <td><input type="text" name="name" class="form-control" placeholder="Enter your name"></td>
                          </tr>
                          <tr>
                            <th>Admin</th>
                            <td>
                              <select name="admin_id" id="admin_id" class="form-control">
                                  <option value="">Select Admin</option>
                                  <?php while($data=$admin->fetch_assoc()){ ?>
                                    <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                                    <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <th>Senior</th>
                            <td>
                              <span id="parent">
                                    <!-- <select name="" id="" class="form-select" disabled>
                                      <option value=""></option>
                                    </select> -->
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td><input type="text" name="email" class="form-control" placeholder="Enter your email"></td>
                          </tr>
                          <tr>
                            <th>Phone</th>
                            <td>
                              <input type="text" name="phone" class="form-control" placeholder="Enter your phone number">
                            </td>
                          </tr>
                          <tr>
                            <th>Address</th>
                            <td>
                              <input type="text" name="address" class="form-control" placeholder="Enter your address">
                            </td>
                          </tr>
                          <tr>
                             <th>Company name</th>
                             <td>
                              <input type="text" name="company_name" class="form-control" placeholder="Enter your company name">
                             </td>
                          </tr>
                          <tr>
                            <th>District</th>
                            <td><input type="text" name="district" class="form-control" placeholder="Enter your district name"></td>
                          </tr>
                          <tr>
                            <th>Upazilla</th>
                            <td><input type="text" name="upazilla" class="form-control" placeholder="Enter your upazilla name"></td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>
                              <input type="radio" name="status" id="" value="active" checked /> active
                              <input type="radio" name="status" id="" value="inactive"/> inactive
                            </td>
                             
                            <!-- <th>status</th>
                          <td>
                              <select name="status" id="status" class="form-control">
                                  <option value=""></option>
                                  <option value="active">active</option>
                                  <option value="inactive">inactive</option>
                              </select>
                          </td> -->
                            
                          </tr>
                          <tr>
                            <td colspan="2">
                              <input type="submit" value="save" class="btn btn-block btn-primary">
                            </td>
                          </tr>
                      </table>
                   </form>
                 
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
<script>
  $(document).ready(function(){
    $('#admin_id').change(function(){
      let admin_id=$(this).val();
      $.ajax({
        url:'get_manager.php',
        method:'post',
        dataType:"",
        data:{id:admin_id},
        success:function(data){
          $('#parent').html(data);
        }

      });
    });
  });
</script>
</body>
</html>
