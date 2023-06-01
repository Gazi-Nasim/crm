<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['invoice_id'];
$query="DELETE from `customer_invoice` where `invoice_id`=".$id;
$con->query($query);
// header('Location:list_invoice.php');
header('Location:edit_invoice.php');