<?php
$con = new mysqli('localhost', 'root', '', 'crm');
$role = $_POST['role'];
if($role=='dealer'){
    $data=$con->query('select * from admin where role="marketing"');
}
$d = $data->fetch_all(MYSQLI_ASSOC);
echo json_encode($d, true);