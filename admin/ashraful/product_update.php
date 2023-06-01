<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:index.php');
};
$db=new mysqli('localhost','root','','crm');

$id=$_GET['id'];
$name=$_POST['name'];
$delear_price=$_POST['dealer_price'];
$mrp=$_POST['mrp'];
$unit=$_POST['unit'];
$vat=$_POST['vat'];
$status=$_POST['status'];

if($name!==''){
    $query="UPDATE `products` SET `name`='$name', `dealer_price`=$delear_price,`mrp`=$mrp,`unit`='$unit',`vat`=$vat,`status`='$status' WHERE id=".$id;

}else{
    $query="UPDATE `products` SET `name`='$name', `dealer_price`=$delear_price,`mrp`=$mrp,`unit`='$unit',`vat`=$vat,`status`='$status' WHERE id=".$id;
}
$db->query($query);
header("Location: products.php");
// UPDATE `products` SET `name` = 'HP Monitor2', `dealer_price` = '5500', `mrp` = '6000', `unit` = '5', `status` = 'active' WHERE `products`.`id` = 19;