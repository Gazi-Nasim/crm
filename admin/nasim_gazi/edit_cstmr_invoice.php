<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

$invoice_id = $_GET['invoice_id'];
$con = new mysqli('localhost', 'root', '', 'crm');
$s_query = 'SELECT * from `customer_invoice` where invoice_id=' . $invoice_id;
$qr = $con->query($s_query);


//for SELECTed dealer id purpose--------------
$r_query = $con->query('SELECT * from `customer_invoice` where invoice_id=' . $invoice_id);
$fdata = $r_query->fetch_assoc();

//date purpose----------------------
$qdata = $con->query('SELECT * from `customer_invoice` where invoice_id=' . $invoice_id)->fetch_assoc();

$cstmr = $con->query('SELECT * from `customers` where `customers`.`dealer_id`=' . $fdata['dealer_id'])->fetch_assoc();

// for product----------------
$d = $con->query('SELECT * from `products`');

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
                  <h5 class="m-0">Edit Admin</h5>
                </div>
                <form action="update_cstmr_invoice.php?invoice_id=<?php echo $invoice_id ?>" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Customar Name: </label>
                          <select class="form-control" name="customar_id">
                            <option value="<?php echo $cstmr['id'] ?>"> <?php echo $cstmr['name'] ?></option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Name: </label>
                          <select name="proID" class="form-control" id="product">
                            <option value="">Select product</option>
                            <?php while ($p = $d->fetch_assoc()) { ?>
                              <option class="form-control" value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                            <?php } ?>

                          </select>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Date: </label>
                          <input type="datetime-local" class="form-control" name="created_at" class="form-control" id="exampleInputEmail1" value="<?php echo $qdata['created_at'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <table class="table table-bordered ">
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
                            <?php
                            $i = 0;
                            $sub = 0;
                            while ($data = $qr->fetch_assoc()) {
                              // var_dump($data);
                              $i += 1;
                              $price =  $data['price'];
                              $quantity =  $data['quantity'];
                              $total = $price * $quantity;
                              $vat = $data['vat'];
                              $var_vlu = ($total * $vat) / 100;
                              $stotal_ = $total + $var_vlu;
                              $discount = $data['discount'];
                              $sub += $stotal_;
                              $dis_amount = $sub * $discount / 100;
                              $net_payable = $sub - $discount;
                              $dk = $con->query('SELECT * from `products` where `id` =' . $data['product_id'])->fetch_array();
                            ?>
                              <tr id="del<?php echo $i ?>">
                                <td>
                                  <?php echo $dk['name'] ?>
                                </td>
                                <td>
                                  <input type="text" class="form-control " id="m_<?php echo $i ?>" name="prices[]" readonly value="<?php echo $data['price'] ?>">
                                  <input type="hidden" class="form-control " id="pk_<?php echo $i ?>" name="proID[]" readonly value="<?php echo $data['product_id'] ?>">
                                </td>
                                <td>
                                  <input type="text" class="form-control " name="qnttys[]" id="q_<?php echo $i ?>" onkeyup="quanty(<?php echo $i ?>)" value="<?php echo $data['quantity'] ?>">
                                </td>
                                <td>
                                  <input type="text" class="form-control " id="t_<?php echo $i ?>" name="totls[]" readonly value="<?php echo $data['total'] ?>">
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="vats[]" id="tx_<?php echo $i ?>" value="<?php echo $data['vat'] ?>" onkeyup="quanty(<?php echo $i ?>)">
                                </td>
                                <td>
                                  <input type="text" class="form-control ftotl" id="stl_<?php echo $i ?>" name="stotal[]" readonly value="<?php echo $stotal_ ?>">
                                </td>
                                <td>
                                  <a href="jvascript:void(0)" class="btn btn-xs btn-danger" onclick="delta(<?php echo $i ?>)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                          <tr>
                            <th colspan="5">Grand Total</th>
                            <td id="gt" style="font-weight:bold"><?php echo $sub ?></td>
                          </tr>
                          <tr>
                            <th colspan="4">Discount (percentage & amount)</th>
                            <td>
                              <input type="text" class="form-control" id="dis" class="form-control" name="discount" value="<?php echo $discount ?>" onkeyup="quanty()">
                            </td>
                            <td>
                              <input id="adisV" type="text" class="form-control" style="color:blue;" value="<?php echo $dis_amount ?>">
                            </td>
                          </tr>
                          <tr>
                            <th colspan="5">Net Payable</th>
                            <td>
                              <input type="text" class="form-control" id="net" name="paid" readonly value="<?php echo $net_payable ?>" style="font-weight:bold; font-size:20px;">
                            </td>
                          </tr>
                          <tr>
                            <th colspan="5">Paid Amount</th>
                            <td><input type="number" required id="pa_amt" class="form-control" name="" value="" onkeyup="quanty()" style="color:green"></td>
                          </tr>

                          <tr>
                            <th colspan="5">Rest/Change</th>
                            <td>
                              <strong>
                                <h5>
                                  <strong><input style="font-weight:bold; font-size:18px; color:red;" id="rst" type="text" class="form-control"></strong>
                                </h5>
                              </strong>
                            </td>
                          </tr>
                        </table>

                        <div class="">
                          <div class="form-group">
                            <label for="exampleInputEmail1"></label>
                            <input type="submit" class="btn btn-primary btn-block" value="Update">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                </form>

              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->

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

  <script>
    $(document).ready(function() {
      let i = <?php echo $i ?>+1;
      $('#product').change(function() {
        let id = $(this).val();

        $.getJSON('fetch_data.php?id=' + id, function(data) {
          //first vul ekhane chiloh apnar, fetch_data.php diye j id ta pathiyechen oi file ta create na korle kaj hobe nah. r kore thakle amake oi file ta pathate vule gesen.
          let ht = `<tr id="del${i}">
                      <td> ${data.name}
                        <input type="hidden" name="proID[]" class="form-control" readonly value="${data.id}" >
                      </td>
                      <td >
                        <input type="text" name="prices[]" class="form-control" id="priceC${i}" readonly value="${data.dealer_price}" >
                      </td>                     
                      <td>
                        <input type="text" name="qnttys[]" onkeyup="quanty(${i})" id="qntyC${i}" class="form-control" value="1" >
                      </td>
                      <td >
                        <input type="text" name="totls[]" class="form-control" id="totlC${i}" readonly value="${data.dealer_price}" >
                      </td>
                      <td>
                        <input type="text" name="vats[]" class="form-control" onkeyup="quanty(${i})" id="txC${i}" value="0"" >
                      </td>
                      <td>
                        <input type="text"  class="form-control ftotl" name="stotal[]" id="subtl${i}" readonly value="${data.dealer_price}" >
                      </td>
                      <td>
                        <a href="jvascript:void(0)" onclick="delta(${i})" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>`
          $('#pd').append(ht);

          //upore 4 no td te ekta function chalate hobe tax er jonno, jate tax input dile payable ta calculate hoy
          i += 1;
          grndtotl = 0;
          $(".ftotl").each(function(f) {
            let stla = parseInt($(this).val());
            grndtotl = grndtotl + stla;
          })
          $("#gt").text(grndtotl);

          let dscnt = $("#dis").val();
          let ds = (grndtotl * dscnt) / 100;
          $("#adisV").val(ds);
          let net = grndtotl - ds;
          $("#net").val(net);
        })
      })

    });

    function delta(de) {
      $("#del" + de).remove();
    }


    function quanty(d) {

      let m_v = $("#m_" + d).val();
      let q_v = $("#q_" + d).val();
      let total_v = m_v * q_v;
      $("#t_" + d).val(total_v);
      let tx_v = $("#tx_" + d).val();
      let ftx_v = (total_v * tx_v) / 100;
      $("#stl_" + d).val(ftx_v + total_v);

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
      $("#adisV").val(ds);

      let net = grndtotl - ds;
      $("#net").val(net);
      let paidd = $("#pa_amt").val();
      $("#rst").val(net - paidd);

    }
  </script>
</body>

</html>