<?php

$db = new mysqli('localhost', 'root', '', 'crm');
$senior = $_GET['senior'];
if ($senior == 'dealer') {
    $data = $db->query("SELECT * from `admin` where `admin`.`role`='marketing'");
}

if ($senior == 'marketing') {
    $data = $db->query("SELECT * from `admin` where `admin`.`role`='admin'");   
}

if ($senior == 'admin') {
    $data = $db->query("SELECT * from `admin` where `admin`.`role`='admin'"); 
}

$d = $data->fetch_all(MYSQLI_ASSOC);
echo json_encode($d, true);

