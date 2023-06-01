<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
}

$con=new mysqli('localhost','root','','crm');
$invoice_id=$_GET['invoice_id'];
$price=$_POST['price'];
$dealID=$_POST['dealID'];
  

  $qID=$_POST['qID'];
  $total=$_POST['tot'];
  
  $discount=$_POST['discount'];
 
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
 $query ="UPDATE invoice set dealer_id=$dealID, invoice_id=$invoice_id, product_id=$s_prID, price=$s_price, quantity=$s_qID, total=$total, vat=$s_vat, discount=$discount, payable=$s_stotal, created_at='$create_at', created_by=$create_by where invoice_id=$invoice_id";
 $con->query($query);
}
header('Location: create_invoice.php');

