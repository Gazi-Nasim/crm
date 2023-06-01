<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

$con=new mysqli('localhost','root','','crm');
$invoice_id=$_GET['invoice_id'];
// var_dump($invoice_id);

$qrY=("Delete from `customer_invoice` where `customer_invoice`.`invoice_id`=".$invoice_id);

$con->query($qrY);


$price=$_POST['price'];
$dealID=$_SESSION['id'];
$cusID=$_POST['cusID'];
$type = "performa";


$qID=$_POST['qID'];
$total=$_POST['tot'];

$discount=$_POST['discount'];

$vat = $_POST['vat'];
$stotal=$_POST['stotal'];
$create_at=$_POST['created_at'];
$create_by=$_SESSION['id'];
$prID= $_POST['pid'];
foreach($qID as $index => $qIDs){
  
  $s_prID= $prID[$index];
  $s_qID = $qIDs;
  $s_vat = $vat[$index];
  $s_price = $price[$index];
  $s_stotal = $stotal[$index];
//  echo $query ="UPDATE customer_invoice set dealer_id=$dealID, customer_id=$cusID, invoice_id=$invoice_id, product_id=$s_prID, price=$s_price, quantity=$s_qID,total=$total, vat=$s_vat, discount=$discount, payable=$s_stotal, created_at='$create_at', created_by=$create_by where invoice_id=$invoice_id";

echo   $query = "INSERT INTO `customer_invoice` (`id`, `dealer_id`, `customer_id`, `type`, `invoice_id`, `product_id`, `price`, `quantity`, `total`, `vat`, `discount`, `payable`, `created_at`, `created_by`) VALUES (NULL, '$dealID', '$cusID', '$type', $invoice_id, $s_prID, $s_price, ' $s_qID', '$total', '$s_vat', '$discount', '$s_stotal', '$create_at',$create_by)";



 $con->query($query);
}
header('Location: customer_invoice.php');