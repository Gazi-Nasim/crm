<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

$_SESSION["mnu"] = "leads";
$_SESSION["mnu_in"] = "ala_leads";

$con = new mysqli('localhost', 'root', '', 'crm');
$data = $con->query('SELECT * from `admin` where `admin`.`role`="admin" ');
$lead = $con->query('SELECT * from leads');

if (isset($_POST['name'])) {
  $admin = $_POST['admin_id'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $company = $_POST['company_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $district = $_POST['district'];
  $upazilla = $_POST['upazilla'];
  $status = $_POST['status'];

  $query = "INSERT INTO leads (admin_id, name, address, company_name, phone, email,district,upazilla,status)VALUES('$admin','$name','$address','$company','$phone','$email','$district','$upazilla','$status')";
  $con->query($query);
  header('Location: leads.php');
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
                  <h5 class="m-0">Leads Management</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Admin</label>
                            <select name="admin_id" id="admin_id" class="form-control">
                              <option value="">Select Admin</option>
                              <?php while ($d = $data->fetch_assoc()) { //var_dump($d) 
                              ?>

                                <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                              <?php } ?>
                            </select>
                            <div class="form-group" id="parent">
                              <!-- <label for="exampleInputEmail1">Parent </label>
                                <input type="text" name="parent" class="form-control" id="exampleInputEmail1" placeholder="" > -->
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Name </label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Company_name</label>
                            <input type="text" name="company_name" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">phone </label>
                            <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>


                        </div>
                        <div class="col-6">

                          <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">District</label>
                            <input type="text" name="district" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Upazilla</label>
                            <input type="text" name="upazilla" class="form-control" id="exampleInputEmail1" placeholder="">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" id="status" class="form-control">
                              <option value="">Select Status</option>
                              <option value="pending">Pending</option>
                              <option value="contacted">Contact</option>
                              <option value="aggrement">Aggreement</option>
                            </select>
                          </div>
                          
                          <div class="form-group col-12">
                            <label for="exampleInputEmail1"></label>
                            <input type="submit" class="btn btn-primary btn-block" value="Save">
                          </div>

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
      <footer class="content">
        <div class="card card-primary card-outline container-fluid">
          <div class="card-header">
            <h5 class="m-0">leads section</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-responsive">
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Address</th>
                <th>Company</th>
                <th>phone</th>
                <th>Email</th>
                <th>District</th>
                <th>Upazilla</th>
                <th>Status</th>
                <th colspan="2">Action</th>
              </tr>
              <?php $i = 0;
              while ($d = $lead->fetch_assoc()) {
                // echo("<pre>");
                // var_dump($d);
              ?>
                <tr>
                  <td><?php echo ++$i ?></td>
                  <td><?php echo $d['name'] ?></td>
                  <td><?php echo $d['address'] ?></td>
                  <td><?php echo $d['company_name'] ?></td>
                  <td><?php echo $d['phone'] ?></td>
                  <td><?php echo $d['email'] ?></td>
                  <td><?php echo $d['district'] ?></td>
                  <td><?php echo $d['upazilla'] ?></td>
                  <td><?php echo $d['status'] ?></td>
                  <td><a href="leades_edit.php?id=<?php echo $d['id'] ?>" class="btn btn-success btn-xs">Edit</a></td>
                  <td><a href="leads_delete.php?id=<?php echo $d['id'] ?>" class="btn btn-danger btn-xs">Delete</a></td>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
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
        $('#admin_id').change(function() {
          let admin_id = $(this).val();
          $.ajax({
            url: 'get_market.php',
            method: 'post',
            dataType: "",
            data: {
              id: admin_id
            },
            success: function(data) {
              $('#parent').html(data);
            }

          });
        });
      });


      // $(document).on('change','#dist',function(){
      //     let disID=$(this).val();
      //     $.ajax({
      //         url:'getup.php',
      //         method:'post',
      //         data:{id:disID},
      //         success:function(data){
      //             $('#up').html(data)
      //         }
      //     })
      // })
      //  })
      // $(document).ready(function() {
      //   $('#role').change(function() {
      //     let role = $(this).val();

      //     $.ajax({
      //     url: 'getUser.php',
      //       dataType: 'json',
      //       method: 'post',
      //       data: {
      //         role: role
      //       },
      //       success: function(data) {
      //         let ht = `<label for="exampleInputEmail1">Superior </label>
      //               <select name="parent"  class="form-control">`
      //         data.forEach(function(d) {
      //           ht += `<option value="${d.id}">${d.name}</option>`
      //         })
      //         ht += `</select>`
      //         $('#parent').html(ht)
      //       }
      //     })
      //   })
      // })
    </script>
</body>

</html>