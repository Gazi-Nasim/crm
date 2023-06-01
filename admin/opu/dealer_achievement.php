<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

$_SESSION["mnu"] = "report";
$_SESSION["mnu_in"] = "dlr_acvmnt";

$con = new mysqli('localhost', 'root', '', 'crm');


//----------query for date wise serach----------

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
                            <h1 class="m-0">Dealer Achievement</h1>
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
                                        <div class="col-md-8">
                                            <h5 class="m-0">
                                                Dealer Target Achievement Report
                                            </h5>

                                        </div>
                                        <div class="com-md-4">
                                            <form action="" method="post" class="form-inline">

                                                <label for="from" style="margin-right: 10px;">Select Month</label>
                                                <input type="date" name="month" id="">
                                                <input type="submit" value="Search">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Dealer Name</th>
                                                <th>Month</th>
                                                <th>Target Amount</th>
                                                <th>Actual Sale</th>
                                                <th>Achievement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dealer_data">
                                            <!-- Code to be implemented here -->
                                            <?php
                                            $month = date('Y-m-d');
                                            if (isset($_POST['month'])) {
                                                $mn = $_POST['month'];
                                                $month = date('Y-m-d', strtotime($mn));
                                            }
                                            // var_dump($month);
                                            $dealer = $con->query("SELECT * FROM `admin` WHERE `parent`=" . $_SESSION['id']);
                                            while ($dl = $dealer->fetch_assoc()) {
                                                // var_dump($dl);
                                                $target = $con->query("SELECT * FROM `dealer_target` WHERE admin_id=" . $dl['id'] . " AND `target_month`='" . $month . "'")->fetch_assoc();
                                                $invoice = $con->query("SELECT SUM(payable) AS payable FROM `invoice` WHERE dealer_id=" . $dl['id'] . " AND created_at LIKE '" . $month . "%'")->fetch_assoc();

                                            ?>
                                                <tr>
                                                    <td><?php echo $dl['name'] ?></td>
                                                    <td><?php  if(!isset($target['target_month'])){echo '0';}else{ echo $target['target_month'];} ?> </td>
                                                    <td><?php  if(!isset($target['amount'])){echo '0';}else{ echo $target['amount'];} ?></td>
                                                    <td><?php  if(!isset($target['payable'])){echo '0';}else{ echo $target['payable'];} ?></td>
                                                    <td>
                                                        
                                                        <?php 
                                                            if(!isset($invoice['payable'])){
                                                                echo '0';
                                                            }
                                                            else{
                                                                $hulu=($invoice['payable']  / $target['amount'] )*100 ;
                                                                
                                                                echo $hulu;
                                                            } 
                                                        ?>
                                                    </td>
                                                    <td><a href="dealer_details.php?id=<?php echo $dl['id'] ?>" class="btn btn-success">Details</a></td>
                                                </tr>
                                            <?php } ?>
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
    <script src="../plugins/j"></script>
    <!-- apni apnar directory wise ekhane path change kore niben -->

    <!-- Bootstrap 4 -->

    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- apni apnar directory wise ekhane path change kore niben -->

    <!-- AdminLTE App -->

    <script src="../dist/js/adminlte.min.js"></script>
    <!-- apni apnar directory wise ekhane path change kore niben -->

    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- apni apnar directory wise ekhane path change kore niben -->

    <script>
        $(document).ready(function() {
            $('#dt_search').click(function() {
                var dealerID = $('#dealer_select').val();
                var from_date = $('#from').val();
                var to_date = $('#to').val();
                $.ajax({
                    url: 'date_search.php',
                    method: 'post',
                    data: {
                        id: dealerID,
                        from: from_date,
                        to: to_date
                    },
                    success: function(data) {
                        $('#dealer_data').html(data)

                    }
                })
            })


            //     // $('.total').each(function(e){
            //     //     let v=parseInt($(this).text());
            //     //     payTotal +=v;
            //     // })
            //     // console.log(payTotal);
            //     // $('#total_cal').text(payTotal);


        })
    </script>


    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
</body>

</html>