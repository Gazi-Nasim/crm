 <?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
  }
  $con = new mysqli('localhost', 'root', '', 'crm');
  if (isset($_POST['amount'])) {
    var_dump($_POST);

    $tr_mnth = $_GET['tr_mnth'];
    $crt_date = $_GET['crt_dt'];

    $id = $_GET['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];

    if ($_POST['month'] == '') {
      $month = $tr_mnth;
    } else {
      $mn = date_create($_POST['month']);
      $month = date_format($mn, 'Y-m');
    }

    if ($_POST['created_at'] == '') {
      $created_at = $crt_date;
    } else {
      $created_at = $_POST['created_at'];
    }

    $query = "update marketing_target set amount='$amount',target_month='$month',created_at='$created_at' where admin_id=" . $id;
    $query1 = "update admin set name='$name'where id=" . $id;
    $con->query($query);
    $con->query($query1);
    header('Location:marketing_target.php');
  };
  ?>