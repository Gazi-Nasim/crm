<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from dealer_target where id=".$id;
$con->query($query);
header('Location:dealer_target.php');