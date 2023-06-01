<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from leads where id=".$id;
$con->query($query);
header('Location:leads.php');