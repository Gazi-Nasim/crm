<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
$_SESSION["mnu_f"] = "o";
$_SESSION["mnu"] = "customer";
$_SESSION["mnu_in"] = "crt_cstmr";

$db = new mysqli('localhost', 'root', '', 'crm');
$query = ("SELECT * from `admin`");
$result = $db->query($query);

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start = ($page - 1) * 5;

$in_ro = "SELECT * FROM `customers` order by `id` desc limit $start,5";
$dataV = $db->query($in_ro);

$in_ros = $db->query("SELECT * FROM `customers`  ");
$rows = mysqli_num_rows($in_ros);
$totl_pages = ceil($rows / 5);


if (trim(isset($_POST["name"]))) {
    $dealer_id = $_SESSION['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['mail'];
    $address = $_POST['address'];
    $org = $_POST['org'];

    $db->query("INSERT INTO `customers` (`ID`, `dealer_id`, `name`, `phone`, `email`,`address`, `organization`) VALUES (NULL, $dealer_id, '$name', '$phone', '$email', '$address', '$org')");

    header('Location:customer_create.php');
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
                            <h1 class="m-0">Create New User</h1>
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
                                    <h5 class="m-0">User form </h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Name </label>
                                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name ">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Phone</label>
                                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">E-mail</label>
                                                        <input type="text" name="mail" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail ">
                                                    </div>

                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Address</label>
                                                        <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Enter Address ">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Organization</label>
                                                        <input type="text" name="org" class="form-control" id="exampleInputEmail1" placeholder="Enter Organization">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Action</label>
                                                        <input type="submit" class="btn btn-primary btn-block" value="Save">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h5 class="m-0">Customer List</h5>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>customer Name</th>
                                                                <th>Phone</th>
                                                                <th>E-mail</th>
                                                                <th>Address</th>
                                                                <th>Organization</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="pID">
                                                            <?php $sl = 1;
                                                            while ($d = $dataV->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $sl; ?></td>
                                                                    <td><?php echo $d['name'] ?></td>
                                                                    <td><?php echo $d['phone'] ?></td>
                                                                    <td><?php echo $d['email'] ?></td>
                                                                    <td><?php echo $d['address'] ?></td>
                                                                    <td><?php echo $d['organization'] ?></td>

                                                                    <td>
                                                                        <a href="customer_edit.php?id=<?php echo $d['id'] ?>" class="btn btn-success btn-xs"> <i class="fa fa-edit" aria-hidden="true"></i></a>
                                                                        <a href="customer_delete.php?id=<?php echo $d['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php $sl++;
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                    <?php

                                                    if ($page > 1) {

                                                        echo "<a href='customer_create.php?page=" . ($page - 1) . "' class='btn  btn-primary find_page'> << </a>";
                                                    }

                                                    for ($n = 1; $n < $totl_pages; $n++) {
                                                        echo "<a href='customer_create.php?page=" . ($n) . "' class='btn find_page btn-primary'> " . ($n) . "</a>";
                                                    }

                                                    if ($n > $page) {
                                                        echo "<a href='customer_create.php?page=" . ($page + 1) . "' class='btn  btn-primary find_page'> >> </a>";
                                                    }

                                                    ?>

                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
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
        <script src="../../../jQuery/jquery-3.6.1.js"></script>

</body>

</html>