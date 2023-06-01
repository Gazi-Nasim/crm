<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="delete from invoice where id=".$id;
$con->query($query);
header('Location:list_invoice.php');