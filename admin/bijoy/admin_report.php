<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
if ($_SESSION['role']!='super'){
    header('Location: ../dashboard.php');
}

$_SESSION["mnu"]="report";
$_SESSION["mnu_in"]="amnTrgt_bjy";

$con = new mysqli('localhost', 'root', '', 'crm');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin| Admin Report</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="../cstmStyle/style.css">

    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>
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
                            <h1 class="m-0">
                                Admin Report of <?php $month=date('Y-F');
                                if(isset($_POST['month'])){
                                    $mn=$_POST['month'];
                                    $month=date('Y-F',strtotime($mn));
                                    echo $month;
                                }else{
                                    echo $month;
                                } ?>
                            </h1>
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
                    <!-- pie chart div starts-->
                    
                    <!-- pie chart div ends-->
                    <div class="row">
                        <!-- /.col-md-6 -->
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        
                                        <div class="com-md-7">
                                            <form action=""  class="form-inline" method="post">
                                                
                                                <input type="date" id="" name="month" class="form-control">

                                                <input type="Submit" id="dt_search" value="Search" class="btn btn-info" style="margin-left: 10px;">
                                                
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Admin Name</th>
                                                <th>Target Amount (TK)</th>
                                                <th>Actual Amount (TK)</th>
                                                <th>Achievement (%)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mrk_data">
                                        <!-- Code to be implemented here -->
                                        <?php
                                            $month=date('Y-m');
                                            if(isset($_POST['month'])){
                                                $mn=$_POST['month'];
                                                $month=date('Y-m',strtotime($mn));
                                            }
                                            
                                            $ad_id=$con->query("SELECT * From admin where role='admin'");
                                            while($d=$ad_id->fetch_assoc()){
                                                $collection=0;
                                                
                                                
                                               $b_data=$con->query("SELECT amount FROM `admin_target` WHERE admin_id=".$d['id']." AND target_month='".$month."'") ->fetch_assoc();
                                               $m_data=$con->query("SELECT * FROM `admin` WHERE parent=".$d['id']);
                                               while($mr=$m_data->fetch_assoc()){
                                                $d_id=$con->query("SELECT * FROM `admin` WHERE parent=".$mr['id']);
                                                while($dl=$d_id->fetch_assoc()){
                                                    $actual=$con->query("SELECT SUM(payable) AS actual FROM `invoice` WHERE dealer_id=".$dl['id']." AND created_at LIKE '".$month."%'")->fetch_assoc();
                                                    $collection+=$actual['actual'];
                                                }
                                               }

                                                ?>
                                                <tr>
                                                <td><?php echo $d['name'] ?></td>
                                                <td>
                                                    <?php echo (isset($b_data['amount'])? number_format($b_data['amount']):0)?>
                                                </td>
                                                <td><?php echo number_format($collection) ?></td>
                                                <td>
                                                    <?php
                                                        if(isset($b_data['amount'])){
                                                            if($b_data['amount']>0){
                                                                echo number_format(($collection/$b_data['amount'])*100); 
                                                            }else{
                                                                echo 0;
                                                            }
                                                        }else{
                                                            echo 0;
                                                        }
                                                    ?>

                                                    
                                                </td>
                                                <td>
                                                    <a href="det_admin_reprt.php?id=<?php echo $d['id'] ?>" class="btn btn-outline-info" style="margin-left: 10px;">Details</a>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                        ?>
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
                    url: 'get_admin_report.php',
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

            // $('.total').each(function(e){
            //     let v=parseInt($(this).text());
            //     payTotal +=v;
            // })
            // console.log(payTotal);
            // $('#total_cal').text(payTotal);
            
        })
    </script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    

</body>

</html>