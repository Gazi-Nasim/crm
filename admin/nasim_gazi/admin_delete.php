<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="DELETE from `admin` where `id`=".$id;
$con->query($query);

header('Location: ../admin.php');
?>