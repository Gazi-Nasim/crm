<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from customers where id=".$id;
$con->query($query);
header('Location:customer.php');