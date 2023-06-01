<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
};
$con = new mysqli('localhost', 'root', '', 'crm');
$id = $_GET['id'];
$q = "SELECT * from `admin` WHERE `admin`.id=" . $id;
$r = "SELECT * from `dealer` WHERE `dealer`.admin_id=" . $id;
$result = $con->query($q);
$dlr_result = $con->query($r);
$data = $result->fetch_assoc();
$dlr_data = $dlr_result->fetch_assoc();
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
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
              <h1 class="m-0">Starter Page</h1>
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
                  <h5 class="m-0">Edit Dealer</h5>
                </div>
                <div class="card-body">
                  <div class="container">
                    <form action="dealer_update.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                      <table class="table table-bordered">
                        <tr>
                          <th>Name</th>
                          <td><input type="text" name="name" value="<?php echo ($data['name']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td><input type="text" name="email" value="<?php echo ($data['email']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Password</th>
                          <td><input type="text" name="password" value="<?php echo ($data['password']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Phone</th>
                          <td><input type="text" name="phone" value="<?php echo ($data['phone']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>trade license</th>
                          <td>
                            <input type="file" name="trade_license" value="" class="form-control">
                            <img style="height: 40px; width:50px; " src="./assets/dealer_trade_license/<?php echo $dlr_data['trade_license'] ?>" alt="">
                          </td>
                        </tr>
                        <tr>
                          <th>address</th>
                          <td><input type="text" name="address" value="<?php echo ($dlr_data['address']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>company name</th>
                          <td><input type="text" name="company_name" value="<?php echo ($dlr_data['company_name']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>bank account</th>
                          <td><input type="text" name="bank_account" value="<?php echo ($dlr_data['bank_account']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>vat no</th>
                          <td><input type="text" name="vat_no" value="<?php echo ($dlr_data['vat_no']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>photo</th>
                          <td>
                            <input type="file" name="photo" value="" class="form-control">
                            <img style="height: 40px; width:50px; " src="./assets/dealer_img/<?php echo $dlr_data['photo'] ?>" alt="">

                          </td>
                        </tr>
                        <tr>
                          <th>district</th>
                          <td><input type="text" name="district" value="<?php echo ($dlr_data['district']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>upazilla</th>
                          <td><input type="text" name="upazilla" value="<?php echo ($dlr_data['upazilla']) ?>" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>status</th>
                          <td>
                              <input name="status" type="radio" id="signi" value="active" <?php if ($dlr_data['status'] == "active") {
                                echo "checked";
                                } ?> /> Active

                                <input name="status" type="radio" id="signi" value="inactive" <?php if ($dlr_data['status'] == "inactive") {
                                echo "checked";
                                } ?> /> Inactive
                          </td>

                        </tr>

                        <tr>
                          <td>
                            <input type="submit" value="Save" class="btn btn-block btn-primary">
                          </td>
                        </tr>
                      </table>
                    </form>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">

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
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    $(function() {
      // Summernote
      $('.summernote').summernote()

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>
</body>

</html>