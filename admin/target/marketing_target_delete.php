<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from marketing_target where id=".$id;
$con->query($query);
header('Location:marketing_target.php');