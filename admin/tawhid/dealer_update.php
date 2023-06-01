<?php
var_dump($_FILES);
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$trade = $_FILES['trade_license']["name"];
$address = $_POST['address'];
$company_name = $_POST['company_name'];
$bank_account = $_POST['bank_account'];
$vat_no = $_POST['vat_no'];
$photo=$_FILES['photo']['name'];
$district=$_POST['district'];
$upazilla=$_POST['upazilla'];
$status=$_POST['status'];

if (move_uploaded_file($_FILES['photo']['tmp_name'],'./assets/dealer_img'.$photo)) {
    $query = "update dealer set `photo`='$photo',trade_license='$trade',address='$address',company_name='$company_name',bank_account='$bank_account',vat_no='$vat_no',district='$district',upazilla='$upazilla',status='$status' where admin_id=".$id;    
}else {
    $query = "update dealer set trade_license='$trade',address='$address',company_name='$company_name',bank_account='$bank_account',vat_no='$vat_no',district='$district',upazilla='$upazilla',status='$status' where admin_id=" . $id;
};

if (move_uploaded_file($_FILES['trade_license']['tmp_name'],'./assets/dealer_trade_license'.$trade)) {
    $query = "update dealer set `photo`='$photo',trade_license='$trade',address='$address',company_name='$company_name',bank_account='$bank_account',vat_no='$vat_no',district='$district',upazilla='$upazilla',status='$status' where admin_id=".$id;    
}else {
    $query = "update dealer set trade_license='$trade',address='$address',company_name='$company_name',bank_account='$bank_account',vat_no='$vat_no',district='$district',upazilla='$upazilla',status='$status' where admin_id=" . $id;
};

$con->query($query);
$qy = "UPDATE admin SET name='$name',email ='$email',password ='$password',phone= '$phone' WHERE id=".$id ;
$con->query($qy);


header('Location: t_dealer_list.php');