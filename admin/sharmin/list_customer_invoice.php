<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location:../index.php');
};

$_SESSION["mnu_f"] = "invoice_per";
$_SESSION["mnu"] = "invoice";
$_SESSION["mnu_in"] = "cstmr_list_sr";



$q = "SELECT * FROM customer_invoice";
$con = new mysqli('localhost', 'root', '', 'crm');
$data = $con->query($q);
$dlr = $con->query("SELECT * from `admin` where `admin`.`id`='" . $_SESSION["id"] . "'");
$custo = $con->query("SELECT * from `customers` where `customers`.`dealer_id`='" . $_SESSION["id"] . "'");
$cr = $con->query('SELECT * from admin');

if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}
$start = ($page - 1) * 5;


$in_ro = "SELECT * FROM `customer_invoice` GROUP BY `invoice_id` order by id desc limit $start,5";
$dataV = $con->query($in_ro);

$in_ros = $con->query("SELECT * FROM `customer_invoice` GROUP BY `invoice_id` order by id desc");
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
            <div class="col-lg-12 card-footer">
              <div class="card card-primary card-outline">

                <div class="card-header">
                  <h2 class="m-0">Invoice-List</h2>
                  <a href="customer_invoice.php" class="btn btn-primary btn-xs " style="margin-left:85%">Create_Invoice</a>
                </div>

                <div class="card-body row">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>customer Name</th>
                        <th>Product Name</th>
                        <th>Invoice_id</th>
                        <th>Vat</th>
                        <th>Discount</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="pID">
                      <?php $sl = 1;
                      while ($d = $dataV->fetch_assoc()) {
                        // var_dump($d);
                        $cntmr_name = $con->query("SELECT `customers`.`name` FROM customers WHERE ID=" . $d['customer_id'])->fetch_assoc();
                        $da = $con->query("SELECT `products`.`name` FROM products WHERE ID=" . $d['product_id'])->fetch_assoc();
                        // $da = $con->query('select * from products where id ='.$d['product_id'])->fetch_array();
                      ?>
                        <tr>
                          <td><?php echo $sl; ?></td>
                          <td><?php echo $cntmr_name['name'] ?></td>
                          <td><?php echo $da['name'] ?></td>
                          <td><?php echo $d['invoice_id'] ?></td>
                          <td><?php echo $d['vat'] ?></td>
                          <td><?php echo $d['discount'] ?></td>
                          <td><?php echo $d['created_at'] ?></td>
                          <td><?php echo $d['payable'] ?></td>
                          <td class="row container-fluid">
                            <div class="col-4">
                              <a href="edit_customer_invoice.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-success btn-xs">
                                <i class="fa fa-edit" style="color:white;"></i>
                              </a>
                            </div>

                            <div class="col-4">
                              <a href="del_customer_invoice.php?id=<?php echo $d['id'] ?>" class="btn btn-danger btn-xs " onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash-o" style="color:white"></i>
                              </a>
                            </div>

                            <div class="col-4">
                              <a href="invoice_det.php?id=<?php echo $d['invoice_id'] ?>" class="btn btn-xs btn-primary">
                                <i class="fa fa-eye" style="color:white"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                      <?php $sl++;
                      } ?>
                    </tbody>
                  </table>
                  <div class="col-9"></div>

                  <div class="col-3">
                    <nav aria-label="Page navigation">
                      <ul class="pagination"><?php
                        if ($page>1) { ?>
                        <li class="page-item"><a class="page-link btn btn-primary" href="list_customer_invoice.php?page=<?php  echo ($page - 1) ?>"> << </a></li>
                         <?php }
                        for ($n = 1; $n < $totl_pages; $n++) { ?>
                        <li class="page-item"><a class="page-link btn btn-primary" href='list_customer_invoice.php?page=<?php echo ($n) ?>'><?php echo ($n) ?></a></li>
                        <?php }
                        if ($n > $page) { ?>
                        <li class="page-item"><a class="page-link btn btn-primary" href="list_customer_invoice.php?page=<?php  echo ($page + 1) ?>">>></a></li>

                        <?php } ?>
                      </ul>
                    </nav>
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
  <!-- <footer class="main-footer"> -->
  <!-- To the right -->
  <!-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
   
  </footer>
</div> -->
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