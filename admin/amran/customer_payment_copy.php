<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');
$show="select * from customer_invoice";
$query=("SELECT * from `customer_create` where `dealer_id`='4' ");
$q=$con->query($query);
$binimow=mysqli_query($con,$show);

//----------query for date wise serach----------

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
                            <h1 class="m-0">Select Dealer Customer</h1>
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
            
            <div>
                <div>
                    <div class="col-md-12">
                        <select name="" id="">
                            <option value="">Customer Name:</option>
                            <?php while($data1=$q->fetch_assoc()){ //var_dump($data)?>
                            <option value="<?php echo $data1['id'] ?>"><?php echo $data1['name'] ?></option>
                            <?php } ?>

                        </select>&nbsp;
                        <label for="from" style="margin-right: 10px;">From</label>
                        <input type="date" id="from" name="from" class="form-control">
                        <label for="to" style="margin-left:10px;margin-right: 10px">To</label>
                        <input type="date" id="to" name="to" class="form-control">
                        <input type="button" id="dt_search" value="Search" class="btn btn-info" style="margin-left: 10px;">
                        
                        
                    </div>
                    <div>
                        <h5 style="align:center">Payment Data</h5>
                        <table class="table border">
                            <tr>
                                <th>Customer ID</th>
                                <th>Dealer ID</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Amount</th>
                                <th>Total</th>
                            </tr>
                            <?php
                            while ($data=$binimow->fetch_assoc()) { ?>
                                
                                <tr>
                                    <td><?php echo $data['customer_id']?></td>
                                    <td><?php echo $data['dealer_id']?></td>
                                    <td><?php echo $data['created_by']?></td>
                                    <td><?php echo $data['created_at']?></td>
                                    <td><?php echo $data['total']?></td>
                                    <td><?php echo $data['total']?></td>
                                </tr>
                            <?php   
                             }
                            
                            ?>
                        </table>
                    </div>
                        
                    </div>
                </div>
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
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
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

            // $('.total').each(function(e){
            //     let v=parseInt($(this).text());
            //     payTotal +=v;
            // })
            // console.log(payTotal);
            // $('#total_cal').text(payTotal);
            
        })
    </script>

</body>

</html>