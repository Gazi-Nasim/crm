<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from customer_create where id=".$id;
$con->query($query);
header('Location:customer_create.php');