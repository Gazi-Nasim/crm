<?php
var_dump($_POST);
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$role = $_POST['role'];
$status = $_POST['status'];

if(isset($_POST['parent'])){
    $parent=$_POST['parent'];
}else{
    $parent=0;
}





echo $qy = "UPDATE `admin` SET name='$name',email ='$email',password ='$password',phone= '$phone', `status`='$status', `parent`='$parent' WHERE id=".$id ;
$con->query($qy);


header('Location: ../admin.php');

?>