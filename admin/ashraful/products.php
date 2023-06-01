<?php
session_start();
$_SESSION["mnu"]="products";
$_SESSION["mnu_in"]="asr_pdtcs";

if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');
$q = "SELECT * FROM products";
$data = $con->query($q);
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $dealer_price = $_POST['dealer_price'];
  $mrp = $_POST['mrp'];
  $unit = $_POST['unit'];
  $vat = $_POST['vat'];
  $status = $_POST['status'];
  echo $query = "INSERT INTO products (name,dealer_price,mrp,unit,vat,status)VALUES('$name','$dealer_price','$mrp','$unit','$vat','$status')";
  $con->query($query);
   header('Location: products.php');
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
              <h1 class="m-0">Insert your Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Page-1</a></li>
                <li class="breadcrumb-item active">Insert Page</li>
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
                  <h5 class="m-0"> </h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Product ">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Dealer Amount</label>
                            <input type="text" name="dealer_price" class="form-control" id="exampleInputEmail1" placeholder="Enter Dealer Price ">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">MRP</label>
                            <input type="text" name="mrp" class="form-control" id="exampleInputEmail1" placeholder="Enter MRP ">
                          </div>
                        </div>
                        <div class="class col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Unit</label>
                            <input type="text" name="unit" class="form-control" id="exampleInputEmail1" placeholder="Enter Unit ">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Vat</label>
                            <input type="text" name="vat" class="form-control" id="exampleInputEmail1" placeholder="Enter Vat ">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Status</label><br>
                            <td>
                              <input name="status" type="radio" value="active" /> Active
                              <input name="status" type="radio" value="inactive" /> Inactive
                            </td>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1"></label>
                        <input type="submit" class="btn btn-primary btn-block" value="Save">
                      </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Dealer_Price</th>
                                <th>MRP</th>
                                <th>Unit</th>
                                <th>VAT</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="pID">
                              <?php while ($d = $data->fetch_assoc()) { ?>
                                <tr>
                                  <td><?php echo $d['id'] ?></td>
                                  <td><?php echo $d['name'] ?></td>
                                  <td><?php echo $d['dealer_price'] ?></td>
                                  <td><?php echo $d['mrp'] ?></td>
                                  <td><?php echo $d['unit'] ?></td>
                                  <td><?php echo $d['vat'] ?></td>
                                  <td>
                                    <a href="product_edit.php?id=<?php echo $d['id'] ?>" class="btn btn-success btn-xs">Edit</a>
                                    <a href="product_delete.php?name=<?php echo $d['name'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>

                      </div>
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
</body>

</html>