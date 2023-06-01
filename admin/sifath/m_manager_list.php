<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
// if ($_SESSION['role']!='admin'){
//     header('Location: ../dashboard.php');
// }

$_SESSION["mnu"]="report";
$_SESSION["mnu_in"]="mngr_lst_sft";

$con = new mysqli('localhost', 'root', '', 'crm');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MM| Marketing Manager Report</title>

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
                            <h1 class="m-0">Marketing Manager Report of
                                <?php $month=date('Y-m');
                                if(isset($_POST['month'])){
                                    $mnth=$_POST['month'];
                                    echo date('F, Y', strtotime($mnth));
                                }else{
                                    echo date('F, Y', strtotime($month));
                                }
                                ?>
                            </h1>
                            <h2></h2>
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
                                        <!-- <div class="col-md-4">
                                           

                                        
                                        </div> -->

                            <div class="com-md-7">
                                <form action=""  class="form-inline" method="post">
                                    <select name="month" id="" class="form-control">
                                        <option value="">Select Month</option>
                                        <option value="2022-08">August,2022</option>
                                        <option value="2022-09">September,2022</option>
                                        <option value="2022-10">October,2022</option>
                                        <option value="2022-11">November,2022</option>
                                    </select>                                   
                                    <input type="Submit" id="dt_search" value="Search" class="btn btn-info" style="margin-left: 10px;">
                                </form>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Marketing Manager</th>
                                        <th>Targeted Amount</th>
                                        <th>Actual Amount</th>
                                        <th>Achievement(%)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            <tbody id="pd">
                                <?php 
                                    $month=date('Y-m');
                                    if(isset($_POST['month'])){
                                        $month= $_POST['month'];
                                    }
                                    $mar_id= $con->query("select * from admin where role='marketing' limit 2");                                   
                                    while($d=$mar_id->fetch_assoc()){
                                        $collection=0;
                                  
                                        $t_data=$con->query("select amount from marketing_target where admin_id=".$d['id']." and target_month='".$month."'")->fetch_assoc();
                                      $m_data=$con->query("SELECT * FROM `admin` WHERE parent=".$d['id']);
                                        while($mrk=$m_data->fetch_assoc()){
                                            $dl_data=$con->query("SELECT SUM(payable) AS actual FROM invoice WHERE dealer_id=".$mrk['id']." AND created_at LIKE '".$month."%'");
                                            while($b=$dl_data->fetch_assoc()){
                                                $collection+=$b['actual'];
                                            }
                                        }
                                    ?> 
                                    <tr>
                                        <td><?php echo $d['name'] ?></td>
                                        <td>
                                            <?php if(isset($t_data['amount'])){
                                            echo $t_data['amount'];
                                            }else{
                                                echo 0;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if(isset($collection)){
                                            echo $collection;
                                            }else{
                                                echo 0;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            if(isset($t_data['amount'])){
                                                if($t_data['amount']>0){
                                                    echo number_format(($collection/$t_data['amount'])*100,2).'%';
                                                    }else{
                                                        echo 0;
                                                    }
                                            }

                                            ?>
                                        </td>
                                        
                                        <td><a href="m_manager_details.php?id=<?php echo $d['id']?>" class="btn btn-success">Details</a></td>
                                    
                                    <?php
                                    }
                                ?>
                            </tbody>
                          </table>


                          <style>
#chartdiv {
  width: 100%;
  height: 150px;
}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  layout: root.verticalLayout
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  valueField: "value",
  categoryField: "category"
}));


// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll([
  { value: <?php echo $percent ?>, category: "Complete" },
  { value: <?php echo $rem ?>, category: "Not Achieved" },

]);


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);

}); // end am5.ready()
</script>

<!-- HTML -->
<!-- <div id="chartdiv"></div> -->


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
          Developed By Shifat Hossain Khan
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

</body>

</html>

    <script>
        $(document).ready(function() {
            $('#mm').change(function() {
                var adminID = $(this).val();
                $.ajax({
                    url: 'marketing_fetch.php',
                    method: 'post',
                    data: {
                        id: adminID
                    },
                    success: function(data) {
                        $('#pd').html(data)
                    }
                })
            })

            
        })
    </script>



