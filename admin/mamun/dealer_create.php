<?php
session_start();

$_SESSION["mnu"]="dealer";
$_SESSION["mnu_in"]="crt_dlr";

if (!isset($_SESSION['username'])) {
  header('Location: index.php');
};
$con = new mysqli('localhost', 'root', '', 'crm');
$admin_data = $con->query("SELECT `id`,`name` FROM `admin` where role='admin'");
$q = "SELECT `dealer`.*, `admin`.`name`, `admin`.`email`, `admin`.`password`, `admin`.`phone` FROM `dealer` join `admin` on `admin`.`id`=`dealer`.`admin_id`";
$dler_data = $con->query($q);
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  // $admin_id = $_POST['admin_id'];
  $parent = $_SESSION['id'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $company_name = $_POST['company_name'];
  $bank_account = $_POST['bank_account'];
  $vat_no = $_POST['vat_no'];
  $district = $_POST['district'];
  $upazilla = $_POST['upazilla'];
  $status = $_POST['status'];
  $trade = $_FILES['trade_license']['name'];

  move_uploaded_file($_FILES['trade_license']['tmp_name'], './assets/dealer_trade_license/' . $trade);

  $photo = $_FILES['photo']['name'];
  move_uploaded_file($_FILES['photo']['tmp_name'], './assets/dealer_img/' . $photo);
  $query_admin = "INSERT INTO `admin` (`name`, `email`,`phone`,`password`,`parent`) VALUES ('$name', '$email', '$phone',$password,$parent)";
  $con->query($query_admin);
  $adminID = $con->insert_id;
  $query_dealer = "INSERT INTO `dealer` (`admin_id`, `trade_license`, `address`, `company_name`, `bank_account`, `vat_no`, `photo`, `district`, `upazilla`, `status`) VALUES ($adminID, '$trade', '$address','$company_name', '$bank_account', '$vat_no', '$photo', '$district', '$upazilla', '$status')";

  $con->query($query_dealer);
  header('Loation: dealer_create.php');
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
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
                  <h5 class="m-0">Create Dealer</h5>
                </div>
                <div class="card-body">
                  <div class="container">
                    <form action="" method="post" enctype="multipart/form-data">
                      <table class="table table-bordered table-responsive">
                        <tr>
                          <th>Name</th>
                          <td><input type="text" name="name" value="" class="form-control"></td>
                          <th>Email</th>
                        <td><input type="text" name="email" value="" class="form-control"></td>
                        </tr>
                        <!-- <tr>
                          <th>Admin</th>
                          <td>
                            <select name="admin_id" id="admin_id" class="form-control">
                              <option value="">Select Admin</option>
                              <?php while ($data = $admin_data->fetch_assoc()) { ?>
                                <option value="<?php echo $data["id"] ?>"> <?php echo $data["name"] ?> </option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr> -->

                       
                        </tr>
                        <tr>
                        <tr>
                          <th>Password</th>
                          <td><input type="text" name="password" value="" class="form-control"></td>
                          <th>Phone</th>
                          <td><input type="text" name="phone" value="" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Trade License</th>
                          <td><input type="file" name="trade_license" value="" class="form-control"></td>
                          <th>Address</th>
                          <td><input type="text" name="address" value="" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Company Name</th>
                          <td><input type="text" name="company_name" value="" class="form-control"></td>
                          <th>Bank Account</th>
                          <td><input type="text" name="bank_account" value="" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Vat Registration No</th>
                          <td><input type="text" name="vat_no" value="" class="form-control"></td>
                          <th>Photo</th>
                          <td><input type="file" name="photo" value="" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>District</th>
                          <td><input type="text" name="district" value="" class="form-control"></td>
                          <th>Upazilla</th>
                          <td><input type="text" name="upazilla" value="" class="form-control"></td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td>
                            <input type="radio" name="status" id="" value="active">Active
                            <input type="radio" name="status" id="" value="inactive">Inactive
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
                      <label for="">Dealer Details</label>
                      <table class="table table-bordered table-responsive">
                       
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <!-- <th scope="col">Password</th> -->
                            <th scope="col">Phone</th>
                            <!-- <th scope="col">Trade License</th> -->
                            <th scope="col">Address</th>
                            <!-- <th scope="col">Company Name</th>
                            <th scope="col">Bank Account</th>
                            <th scope="col">Vat No</th>
                            <th scope="col">Photo</th>
                            <th scope="col">District</th>
                            <th scope="col">Upazilla</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th> -->
                            <th>Action</th>
                          </tr>
                       
                        <tbody id="pID">
                          <?php while ($d = $dler_data->fetch_assoc()) { ?>
                            <tr>
                              <td scope="row"><?php echo $d['name'] ?></td>
                              <td><?php echo $d['email'] ?></td>
                              <!-- <td><?php echo $d['password'] ?></td> -->
                              <td><?php echo $d['phone'] ?></td>
                              <!-- <td><?php echo $d['trade_license'] ?></td> -->
                              <td><?php echo $d['address'] ?></td>
                              <!-- <td><?php echo $d['company_name'] ?></td>
                              <td><?php echo $d['bank_account'] ?></td>
                              <td><?php echo $d['vat_no'] ?></td>
                              <td><?php echo $d['photo'] ?></td>
                              <td><?php echo $d['district'] ?></td>
                              <td><?php echo $d['upazilla'] ?></td>
                              <td><?php echo $d['status'] ?></td> -->
                              <td>
                                <a href="dealer_edit.php?id=<?php echo $d['admin_id'] ?>" class="btn btn-success btn-xs">Edit</a>
                                <a href="dealer_delete.php?id=<?php echo $d['admin_id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="dealer_view.php?id=<?php echo $d['admin_id'] ?>" class="btn btn-xs btn-primary">View</a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>

                    
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