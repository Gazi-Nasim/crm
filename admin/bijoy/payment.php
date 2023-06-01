<?php
session_start();

$_SESSION["mnu"]="payment";
$_SESSION["mnu_in"]="mr_pay";

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
// if ($_SESSION['role']!='super'){
//     header('Location: ../dashboard.php');
// }
$con = new mysqli('localhost', 'root', '', 'crm');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin| Marketing Payment</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.theme.min.css">
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
                            <h1 class="m-0">Payment Status</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- <h5 class="m-0">
                                                Payment status
                                            </h5> -->

                                        </div>
                                        <div class="com-md-7">
                                            <form action=""  class="form-inline">
                                                <select name="role_id" id="admin_select" class="form-control">
                                                    <option value="">Select Marketing manager</option>
                                                    <?php
                                                    $admin = $con->query("SELECT * FROM admin WHERE role='marketing'");
                                                    while ($ad = $admin->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?php echo $ad['id'] ?>"><?php echo $ad['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>&nbsp;
                                                <label for="from" style="margin-right: 10px;">From</label>
                                                <input type="date" id="from" name="from" class="form-control">
                                                <label for="to" style="margin-left:10px;margin-right: 10px">To</label>
                                                <input type="date" id="to" name="to" class="form-control">
                                                <input type="button" id="dt_search" value="Search" class="btn btn-info" style="margin-left: 10px;">
                                                <a href="./payment.php" class="btn btn-outline-info" style="margin-left: 10px;">Back</a>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Payment Date</th>
                                                <th>Dealer Name</th>
                                                <th>Collected By</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mrk_data">
                                        <!-- Code to be implemented here -->
                                        </tbody>
                                        <!-- <tr>
                                            <th colspan="3">Total</th>
                                            <th id="total_cal"></th>
                                        </tr> -->
                                    </table>
                                </div>
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
        <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          Developed By A.K.M. Nazmul Hasan
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">IsDB-BISEW</a>.</strong> All rights reserved.
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
    <script src="./jquery-3.6.1.min.js"></script>
    <script src="./jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#admin_select').change(function() {
                var adminID = $(this).val();
                $.ajax({
                    url: 'get_payment.php',
                    method: 'post',
                    data: {
                        id: adminID
                    },
                    success: function(data) {
                        $('#mrk_data').html(data)
                    }
                })
            })


            $('#dt_search').click(function(){
                var adminID = $('#admin_select').val();
                var from_date= $('#from').val();
                var to_date= $('#to').val();
                $.ajax({
                    url: 'pay_date_srch.php',
                    method: 'post',
                    data: {
                        id: adminID,
                        from: from_date,
                        to: to_date
                    },
                    success: function(data) {
                        $('#mrk_data').html(data)
                        
                    }
                })
            })

            
        })
    </script>

</body>

</html>