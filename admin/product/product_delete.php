<?php
$con=new mysqli('localhost','root','','crm');
$name=$_GET['name'];
var_dump($name);
$q="delete from products where name='$name'";
$con->query($q);
header('Location:product_list.php');