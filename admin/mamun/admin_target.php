<?php
session_start();
$_SESSION["mnu"]="admin_target";
$_SESSION["mnu_in"]="ad_trgt_active";

if (!isset($_SESSION['username'])) {
  header('Location: index.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');

$create = $con->query("SELECT admin_target.id,  admin_target.admin_id, admin.name, admin_target.amount, admin_target.target_month, admin_target.created_at FROM admin_target JOIN admin ON admin_target.admin_id=admin.id order by id desc");
$data = $con->query('SELECT * FROM admin where role="admin" order by id desc');

if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $amount = $_POST['amount'];
  $mn=date_create($_POST['month']);
  $month =date_format($mn,'Y-m');
  $date = $_POST['date'];
  $query = "INSERT INTO `admin_target` (`admin_id`, `amount`, `target_month`, `created_at`) VALUES ($name, '$amount', '$month', '$date')";
  $con->query($query);
  header('Location: admin_target.php');
};

  
  

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
    include("../menu.php")  ?>

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
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">Create Admin target</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Admin Name </label>
                            <select name="name" id="role" class="form-control">
                              <option value="">Select Admin</option>
                            <?php while ($d = $data->fetch_assoc()) { ?>
                              <option value="<?php echo $d['id']?>"><?php echo $d['name']?></option>
                              <?php } ?>
                              
                            </select>
                           

                            <!-- <input type="text" name="<?php echo $d['id']?>" class="form-control" id="exampleInputEmail1" value="<?php echo $d['name']?>"> -->
                            

                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Amount </label>
                            <input type="text" name="amount" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>
                  
                          <div class="form-group" id="parent">
                            
                          </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Target Month </label>
                            <input type="date" name="month" class="form-control">
                            
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Date </label>
                            <input type="date" name="date" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>
                         
                        </div>

                        <div class="form-group col-12">
                            <label for="exampleInputEmail1"></label>
                            <input type="submit" class="btn btn-primary btn-block" value="Save">
                          </div>
                          
                      </div>

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
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Admin Target List</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Month</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                <?php $i = 0;
                while ($data = $create->fetch_assoc()) { ?>
                
                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $data['amount'] ?></td>
                    <td><?php echo $data['target_month'] ?></td>
                    <td><?php echo $data['created_at'] ?></td>
                    <td>
                      <a href="admin_target_edit.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-xs">Edit</a>
                      <a href="admin_target_delete.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Do you want to delete this ?')" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
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
  <script>
    $(function() {
      // Summernote
      $('.summernote').summernote()

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
    $(document).ready(function() {
      $('#role').change(function() {
        let role = $(this).val();

        $.ajax({
          url: 'get_marketing.php',
          dataType: 'json',
          method: 'post',
          data: {
            role: role
          },
          success: function(data) {
            let ht = `<label for="exampleInputEmail1">Superior </label>
                    <select name="parent"  class="form-control">`
            data.forEach(function(d) {
              ht += `<option value="${d.id}">${d.name}</option>`
            })
            ht += `</select>`
            $('#parent').html(ht)
          }
        })
      })
    })
  </script>
</body>

</html>