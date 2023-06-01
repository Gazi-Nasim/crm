<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="DELETE from `customers` where `id`=".$id;
$con->query($query);
header('Location:customer_create.php');