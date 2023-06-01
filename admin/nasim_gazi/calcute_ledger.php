<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

// if ($_SESSION['role']!="super" || $_SESSION['role']!="admin" ) {
//   header('Location: ../dashboard.php');
// }



$mr_id = $_GET["mr_id"];
$db = new mysqli("localhost", "root", "", "crm");
$qry = $db->query("SELECT * FROM `payments` where `payments`.`collected_by`='$mr_id' ORDER BY `payments`.`created_at` ASC");
$pmt = [];
while ($payment_data = $qry->fetch_assoc()) {
  $pmt[] = $payment_data["created_at"];
};

$dilar_cash = $db->query(" SELECT * FROM `invoice` where `invoice`.`created_by`='$mr_id' ORDER BY `created_at` ASC");
// $dlr = [];
while ($invoice_data = $dilar_cash->fetch_assoc()) {
  $pmt[] = $invoice_data["created_at"];
};
//var_dump($pmt);
// $tol_dta = array_merge_recursive($qry, $dlr);
// var_dump($tol_dta);

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
                  <h5 class="m-0">Payments</h5>
                </div>
                <div class="card-body">
                  <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Data </th>
                          <!-- <th>Source </th> -->
                          <th>Debit </th>
                          <th>Credit </th>
                          <th>Balance </th>
                          <!-- <th>Final Balance </th> -->
                        </tr>
                      </thead>
                      <tbody class="">
                        <?php $total = 0;
                        $debit = 0;
                        $credit = 0;
                        foreach ($pmt as $value) {

                          $date = $value;
                          $qry = $db->query("SELECT * FROM `payments` where `payments`.`created_at`='$date'");
                          $pmt_data = $qry->fetch_assoc();

                          $dilar_cash = $db->query(" SELECT * FROM `invoice` where `invoice`.`created_at`='$date' ORDER BY `created_at` ASC");
                          $inv_data = $dilar_cash->fetch_assoc();
                          if (isset($pmt_data["amount"])) {
                            $total = $total + $pmt_data["amount"];
                            $debit = $debit + $pmt_data["amount"];
                          }
                          if (isset($inv_data["price"])) {
                            $total = $total - $inv_data["price"];
                            $credit = $credit + $inv_data["price"];
                          };
                        ?>
                          <tr>
                            <td> <?php echo $value ?> </td>
                            <!-- <td> </td> -->
                            <td> <?php echo ($pmt_data) ? $pmt_data["amount"] : 0 ?> </td>
                            <td> <?php echo ($inv_data) ? $inv_data["price"] : 0 ?> </td>
                            <td> <?php echo $total ?> </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <!-- <td></td> -->
                          <td><strong> Total Debit : <?php echo $debit ?></strong></td>
                          <td><strong> Total Credit : <?php echo $credit ?> </strong> </td>
                          <td> <strong> Final Balance : <?php echo $total ?> </strong></td>

                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td class=" align-self-end"><a onclick="window.location.href = 'ledger.php';" class="btn back btn-outline-primary" style="margin-left: 18px">Back</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
            <?php

            ?>
            <!-- /.col-md-6 -->

          </div>
          <!-- /.row -->
          <span id="dler">

          </span>
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
    <!-- <script src="../jquery-3.6.1.js"></script> -->
    <script src="../jquery-3.6.1.min.js"></script>
    <?php

    ?>
    <!-- <script>
      $(document).ready(function() {
        $(".back").click(function() {
          console.log("ok");
          window.location.replace("./ledger.php");

        })
      })
    </script> -->
</body>

</html>