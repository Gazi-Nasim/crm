<?php

$con = new mysqli('localhost', 'root', '', 'crm');
  $id=$_GET['id'];
  // $dealer_id=$_POST['dealer_id'];
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $organizaton=$_POST['organization'];
  $query = "update customer_create set name='$name', phone='$phone',  email='$email', address='$address', organization='$organizaton'  where id=".$id;
  $con->query($query);
  header('Location: customer.php');


?>
