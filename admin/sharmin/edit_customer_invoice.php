<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}
$id = $_GET['invoice_id'];
$con = new mysqli('localhost', 'root', '', 'crm');
$s_query = 'select * from customer_invoice where invoice_id=' . $id;
$qr = $con->query($s_query);


//for selected dealer id purpose--------------
$r_query = $con->query('select * from customer_invoice where invoice_id=' . $id);
$fdata = $r_query->fetch_assoc();

//date purpose----------------------
$qdata= $con->query('select * from customer_invoice where invoice_id=' . $id)->fetch_assoc();

// for admin id purpose----------
$a = $con->query('select * from admin');

// for product----------------
$d = $con->query('select * from products');
// for product----------------
$dm = $con->query('select * from customers');
$cdm = $dm->fetch_assoc();

//for invoice table product name purpose-----

// echo '<pre>';
// print_r($dk);
// exit;

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
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                  <h5 class="m-0">Edit Customer Invoice</h5>
                </div>
                <div class="card-body">

                <div class="card-body">
                <form action="update_customer_invoice.php?invoice_id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          
                          <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Customer Name: </label>
                            <select name="cusID" >
                              <option value="">Select Customer</option>
                              <?php while ($ap = $dm->fetch_assoc()) { ?>
                                <option value="<?php echo $ap['id'] ?>"><?php echo $ap['name'] ?></option>
                              <?php } ?>

                            </select>
                          </div> -->
                          <div class="form-group">
                            <label for="">Customer Name: </label>
                            <input type="text" name="" class="form-control" id="exampleInputEmail1" value="<?php echo $cdm['name'] ?>">
                            <input type="text" name="cusID" class="form-control" id="exampleInputEmail1"  hidden value="<?php echo $cdm['id'] ?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Product Name: </label>
                            <select name="proID" id="product" class="form-control">
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
                            <input type="datetime-local" name="created_at" class="form-control" id="exampleInputEmail1" value="<?php echo $qdata['created_at'] ?>">
                          </div>
                          <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Status</label><br>
                            <input type="radio" name="status" id="" value="active"> Active
                            <input type="radio" name="status" id="" value="InActive"> InActive
                          </div> -->
                              </div>
                          <div class="form-group" >
                            <table class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Price</th>
                                  <th>Qty</th>
                                  <th>Total</th>
                                  <th>Tax</th>
                                  <th>Sub Total</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody id="pd">
                              <?php
                              $i=0;
                              $sub = 0;
                              while ($data = $qr->fetch_assoc()) {
                                $i+=1;
                                $price =  $data['price'];
                                $quantity =  $data['quantity'];
                                $vat =  $data['vat'];
                                $discount = $data['discount'];

                                $total = $price * $quantity;
                                $sub += $data['payable'];
                                $dis_amount = $sub * $discount / 100;

                                $net_payable = $sub - $discount;

                                $dk = $con->query('select * from products where id ='.$data['product_id'])->fetch_array();
                              ?>
                                <tr id="rem_<?php echo $i ?>">
                                  <td><?php echo $dk['name']?></td>
                                  <td>
                                    <input type="text" class="form-control" id="m_<?php echo $i ?>" name="price[]" readonly  value="<?php echo $data['price'] ?>">
                                    <input type="hidden" class="form-control" id="pk_<?php echo $i ?>" name="pid[]" readonly value="<?php echo $data['product_id'] ?>">
                                  </td>

                                  <td>
                                    <input type="text" class="form-control" name="qID[]" id="q_<?php echo $i ?>" onkeyup="payable(<?php echo $i ?>)" value="<?php echo $data['quantity'] ?>">
                                  </td>
                                  <td>
                                    <input type="text" id="t_<?php echo $i ?>" name="tot" class="form-control" readonly value="<?php echo $data['total'] ?>">
                                  </td>
                                  <td>
                                    <input type="text" name="vat[]" id="tx_<?php echo $i ?>" class="form-control" value="<?php echo $data['vat'] ?>" onkeyup="payable(<?php echo $i ?>)">
                                  </td>
                                  <td><input type="text" id="p_<?php echo $i ?>" name="stotal[]" class="total form-control" readonly value="<?php echo $data['payable'] ?>">   
                   </td>
                   <td>
                   <button style="font-size:" id="r_<?php echo $i ?>" onclick="r_(<?php echo $i ?>)" value="" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i></button>
                   </td>

                   </tr>
                           
                           <?php } ?>           
                              </tbody>
                              <tbody>
                              <tr>
                              <th colspan="5">Grand Total</th>
                              <td id="gt" style="font-weight:bold"><?php echo $sub ?></td>
                            </tr>
                            <tr>
                              <th colspan="4">Discount (percentage & amount)</th>
                              <td><input type="text" id="dis" class="form-control" name="discount" value="<?php echo $discount ?>" onkeyup="payable()"></td>
                              <td id="adis" style="color:blue;"><?php echo $dis_amount ?></td>
                            </tr>
                            <tr>
                              <th colspan="5">Net Payable</th>
                              <td>
                                <input type="text" id="net" name="pable" class="form-control readonly value="<?php echo $net_payable ?>" style="font-weight:bold; font-size:20px;">
                              </td>
                            </tr>
                            <tr>
                              <th colspan="5">Paid Amount</th>
                              <td><input type="text" id="gt1" class="form-control" name="paid" value="0" onkeyup="payable()" style="color:green"></td>
                            </tr>

                            <tr>
                              <th colspan="5">Due</th>
                              <td id="gt2" style="color:red;" disabled></td>
                            </tr>

                              </tbody>
                            </table>


                          </div>
                          <!-- <div class="form-group" id="s_role">

                          </div> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1"></label>
                        <input type="submit" class="btn btn-primary btn-block" value="Update">
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
      let i = <?php echo $i ?>;
      $('#product').change(function() {
        let id = $(this).val()

        $.getJSON('fetch_data.php?id=' + id, function(data) {
          //first vul ekhane chiloh apnar, fetch_data.php diye j id ta pathiyechen oi file ta create na korle kaj hobe nah. r kore thakle amake oi file ta pathate vule gesen.
          let ht = `<tr  id="rem_${i}">
                      <td> ${data.name}</td>
                      <td >
                        <input type="text" id="m_${i}" name="price[]" readonly value="${data.dealer_price}" >
                        <input type="hidden" id="pk_${i}" name="pid[]" readonly value="${data.id}" >
                      </td>
                     
                      <td>
                        <input type="text" name="qID[]" id="q_${i}" onkeyup="payable(${i})" value="1" >
                      </td>
                      
                      <td >
                        <input type="text" id="t_${i}" name="tot" readonly value="${data.dealer_price}" >
                      </td>
                      <td>
                        <input type="text" name="vat[]" id="tx_${i}" value="0" onkeyup="payable(${i})" >
                      </td>
                      <td><input type="text" id="p_${i}" name="stotal[]" class="total" readonly value="${data.dealer_price}" >
                     <br>
                   
                      </td>

                      <td>
                      <button style="font-size:" id="r_${i}" onclick="r_(${i})" value="" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i></button>
                      </td>
                      
                 
                    </tr>`
          $('#pd').append(ht);

          //upore 4 no td te ekta function chalate hobe tax er jonno, jate tax input dile payable ta calculate hoy
          i += 1;
        })
      })
    });
    function r_(i) {
        $('#rem_' + i).remove()
      }

    function payable(d) {
      let price = $('#m_'+d).val();

      let qty = $('#q_'+d).val();

      let tax = $('#tx_'+d).val();

      let total = price * qty;
      $('#t_'+d).val(total);
      let subtotal = (total) + (total * tax) / 100;

      $('#p_'+d).val(subtotal);


      let gtotal = 0;

      //gtotal hisab korar jonno protita payable element er class same hote hobe. tai dekhben ht er moddhe 6 no td te id er pasha pashi ekta class dhore newa hoise. jeta dhore nicher function ta kaj kora hoise

      $('.total').each(function(e) {
        let v = parseInt($(this).val());
        gtotal += v;
      })
      $('#gt').text(gtotal);
      let discount = $('#dis').val()
      let amountDis = (gtotal * discount) / 100;
      $('#adis').text(amountDis);
      let ntotal = gtotal - amountDis;
      $('#net').val(ntotal)

      let paid = $('#gt1').val()
      let due = ntotal - paid
      $('#gt2').text(due)
    }
  </script>
</body>

</html>