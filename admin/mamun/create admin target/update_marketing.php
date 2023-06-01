<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location: index.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');
if (isset($_POST['name'])) {
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $parent=$_POST['parent'];
  $phone=$_POST['phone'];
  $role=$_POST['role'];
  $status=$_POST['status'];
  $query=("update admin set name='$name',email='$email',phone='$phone',password='$password',role='$role',status='$status',parent='$parent' where id=".$_GET['id']);
  $con->query($query);
  header('Location: marketing.php');
};
?>












