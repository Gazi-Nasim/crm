<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

$con = new mysqli('localhost', 'root', '', 'crm');
$invoice_id = $_GET['invoice_id'];
$con->query("DELETE FROM `invoice` WHERE `invoice`.`invoice_id`=$invoice_id");


$dealID = $_POST['dealID'];
$invID = $_GET['invoice_id'];
$prID = $_POST['proID'];
$price = $_POST['price'];
$qID = $_POST['qID'];
$vat = $_POST['vat'];
$discount = $_POST['discount'];
$stotal = $_POST['stotal'];
$pable = $_POST['pable'];
$create_at = $_POST['created_at'];
$create_by = $_SESSION['id'];

foreach ($qID as $index => $qIDs) {  
  $s_prID = $prID[$index];
  $s_qID = $qIDs;
  $s_vat = $vat[$index];
  $s_price = $price[$index];
  $s_stotal = $stotal[$index];
  echo $query = "INSERT INTO `invoice`(id, dealer_id, invoice_id, product_id, price, quantity, vat, discount, total, payable, created_at, created_by)VALUES(null, $dealID, $invID, $s_prID, $s_price, $s_qID, $s_vat, $discount, $s_stotal, $pable,'$create_at', $create_by)";
  $con->query($query);
}
header('Location: crt_mrkting_invoice.php');
