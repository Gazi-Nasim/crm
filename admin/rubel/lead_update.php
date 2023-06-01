<?php
$con=new mysqli('localhost','root','','crm');
  $id=$_GET['id'];
  $admin_id=$_POST['admin_id'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $company_name=$_POST['company_name'];
  $district=$_POST['district'];
  $upazilla=$_POST['upazilla'];
  $status=$_POST['status'];
  $query="update leads set admin_id=$admin_id,email='$email',phone='$phone',address='$address',company_name='$company_name',district='$district',upazilla='$upazilla',status='$status' where id=".$id;
  $con->query($query);
  header('Location: lead_list.php');