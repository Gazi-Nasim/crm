<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from dealer where admin_id=".$id;
$con->query($query);
$qy="delete from admin where id=".$id;
$con->query($qy);
header('Location: t_dealer_list.php');
?>