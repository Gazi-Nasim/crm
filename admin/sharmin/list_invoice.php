<?php
session_start();

$_SESSION["mnu"] = "invoice";
$_SESSION["mnu_in"] = "srm_invo_list";

if (!isset($_SESSION['username'])) {
  header('Location:../index.php');
};

if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}
$start = ($page - 1) * 5;

$db = new mysqli('localhost', 'root', '', 'crm');
$datas = "SELECT * FROM `invoice` GROUP BY `invoice`.`invoice_id` order by `id` desc limit $start,5";
$data = $db->query($datas);

$in_ros = $db->query("SELECT * FROM `invoice` GROUP BY `invoice`.`invoice_id`");
$rows = mysqli_num_rows($in_ros);
$totl_pages = ceil($rows / 5);



// $data = $con->query($q);


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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                  <h2 class="m-0">Invoice-List</h2>
                </div>

                <div class="card card-primary card-outline">
                  <table class="table table-bordered  table-striped table-responsive">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Dealer Name</th>
                        <th>Invoice ID</th>
                        <th>Products Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Payable</th>
                        <th>Date</th>
                        <th>Action_____________</th>
                      </tr>
                    </thead>
                    <tbody id="pID">
                      <?php while ($d = $data->fetch_assoc()) {
                        $dk = $db->query('select * from products where id =' . $d['product_id'])->fetch_array();
                        $da = $db->query('select * from admin where id =' . $d['dealer_id'])->fetch_array();
                      ?>
                        <tr>
                          <td><?php echo $d['id']; ?></td>
                          <td><?php echo $da['name'] ?></td>
                          <td><?php echo $d['invoice_id'] ?></td>
                          <td><?php echo $dk['name'] ?></td>
                          <td><?php echo $d['price'] ?></td>
                          <td><?php echo $d['quantity'] ?></td>
                          <!-- <td><?php echo $d['total'] ?></td>
                        <td><?php echo $d['vat'] ?></td> -->
                          <td><?php echo $d['discount'] ?></td>
                          <td><?php echo $d['payable'] ?></td>
                          <td><?php echo $d['created_at'] ?></td>
                          <td>
                            <a href="../sifath/edit_invoice.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-success btn-group btn-group-sm">
                              <i class="fa fa-edit" style="color:white; "></i>
                            </a>

                            <a href="del_invoice.php?id=<?php echo $d['id'] ?>" class="btn btn-danger btn-group btn-group-sm " onclick="return confirm('Are you sure?')">
                              <i class="fa fa-trash-o" style="color:white; "></i>
                            </a>

                            <a href="../amran/invoice_details.php?id=<?php echo $d['invoice_id'] ?>" class="btn btn-group btn-group-sm btn-primary">
                              <i class="fa fa-eye" style="color:white; "></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div class="card-footer">
                  <?php

                  if ($page > 1) {

                    echo "<a href='list_invoice.php?page=" . ($page - 1) . "' class='btn  btn-primary find_page'> << </a>";
                  }

                  for ($n = 1; $n < $totl_pages; $n++) {
                    echo "<a href='list_invoice.php?page=" . ($n) . "' class='btn find_page btn-primary'> " . ($n) . "</a>";
                  }

                  if ($n > $page) {
                    echo "<a href='list_invoice.php?page=" . ($page + 1) . "' class='btn  btn-primary find_page'> >> </a>";
                  }

                  ?>
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
  <!-- <script>
  $(function () {
    // Summernote
    $('.summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script> -->
</body>

</html>