<?php
session_start();

$_SESSION["mnu"]="payment";
$_SESSION["mnu_in"]="nas_ad_pay";

if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

$db = new mysqli('localhost', 'root', '', 'crm');
$query = ("SELECT * from `admin` where `role`='admin'");
$result = $db->query($query);
$result_1 = $db->query($query);

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
              <h1 class="m-0">Payments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item active"></li>
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
                  <h5 class="m-0"></h5>
                </div>
                <div class="card-body">
                  <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group">
                        <table class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th>Admin Name</th>
                              <th class="text-end">Amount</th>
                              <th class="text-end">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($dt = $result_1->fetch_assoc()) {
                              $query = ("SELECT * from `admin` where `admin`.`parent`=" . $dt["id"]);
                              $mr_dta = $db->query($query);
                              $mr_id = [];
                              while ($d = $mr_dta->fetch_assoc()) {
                                $mr_id[] = $d["id"];
                              }
                              $mrid_str = implode("," , $mr_id);

                              $dlr_dta = $db->query("SELECT * from `payments` where `payments`.`collected_by` IN ($mrid_str)");
                              $amount = 0;
                              while ($amnt = $dlr_dta->fetch_assoc()) {
                                $amount += $amnt["amount"];
                              }

                            ?>
                              <tr>
                                <td><?php echo $dt['name'] ?></td>
                                <td><strong class="align-middle"> <?php echo $amount ?></strong> </td>
                                <td><button value="<?php echo $dt['id'] ?>" class='btn btn-outline-primary admin_s'>Details</button></td>
                              </tr>
                            <?php  } ?>
                          </tbody>
                        </table>
                      </div>
                      <span id="mrting_man">

                      </span>
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

    <script>
      $(document).ready(function() {
        $(".admin_s").click(function() {
          let a_rle = $(this).val();
          if (a_rle != "") {
            $.ajax({
              url: "get_mrketing.php",
              method: "get",
              data: {
                admn_id: a_rle
              },
              success: (function(dta) {
                $("#mrting_man").html(dta);
              })
            })
          }
        })

        $(document).on("click", "#src_date", function() {
          let from = $("#from").val();
          let to = $("#to").val();
          console.log(from,to);
          $.ajax({
            url: "payment_date_wise.php",
            method: "get",
            data: {
              from: from,
              to: to,
            },
            success: function(s) {
              $("#mrting_man").html(s);
            }
          })

        })

      })
    </script>
</body>

</html>