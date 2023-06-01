<?php
$db=new mysqli('localhost','root','','crm');
$db->query("delete from admin where id=".$_GET['id']);
header('Location: marketing.php');
?>