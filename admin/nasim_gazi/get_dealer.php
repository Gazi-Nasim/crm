<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:index.php');
}
$mr_id=$_GET["mr_id"];
$db=new mysqli('localhost','root','','crm');
$data=$db->query("SELECT * FROM `payments` WHERE `collected_by`=".$mr_id);
$mrs_data=$data->fetch_assoc();

// while($mrs_dta=$dat->fetch_assoc()){
//     $dl_id=$mrs_dta["dealer_id"];
//     $da=$db->query("SELECT * FROM `admin` WHERE `id`=".$dl_id);
//     var_dump($dl_id);
//     }

?>


