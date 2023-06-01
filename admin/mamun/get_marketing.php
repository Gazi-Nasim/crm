<?php
$con = new mysqli('localhost', 'root', '', 'crm');
$role = $_POST['role'];
if($role=='super'){
    $data=$con->query('select * from admin where role="admin"');
}
$d = $data->fetch_all(MYSQLI_ASSOC);
echo json_encode($d, true);