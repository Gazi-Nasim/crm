<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

$_SESSION["mnu"] = "invoice";
$_SESSION["mnu_f"] = "o";
$_SESSION["mnu_in"] = "crt_payable";

$con = new mysqli('localhost', 'root', '', 'crm');
$d = $con->query('SELECT * from products');
$dlr = $con->query("SELECT * from `admin` where `admin`.`id`='" . $_SESSION["id"] . "'");
$custo = $con->query("SELECT * from `customers` where `customers`.`dealer_id`='" . $_SESSION["id"] . "'");
$cr = $con->query('SELECT * from admin');

if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}
$start = ($page - 1) * 5;


$in_ro = "SELECT * FROM `customer_invoice` GROUP BY `invoice_id` order by id desc limit $start,5 ";
$dataV = $con->query($in_ro);

$in_ros = $con->query("SELECT * FROM `customer_invoice` GROUP BY `invoice_id` order by id desc");
$rows = mysqli_num_rows($in_ros);
$totl_pages = ceil($rows / 5);
// var_dump($totl_pages);

if (isset($_POST['proID'])) {
  $dealer_id = $_SESSION["id"];
  $customer_id = $_POST["customer_id"];
  $type = "taxable";
  $s = $con->query("SELECT max(invoice_id) as i from `customer_invoice`")->fetch_assoc();
  $invID = $s['i'] + 1;
  $proID = $_POST['proID'];
  $price = $_POST['prices'];
  $qID = $_POST['qnttys'];
  $total = $_POST['totls'];
  $vat = $_POST['vats'];
  $discount = $_POST['discount'];
  $pable = $_POST["paid"];
  $create_at = $_POST['created_at'];
  // var_dump($create_at);
  $created_by = $_SESSION['id'];

  foreach ($qID as $indx => $qIDs) {
    $s_prID = $proID[$indx];
    $s_qID = $qIDs;
    $s_vat = $vat[$indx];
    $s_price = $price[$indx];
    $s_total = $total[$indx];

    echo $query = ("INSERT INTO
     `customer_invoice` (`id`, `dealer_id`, `customer_id`, `type`, `invoice_id`,`product_id`, `price`, `quantity`, `total`, `vat`, `discount`, `payable`, `created_at`, `created_by`) VALUES
      (NULL, " . $dealer_id . ", " . $customer_id . ", '" . $type . "', " . $invID . ", " . $s_prID . ", " . $s_price . ", " . $s_qID . ", " . $s_total . ", " . $s_vat . ", " . $discount . ", " . $pable . ", '" . $create_at . "', " . $created_by . ")");;

    $con->query($query);
  }

  header('Location: crt_cstmar_invoice.php');
};
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
              <h1 class="m-0">Invoice Page</h1>
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
                  <h5 class="m-0">Create Invoice</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row">
                        <div class=" row col-12">
                          <div class="col-6">

                            <div class="form-group">
                              <label for="exampleInputEmail1">customer Name: </label>
                              <select name="customer_id" id="cust" required class="form-control">
                                <option value="">Select Name</option>
                                <?php while ($p = $custo->fetch_assoc()) { ?>
                                  <option value="<?php echo $p['ID'] ?>"><?php echo $p['name'] ?></option>
                                <?php } ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Product Name: </label>
                              <select name="proID" id="prdct" required class="form-control">
                                <option value="">Select product</option>
                                <?php while ($p = $d->fetch_assoc()) { ?>
                                  <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-6">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Date: </label>
                              <input type="datetime-local" name="created_at" class="form-control" id="exampleInputEmail1" required placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <table class="table table-bordered table-responsive ">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Tax</th>
                                <th>Sub Total</th>
                              </tr>
                            </thead>

                            <tbody id="pd">
                              <!--ht code goes here-->

                            </tbody>
                            <tr>
                              <th colspan="5">Grand Total</th>
                              <td id="gt" style="font-weight:bold"></td>
                            </tr>
                            <tr>
                              <th colspan="4">Discount (percentage & amount)</th>
                              <td>
                                <input type="text" id="dis" onkeyup="quanty()" class="form-control" name="discount" value="0">
                              </td>
                              <td>
                                <h2>
                                  <input type="text" id="adis" class="form-control" style="color:blue; font-weight:bold; font-size:20px;" readonly>
                                </h2>
                              </td>
                            </tr>
                            <tr>
                              <th colspan="5">Net Payable</th>
                              <td>
                                <input type="text" class="form-control" id="net" name="paid" readonly value="" style="font-weight:bold; font-size:20px;">
                              </td>
                            </tr>
                            <tr>
                              <th colspan="5">Paid Amount</th>
                              <td><input type="text" onkeyup="quanty()" required class="form-control" id="pa_amt" name="" value="" style="color:green"></td>
                            </tr>

                            <tr>
                              <th colspan="5">Rest/Change</th>
                              <td style="color:red;">
                                <strong>
                                  <h5 id="rst"> </h5>
                                </strong>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="">
                        <div class="form-group">
                          <label for="exampleInputEmail1"></label>
                          <input type="submit" class="btn btn-primary btn-block" value="Save">
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
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Invoice List</h5>
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>customer Name</th>
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
                ?>
                  <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $cntmr_name['name'] ?></td>
                    <td><?php echo $d['invoice_id'] ?></td>
                    <td><?php echo $d['vat'] ?></td>
                    <td><?php echo $d['discount'] ?></td>
                    <td><?php echo $d['created_at'] ?></td>
                    <td><?php echo $d['payable'] ?></td>
                    <td>
                      <a href="edit_cstmr_invoice.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-success btn-xs"> <i class="fa fa-edit" aria-hidden="true"></i></a>
                      <a href="invoice_details.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      <a href="del_invoice.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                <?php $sl++;
                } ?>
              </tbody>
            </table>
            <?php

            if ($page > 1) {

              echo "<a href='crt_cstmr_invoice.php?page=" . ($page - 1) . "' class='btn  btn-primary find_page'> << </a>";
            }

            for ($n = 1; $n < $totl_pages; $n++) {
              echo "<a href='crt_cstmr_invoice.php?page=" . ($n) . "' class='btn find_page btn-primary'> " . ($n) . "</a>";
            }

            if ($n > $page) {
              echo "<a href='crt_cstmr_invoice.php?page=" . ($page + 1) . "' class='btn  btn-primary find_page'> >> </a>";
            }

            ?>

          </div>

        </div>
      </div>
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
  <script src="../jquery-3.6.1.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

  <script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- apni apnar directory wise ekhane path change kore niben -->

</body>



</html>
<script>
  $(document).ready(function() {
    i = 1;
    grndtotl = 0;
    $("#prdct").change(function() {
      let ids = $(this).val();
      $.getJSON("fetch_data.php?id=" + ids, function(data) {
        let vlu = `<tr id="del${i}">
                      <td> ${data.name}
                        <input type="hidden" name="proID[]"class="form-control" readonly value="${data.id}" >
                      </td>
                      <td >
                        <input type="text" name="prices[]"class="form-control" id="priceC${i}" readonly value="${data.dealer_price}" >
                        
                      </td>                     
                      <td>
                        <input type="text" name="qnttys[]" onkeyup="quanty(${i})" id="qntyC${i}" class="form-control" required value="1" >
                      </td>
                      <td >
                        <input type="text" name="totls[]" class="form-control" id="totlC${i}" readonly value="${data.dealer_price}" >
                      </td>
                      <td>
                        <input type="text" name="vats[]" required class="form-control" onkeyup="quanty(${i})" id="txC${i}" value="" >
                      </td>
                      <td>
                        <input type="text"  class="form-control ftotl" id="subtl${i}" readonly value="${data.dealer_price}" >
                      </td>
                      <td>
                        <a href="jvascript:void(0)" onclick="delta(${i})"  id="delta${i}" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>`
        $("#pd").append(vlu);
        i += 1;
        $(".ftotl").each(function(f) {
          let stla = parseInt($(this).val());
          grndtotl = grndtotl + stla;
        })
        $("#gt").text(grndtotl);

      })
    })
  })


  function quanty(d) {
    let p = $("#priceC" + d).val();
    let q = $("#qntyC" + d).val();
    let tx = $("#txC" + d).val();
    $("#totlC" + d).val(p * q);
    let t = (p * q * tx) / 100;
    let stotl = p * q + t;
    $("#subtl" + d).val(stotl);

    grndtotl = 0;
    $(".ftotl").each(function(f) {
      let stla = parseInt($(this).val());
      grndtotl = grndtotl + stla;
    })
    $("#gt").text(grndtotl);

    let dscnt = $("#dis").val();
    let ds = (grndtotl * dscnt) / 100;
    $("#adis").val(ds);
    let net = grndtotl - ds;
    $("#net").val(net);
    let paidd = $("#pa_amt").val();
    $("#rst").text(net - paidd);

  }

  function delta(de) {
    $("#del" + de).remove();
  }
</script>