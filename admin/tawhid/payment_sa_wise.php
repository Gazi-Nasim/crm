<?php
session_start();

$_SESSION["mnu"]="payment";
$_SESSION["mnu_in"]="ad_to_pay";

if(!isset($_SESSION['username'])){
  header('Location: ../index.php');
}

$db=new mysqli('localhost','root','','crm');
$admin_data=$db->query("SELECT `id`,`name` FROM `admin` where role='admin'");

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
  <link rel="stylesheet" href="../dist/css/adminlte.min.css"><link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                <h5 class="m-0">Payments</h5>
              </div>
              <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Admin</label>
                    <select name="admin_id" id="admin_id" class="form-control">
                            <option value="">Select Admin</option>
                          <?php  while($data=$admin_data->fetch_assoc()){?>
                            <option value="<?php  echo $data["id"]?>"> <?php  echo $data["name"]?> </option>
                          <?php } ?>
                        </select>                 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Marketing Manager</label>
                    <span id="parent">
                      <select name="" id="" class="form-control" disabled>
                          <option value=""></option>
                      </select>
                    </span>              
                  </div>
                  <span id="deal">

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
    $(document).ready(function(){ 
      
      $('#admin_id').change(function () { 
        let admin_id=$(this).val();
        $.ajax({
          type: "post",
          url: "get_market.php",
          data: {id:admin_id},
          dataType: "",
          success: function (data) {
            $('#parent').html(data);
          }
      });
      $(document).on('change', '#mark', function () {
        let mark=$(this).val();
        $.ajax({
          type: "post",
          url: "get_d_payment.php",
          data: {id:mark},
          success: function (data) {
            $('#deal').html(data);
          }
        });
      });
      
    });
        // $("#admin_s").change(function(){
        //   let a_rle=$(this).val();
        //   console.log(a_rle);
        //   if(a_rle!=""){
        //     $.ajax({
        //     url:"get_mrketing.php",
        //     method:"get",
        //     data:{mrle:a_rle},
        //     success:(function(dta){              
        //       $("#mrting_man").html(dta);
        //     })            
        //   })
          
        //   }               
          
        // })

        // $(document).on('change','#mrkting',function(){
        //         let _ID=$(this).val();                
        //         $.ajax({
        //             url:'get_dealer.php',
        //             method:'get',
        //             data:{mr_id:_ID},
        //             success:function(data){
        //               $('#dler').html(data)
        //             }
        //         })
        //     })
    })
</script>
</body>
</html>
