<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');

if (isset($_POST['name'])) {
  var_dump($_POST);
  $id = $_GET['id'];
  $tr_mnth = $_GET['tr_mnth'];
  $crt_date = $_GET['crt_dt'];
  $name = $_POST['name'];
  $amount = $_POST['amount'];

  if ($_POST['month'] == '') {
    $month = $tr_mnth;
  } else {
    $mn = date_create($_POST['month']);
    $month = date_format($mn, 'Y-m');
  }

  if ($_POST['date'] == '') {
    $date = $crt_date;
  } else {
    $date = $_POST['date'];
  }

  

  echo $query = "update `admin_target` set amount='$amount',target_month='$month',created_at='$date'  where admin_id=" . $id;
  $query1 = "update `admin` set `name`='$name' where id=" . $id;
  $con->query($query);
  $con->query($query1);
  header('Location: admin_target.php');
};
