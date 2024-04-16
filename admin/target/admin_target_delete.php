<?php
$db=new mysqli('localhost','root','','crm');
$db->query("delete from admin_target where id=".$_GET['id']);
header('Location: admin_target.php');
?>