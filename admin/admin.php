<?php
session_start();
$_SESSION["mnu"] = "admin";
$_SESSION["mnu_in"] = "new_acs";

if (!isset($_SESSION['username'])) {
  header('Location: index.php');
}
$db = new mysqli('localhost', 'root', '', 'crm');

if (isset($_POST["name"])) {
  $name = $_POST['name'];
  $email = $_POST['mail'];
  $password = $_POST['password'];

  if (isset($_POST['parent'])) {
    $parent = $_POST['parent'];
  } else {
    $parent = $_SESSION['id'];
  }

  $phone = $_POST['phone'];
  $role = $_POST['role'];
  $status = $_POST['status'];
  $query = "INSERT into `admin` (`id`,`name`,`email`,`password`,`parent`,`phone`,`role`,`status`) values (NULL,'$name','$email','$password',$parent,'$phone','$role','$status')";
  $db->query($query);
  header('Location:admin.php');
}

if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}
$start = ($page - 1) * 5;

if ($_SESSION['role'] == 'super') {
  $datas = "SELECT * FROM `admin` order by `id` desc limit $start,5 ";
}

if ($_SESSION['role'] == 'admin') {
  $datas = "SELECT * FROM `admin` where `admin`.`parent`=" . $_SESSION['id'] . " order by `id` desc limit $start,5 ";
}

if ($_SESSION['role'] == 'marketing') {
  $datas = "SELECT * FROM `admin` where `admin`.`parent`=" . $_SESSION['id'] . " order by `id` desc limit $start,5 ";
}

$dataV = $db->query($datas);


if ($_SESSION['role'] == 'super') {
  $in_ros = $db->query("SELECT * FROM `admin`");
}

if ($_SESSION['role'] == 'admin') {
  $in_ros = $db->query("SELECT * FROM `admin` where `admin`.`parent`=" . $_SESSION['id']);
}

if ($_SESSION['role'] == 'marketing') {
  $in_ros = $db->query("SELECT * FROM `admin` where `admin`.`parent`=" . $_SESSION['id']);
}
// $in_ros = $db->query("SELECT * FROM `admin` ");
$rows = mysqli_num_rows($in_ros);
$totl_pages = ceil($rows / 5);
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="./cstmStyle/style.css">
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
    require('menu.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Create New User</h1>
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
                  <h5 class="m-0">User form </h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Name </label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name ">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name="mail" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail ">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Password ">
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone Number ">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Role </label>
                            <select name="role" id="role" class="form-control">
                              <option>Select</option>
                              <?php if ($_SESSION['role'] == "super") { ?>
                                <option value="admin">Admin</option>
                                <option value="marketing">Marketing manager</option>
                                <option value="dealer">Dealer</option>
                              <?php } ?>
                              <?php if ($_SESSION['role'] == "admin") { ?>
                                <option value="marketing">Marketing manager</option>
                                <option value="dealer">Dealer</option>
                              <?php } ?>
                              <?php if ($_SESSION['role'] == "marketing") { ?>
                                <option value="dealer">Dealer</option>
                              <?php } ?>
                              <?php if ($_SESSION['role'] == "dealer") { ?>
                                <option value="customar">Customar</option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Status</label><br>
                            <input type="radio" name="status" id="" value="active"> Active
                            <input type="radio" name="status" id="" value="InActive"> InActive
                          </div>
                        </div>
                      </div>

                      <div class="form-group" id="s_role">

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1"></label>
                        <input type="submit" class="btn btn-primary btn-block" value="Save">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Sl</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone no.</th>
                            <th>Role</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="pID">
                          <?php $i = 01;
                          while ($d = $dataV->fetch_assoc()) { ?>
                            <tr>
                              <td><?php echo $i ?></td>
                              <td><?php echo $d['id']; ?></td>
                              <td><?php echo $d['name']; ?></td>
                              <td><?php echo $d['email'] ?></td>
                              <td><?php echo $d['phone'] ?></td>
                              <td><?php echo $d['role'] ?></td>
                              <td>
                                <a href="./nasim_gazi/admin_edit.php?id=<?php echo $d['id'] ?>" class="btn btn-success btn-xs">Edit</a>
                                <a href="./nasim_gazi/admin_delete.php?id=<?php echo $d['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="./nasim_gazi/admin_view.php?id=<?php echo $d['id'] ?>" class="btn btn-xs btn-primary">View</a>
                              </td>
                            </tr>
                          <?php ++$i;
                          } ?>
                        </tbody>
                      </table>
                      <?php

                      if ($page > 1) {

                        echo "<a href='admin.php?page=" . ($page - 1) . "' class='btn  btn-primary find_page'> << </a>";
                      }

                      for ($n = 1; $n < $totl_pages; $n++) {
                        echo "<a href='admin.php?page=" . ($n) . "' class='btn find_page btn-primary'> " . ($n) . "</a>";
                      }

                      if ($n > $page) {
                        echo "<a href='admin.php?page=" . ($page + 1) . "' class='btn  btn-primary find_page'> >> </a>";
                      }

                      ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
          <!-- /.container-fluid -->
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
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <script src="./jquery-3.6.1.min.js"></script>
  <script>
    $(document).ready(function() {


      $("#role").change(function() {
        let rl = $(this).val();
        if (rl != 'admin') {

          $.ajax({
            url: "seniorData.php",
            method: "get",
            dataType: "json",
            data: {
              senior: rl
            },

            success: (function(ad_dta) {

              let ht = `<label for="exampleInputEmail1"> Superior </label>
                          <select name="parent"  class="form-control">`
              ad_dta.forEach(function(d) {
                ht += `<option class='' value="${d.id}">${d.name}</option>`
              })
              ht += `</select>`;
              $("#s_role").html(ht);
              console.log('vaii')
            })
          })
        } else {

          $("#s_role").html('');
          console.log('vaiOKKKi')
        }


      })




    })
  </script>
</body>

</html>