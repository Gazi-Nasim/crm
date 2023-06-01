<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');
$id = $_GET['id'];


//----------query for date wise serach----------

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin| Dealer Target</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- apni apnar directory wise ekhane path change kore niben -->
    <link rel="stylesheet" href="../cstmStyle/style.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="./jquery-ui-1.13.2.custom/jquery-ui.theme.min.css">

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
                            <?php
                            $dl_name = $con->query("select name from admin where id=" . $id)->fetch_assoc();
                            ?>
                            <h1 class="m-0"><?php echo $dl_name['name'] ?> Detailed Report</h1>
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
                                                Target VS Achievement
                                            </h5>

                                        </div>
                                        <div class="com-md-4">
                                            <form action="" method="post" class="form-inline">

                                                <!-- <label for="from" style="margin-right: 10px;">Select Dealer</label>
                                                <input type="date" name="month" id="">
                                                <input type="submit" value="Search"> -->
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Months</th>
                                                <th>Target Amount</th>
                                                <th>Actual Sale</th>
                                                <th>Achievement</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dealer_data">
                                            <?php
                                            $mon = $con->query("SELECT * FROM `dealer_target` WHERE dealer_target.admin_id=" . $id);
                                            $act = 0;
                                            while ($mn = $mon->fetch_assoc()) {
                                                $actual = $con->query("SELECT SUM(payable) AS payable FROM `invoice` WHERE dealer_id=" . $id . " AND created_at LIKE '" . $mn['target_month'] . "%'");
                                                while ($a = $actual->fetch_assoc()) {
                                                    $act = $a['payable'];
                                                }
                                            ?>
                                                <tr>
                                                    <td><?php echo $mn['target_month'] ?></td>
                                                    <td><?php echo $mn['amount'] ?></td>
                                                    <td><?php echo $act ?></td>
                                                    <td><?php echo (($act / $mn['amount']) * 100) ?></td>
                                                </tr>
                                            <?php }

                                            ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="m-0">
                                                Graphical Presentation
                                            </h5>

                                        </div>
                                        <div class="com-md-4">
                                            <form action="" method="post" class="form-inline">

                                                <!-- <label for="from" style="margin-right: 10px;">Select Dealer</label>
                                                <input type="date" name="month" id="">
                                                <input type="submit" value="Search"> -->
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                </div>


                                <div id="chartdiv"></div>


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
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="../jquery-3.6.1.min.js"></script>
    <script src="./jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dealer_select').change(function() {
                var dealerID = $(this).val();
                $.ajax({
                    url: 'get_target.php',
                    method: 'post',
                    data: {
                        id: dealerID
                    },
                    success: function(data) {
                        $('#dealer_data').html(data)
                    }
                })
            })


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

        })
    </script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
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
            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50
            }))


            // Data
            var data = [
                <?php
                $mon = $con->query("SELECT * FROM `dealer_target` WHERE dealer_target.admin_id=" . $id);
                $act = 0;
                while ($mn = $mon->fetch_assoc()) {
                    $actual = $con->query("SELECT SUM(payable) AS payable FROM `invoice` WHERE dealer_id=" . $id . " AND created_at LIKE '" . $mn['target_month'] . "%'");
                    while ($a = $actual->fetch_assoc()) {
                        $act = $act + $a['payable'];
                    }
                ?> {
                        Month: "<?php echo $mn['target_month'] ?>",
                        Target: <?php echo $mn['amount'] ?>,
                        Actual: <?php echo $act ?>
                    },
                <?php } ?>
            ];


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "Month",
                renderer: am5xy.AxisRendererY.new(root, {
                    inversed: true,
                    cellStartLocation: 0.1,
                    cellEndLocation: 0.9
                })
            }));

            yAxis.data.setAll(data);

            var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererX.new(root, {
                    strokeOpacity: 0.1
                }),
                min: 0
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            function createSeries(field, name) {
                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueXField: field,
                    categoryYField: "Month",
                    sequencedInterpolation: true,
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "horizontal",
                        labelText: "[bold]{name}[/]\n{categoryY}: {valueX}"
                    })
                }));

                series.columns.template.setAll({
                    height: am5.p100,
                    strokeOpacity: 0
                });


                series.bullets.push(function() {
                    return am5.Bullet.new(root, {
                        locationX: 1,
                        locationY: 0.5,
                        sprite: am5.Label.new(root, {
                            centerY: am5.p50,
                            text: "{valueX}",
                            populateText: true
                        })
                    });
                });

                series.bullets.push(function() {
                    return am5.Bullet.new(root, {
                        locationX: 1,
                        locationY: 0.5,
                        sprite: am5.Label.new(root, {
                            centerX: am5.p100,
                            centerY: am5.p50,
                            text: "{name}",
                            fill: am5.color(0xffffff),
                            populateText: true
                        })
                    });
                });

                series.data.setAll(data);
                series.appear();

                return series;
            }

            createSeries("Target", "Target");
            createSeries("Actual", "Actual");


            // Add legend
            // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50
            }));

            legend.data.setAll(chart.series.values);


            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "zoomY"
            }));
            cursor.lineY.set("forceHidden", true);
            cursor.lineX.set("forceHidden", true);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <!-- HTML -->

    amCharts

</body>

</html>