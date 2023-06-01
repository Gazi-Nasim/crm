<?php
$id=$_GET['id'];
$con = new mysqli('localhost', 'root', '', 'crm');
$d = $con->query("select * from products where id=$id")->fetch_assoc();
echo json_encode($d);
?>