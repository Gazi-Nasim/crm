<?php
$con=new mysqli('localhost','root','','crm');
$name=$_GET['id'];
$q="delete from dealer where id='$name'";
$con->query($q);
$p="delete from admin where id='$name'";
$con->query($p);
header('Location:dealer_create.php');

?>