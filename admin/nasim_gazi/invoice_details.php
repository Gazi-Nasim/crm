<?php

session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

if (isset($_GET['invoice_id'])) {
  $id = $_GET['invoice_id'];
  $con = new mysqli('localhost', 'root', '', 'crm');
  $invs = $con->query('SELECT id, dealer_id, invoice_id, product_id, price, quantity, total, vat, discount, payable, created_at, created_by, SUM(payable) from `customer_invoice` GROUP BY invoice_id having invoice_id=' . $id);
  $data = $invs->fetch_assoc();

  $id = $_GET['invoice_id'];

  $dl_name = $con->query("SELECT `admin`.`name` as dlrName, `admin`.`id`, `customers`.*, `customers`.`name` as cstmrName, `customer_invoice`.*
  FROM `customer_invoice`
  JOIN `admin` ON `customer_invoice`.`dealer_id` = `admin`.`id`
  JOIN `customers` ON `customer_invoice`.`customer_id` = `customers`.`id`
  WHERE `customer_invoice`.`invoice_id` = " . $id)->fetch_assoc();


  // $dl_name = $con->query("SELECT `admin`.`name` as dlrName, `admin`.`id`, `customers`.*, `customers`.`name` as cstmrName, `customer_invoice`.*
  // from `admin`
  // join `customer_invoice` on `customer_invoice`.`dealer_id`=`admin`.`id`
  // join `customers` on `customers`.`id`=`customer_invoice`.`customer_id`
  // where `customer_invoice`.`invoice_id`=" . $id)->fetch_assoc();
  echo '<pre>';
  var_dump($dl_name);
  echo '</pre>';
  $d_info = $con->query('SELECT * from `dealer`')->fetch_assoc();
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
  <!-- apni apnar directory wise ekhane path change kore niben-->

  <!--  -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- apni apnar directory wise ekhane path change kore niben -->

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
      <div class="page-content container">
        <div class="page-header text-blue-d2">
          <div class="row ">
            <div class="col-10">


            </div>
            <div class="col-2 text-end align-self-end">
              <div class="page-tools">
                <div class="action-buttons">
                  <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    <button onclick="PrintDiv()">Print</button>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="container px-0">
          <div class="row mt-4">
            <div class="col-12 col-lg-12" id='divToPrint'>
              <div class="row">
                <div class="col-12">
                  <div class="text-center text-150">
                    <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                    <span class="text-default-d3">Invoice Details</span>
                  </div>
                </div>
              </div>
              <!-- .row -->

              <hr class="row brc-default-l1 mx-n1 mb-4" />

              <div class="row container">

                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-start">
                  <hr class="d-sm-none" />
                  <div class="text-grey-m2">

                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                      <h4>Customer information</h4>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">Customer Name:</span>
                      <span> <strong><?php echo $dl_name['cstmrName'] ?></strong></span>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">Customer ID:</span>
                      <span><?php echo $data['dealer_id'] ?></span>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">Company Name: </span>
                      <span><?php echo $dl_name['organization'] ?></span>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">Address: </span>
                      <span><?php echo $dl_name['address'] ?></span>
                    </div>
                  </div>

                </div>
                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                  <hr class="d-sm-none" />
                  <div class="text-grey-m2">

                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                      <h4> <strong>Invoice Information</strong> </h4>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">ID:</span>
                      <span><?php echo $data['invoice_id'] ?></span>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">Issue Date:</span>
                      <span><?php echo $dl_name['created_at'] ?></span>
                    </div>

                    <div class="my-2">
                      <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                      <span class="text-600 text-90">Created By:</span>
                      <span><?php echo $dl_name['dlrName'] ?></span>
                    </div>

                  </div>
                </div>
                <!-- /.col -->
              </div>

              <div class="container table-responsive">
                <table class="table  table-borderless border-0 border-b-2 brc-default-l1 ">
                  <tr class="text-white btn-primary">
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Vat(%)</th>
                    <th>Sub Total</th>
                  </tr>

                  <?php
                  $i = 1;
                  $invoice_loop = $con->query('SELECT * from `customer_invoice` where invoice_id=' . $id);
                  while ($d = $invoice_loop->fetch_assoc()) {
                    $vO_totl = $d["price"] * $d["quantity"];
                    $vat = ($vO_totl * $d["vat"]) / 100;
                    $with_vat = $vO_totl + $vat;
                    $discount = ($with_vat * $d["discount"]) / 100;
                    $finalvalu = $with_vat - $discount;
                    $prod = $con->query('SELECT * from products where id=' . $d['product_id'])->fetch_array();
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $prod['name'] ?></td>
                      <td><?php echo $d['quantity'] ?></td>
                      <td><?php echo $d['price'] ?></td>
                      <td><?php echo $d['vat'] ?></td>
                      <td><?php echo $finalvalu ?></td>
                    </tr>
                  <?php $i += 1;
                  }  ?>
                </table>
              </div>

              <div class="row mt-3 container col-md-12">
                <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                </div>
                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                  <div class="row my-2">
                    <div class="col-7 text-right">
                      <strong>Discount(%): </strong>
                    </div>
                    <div class="col-5">
                      <span class="text-120 text-secondary-d1"></span> <span><?php echo $data['discount'] ?></span>
                    </div>
                  </div>

                  <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                    <div class="col-7 text-right">
                      <strong>Payable(TK.): </strong>
                    </div>
                    <div class="col-5">
                      <span class="text-150 text-success-d3 opacity-2"></span><span><?php echo $data['payable'] ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <hr />
              <!-- <div>
                <span class="text-secondary-d1 text-105">Thank you for your business</span>
                <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->

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
  <!-- jQuery -->
  <script src="../jquery-3.6.1.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <!-- Bootstrap 4 -->
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <!-- AdminLTE App -->

  <script src="../dist/js/adminlte.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->
  <script src="/jquery-3.6.1.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> -->

  <script type="text/javascript">
    function PrintDiv() {
      var divToPrint = document.getElementById('divToPrint');
      var popupWin = window.open('Invoice Create', '_blank', 'width=900, height=600');
      popupWin.document.open();
      popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
      popupWin.document.close();
    }
  </script>
</body>

</html>