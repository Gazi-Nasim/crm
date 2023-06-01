<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
};

$_SESSION["mnu"] = "payment";
$_SESSION["mnu_in"] = "crt-pmnt";

$con = new mysqli('localhost', 'root', '', 'crm');
$market_data = $con->query("SELECT `id`,`name` FROM `admin` where role='marketing'");
$dealer_data = $con->query("SELECT `id`,`name` FROM `admin` where role='dealer'");
$in_ro = "SELECT * FROM `payments` where `id`=".$_GET['id'];
$dataV = $con->query($in_ro)->fetch_assoc();

if (isset($_POST["market"])) {
  $market = $_POST["market"];
  $dealer = $_POST["dealer"];
  $amount = $_POST["amount"];
  $date = date("Y-m-d H:i:s");
  $query = "UPDATE `payments` SET `dealer_id` = '$dealer', `collected_by` = '$market', `amount` = '$amount' WHERE `payments`.`id` =".$_GET['id'];
  $con->query($query);
  header('Loation: ../tawhid/payment_insert.php');
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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Insert Dealer Payment</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="post">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Select Marketing Manager</label>
                      <select name="market" id="market_id" class="form-control">
                        <option value="">Select Marketing Manager</option>
                        <?php while ($data = $market_data->fetch_assoc()) { ?>
                          <option value="<?php echo $data['id'] ?>" <?php if($data['id']==$dataV['collected_by']){ echo 'selected' ;} ?> > <?php echo $data['name'] ?> ID: <?php echo $data['id'] ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Select Dealer</label>
                      <span id="deal">                        
                        <select name="dealer" id="" class="form-control">
                        <?php while ($data = $dealer_data->fetch_assoc()) { ?>
                          <option value="<?php echo $data['id']?>" <?php if($data['id']==$dataV['dealer_id']){ echo 'selected' ;} ?> ><?php echo $data['name']?></option>
                          <?php } ?>
                        </select>
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Payment Amount</label>
                      <input type="text" value='<?php echo $dataV['amount']?>' class="form-control" id="exampleInputEmail1" placeholder="Enter Payment Amount" name="amount">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer ">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                  </div>
                </form>
                

                <!-- /.card -->
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
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
    $(document).ready(function() {
      $('#market_id').change(function() {
        let market_id = $(this).val();
        $.ajax({
          type: "post",
          url: "get_dealer.php",
          data: {
            id: market_id
          },
          dataType: "",
          success: function(data) {
            $('#deal').html(data);
          }
        });

      });
    });
    $(function() {
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