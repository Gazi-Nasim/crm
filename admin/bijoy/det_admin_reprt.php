<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
if ($_SESSION['role']!='super'){
    header('Location: ../dashboard.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');
$id= $_GET['id'];

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

    <style>
        #chartdiv {
        width: 90%;
        height: 500px;
        }
    </style>
    <style>
        #chartpiediv {
        width: 90%;
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
                            <?php $ad_name=$con->query("select name from admin where id=$id")->fetch_assoc(); ?>
                            <h1 class="m-0"><?php echo $ad_name['name'] ?> Detailed Report</h1>
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
                        <div class="col-lg-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        
                                        <div class="com-md-7">
                                            <h4>Detailed Report Per Month</h4>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chartdiv"></div>
                                </div>
                            </div>
                        </div>
                        <!-- pie chart div starts-->
                        <div class="col-lg-4">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        
                                        <div class="com-md-7">
                                            <h4>Overall Report</h4>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chartpiediv"></div>
                                </div>
                            </div>
                        </div>
                        <!-- pie chart div ends-->
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                            <div class="card-header">
                                    <div class="row">
                                        
                                        <div class="com-md-7">
                                            <h4>Detailed Report</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Target Month</th>
                                                <th>Target Amount (TK)</th>
                                                <th>Actual Amount (TK)</th>
                                                <th>Achievement (%)</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Code to be implemented here -->
                                        <?php
                                            $target=$con->query("select target_month from admin_target where admin_id=$id ORDER BY target_month");
            
                                            while($tr=$target->fetch_assoc()){
                                                $collection=0;
                                                $bl=$con->query("select amount from admin_target where target_month LIKE '".$tr['target_month']."%'")->fetch_assoc();
                                                $mar=$con->query("select * from admin where parent=$id");
                                                while($m=$mar->fetch_assoc()){
                                                    $dl=$con->query("select * from admin where parent=".$m['id']);
                                                    while($d=$dl->fetch_assoc()){
                                                        $inv=$con->query("SELECT SUM(payable) AS payable FROM invoice WHERE dealer_id=".$d['id']." AND created_at LIKE '".$tr['target_month']."%'")->fetch_assoc();
                                                        
                                                        $collection+=$inv['payable'];
                                                    }
                                                }
                                            
                                        ?>
                                            <tr>
                                                <td><?php echo date('Y-F',strtotime($tr['target_month'])) ?></td>
                                                <td><?php echo number_format($bl['amount']) ?></td>
                                                <td><?php echo number_format($collection) ?></td></td>
                                                <td>
                                                    <?php 
                                                        if($bl['amount']>0){
                                                            echo number_format(($collection/$bl['amount'])*100,2); 
                                                        }else{
                                                            echo 0;
                                                        } 
                                                    ?>
                                                </td>
                                                
                                            
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <!-- <tr>
                                            <th colspan="3">Total</th>
                                            <th id="total_cal"></th>
                                        </tr> -->
                                    </table>
                                </div>
                                <hr>
                                <div class="card-footer">
                                    <div class="row">
                                        
                                        <div class="com-md-7">
                                            <a href="admin_report.php" class="btn btn-info" style="margin-left: 10px;">Back</a>
                                            
                                        </div>
                                    </div>
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

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
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
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "panX",
    wheelY: "zoomX",
    layout: root.verticalLayout
    }));


    // Add legend
    // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
    var legend = chart.children.push(
    am5.Legend.new(root, {
        centerX: am5.p50,
        x: am5.p50
    })
    );

    var data = [
        <?php
            $target=$con->query("select target_month from admin_target where admin_id=$id ORDER BY target_month");
            
            while($tr=$target->fetch_assoc()){
                $collection=0;
                $bl=$con->query("select amount from admin_target where target_month LIKE '".$tr['target_month']."%'")->fetch_assoc();
                $mar=$con->query("select * from admin where parent=$id");
                while($m=$mar->fetch_assoc()){
                    $dl=$con->query("select * from admin where parent=".$m['id']);
                    while($d=$dl->fetch_assoc()){
                        $inv=$con->query("SELECT SUM(payable) AS payable FROM invoice WHERE dealer_id=".$d['id']." AND created_at LIKE '".$tr['target_month']."%'")->fetch_assoc();
                        
                        $collection+=$inv['payable'];
                    }
                }
            
        ?>
    {
    "year": "<?php echo date('Y-M',strtotime($tr['target_month'])) ?>",
    "europe": <?php echo $bl['amount'] ?>,
    "namerica": <?php echo $collection ?>,
    },
    <?php } ?>
]


    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xRenderer = am5xy.AxisRendererX.new(root, {
    cellStartLocation: 0.1,
    cellEndLocation: 0.9
    })

    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
    categoryField: "year",
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root, {})
    }));

    xRenderer.grid.template.setAll({
    location: 1
    })

    xAxis.data.setAll(data);

    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    renderer: am5xy.AxisRendererY.new(root, {
        strokeOpacity: 0.1
    })
    }));


    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
    function makeSeries(name, fieldName) {
    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: name,
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: fieldName,
        categoryXField: "year"
    }));

    series.columns.template.setAll({
        tooltipText: "{name}, {categoryX}:{valueY}",
        width: am5.percent(90),
        tooltipY: 0,
        strokeOpacity: 0
    });

    series.data.setAll(data);

    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear();

    series.bullets.push(function() {
        return am5.Bullet.new(root, {
        locationY: 0,
        sprite: am5.Label.new(root, {
            text: "{valueY}",
            fill: root.interfaceColors.get("alternativeText"),
            centerY: 0,
            centerX: am5.p50,
            populateText: true
        })
        });
    });

    legend.data.push(series);
    }

    makeSeries("Target Amount", "europe");
    makeSeries("Actual Amount", "namerica");



    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    chart.appear(1000, 100);

    }); // end am5.ready()
    </script>


    <!-- Chart code -->
    <script>
        am5.ready(function() {

        // Create root and chart
        var root = am5.Root.new("chartpiediv");

        root.setThemes([
        am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push( 
        am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }) 
        );

        // Create series
        var series = chart.series.push(
        am5percent.PieSeries.new(root, {
            valueField: "percent",
            categoryField: "type",
            fillField: "color",
            alignLabels: false
        })
        );

        series.slices.template.set("templateField", "sliceSettings");
        series.labels.template.set("radius", 30);

        // Set up click events
        series.slices.template.events.on("click", function(event) {
        console.log(event.target.dataItem.dataContext)
        if (event.target.dataItem.dataContext.id != undefined) {
            selected = event.target.dataItem.dataContext.id;
        } else {
            selected = undefined;
        }
        series.data.setAll(generateChartData());
        });

        // Define data
        var selected;
        var types = [{
            <?php
                $target=$con->query("SELECT SUM(amount) AS amount FROM admin_target WHERE admin_id=$id");
                
                while($tr=$target->fetch_assoc()){
                    $collection=0;
                    $mar=$con->query("select * from admin where parent=$id");
                    while($m=$mar->fetch_assoc()){
                        $dl=$con->query("select * from admin where parent=".$m['id']);
                        while($d=$dl->fetch_assoc()){
                            $inv=$con->query("SELECT SUM(payable) AS payable FROM invoice WHERE dealer_id=".$d['id'])->fetch_assoc();
                            
                            $collection+=$inv['payable'];
                        }
                    }
            
            ?>
        type: "Total Target Amount",
        percent: <?php echo $tr['amount'] ?>,
        color: series.get("colors").getIndex(0),
        }, {
        type: "Total Received Amount",
        percent: <?php echo $collection ?>,
        color: series.get("colors").getIndex(1),
        <?php }?>
        }];
        series.data.setAll(generateChartData());


        function generateChartData() {
        var chartData = [];
        for (var i = 0; i < types.length; i++) {
            if (i == selected) {
            for (var x = 0; x < types[i].subs.length; x++) {
                chartData.push({
                type: types[i].subs[x].type,
                percent: types[i].subs[x].percent,
                color: types[i].color,
                pulled: true,
                sliceSettings: {
                    active: true
                }
                });
            }
            } else {
            chartData.push({
                type: types[i].type,
                percent: types[i].percent,
                color: types[i].color,
                id: i
            });
            }
        }
        return chartData;
        }

        }); // end am5.ready()
    </script>

</body>

</html>