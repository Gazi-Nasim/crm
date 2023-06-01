<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from customer_invoice where id=".$id;
$con->query($query);
header('Location:list_customer_invoice.php');