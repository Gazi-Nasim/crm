<?php

$con = new mysqli('localhost', 'root', '', 'crm');
  $id=$_GET['id'];
  $name=$_POST['name'];
  $address=$_POST['address'];
  $company=$_POST['company_name'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $district=$_POST['district'];
  $upazilla=$_POST['upazilla'];
  $status=$_POST['status'];

  $query = "update leads set name='$name', address='$address', company_name='$company', phone='$phone', email='$email',district='$district',upazilla='$upazilla',status='$status' where id=".$id;
  $con->query($query);
  header('Location: leads.php');


?>
