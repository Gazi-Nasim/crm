<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
if ($_SESSION['role']!='super'){
    header('Location: ../dashboard.php');
}
$con = new mysqli('localhost', 'root', '', 'crm');
$id=$_POST['id'];

$data = $con->query("SELECT admin_target.admin_id, admin_target.amount, admin_target.target_month, admin_target.created_at, admin.name, admin.id FROM admin_target JOIN admin ON admin_target.admin_id=admin.id WHERE admin_target.admin_id=".$id);

while($d = $data->fetch_assoc()){
    $bata=$con->query("SELECT * FROM admin WHERE admin.parent=".$d['id']);
    while($b=$bata->fetch_assoc()){
        $jeta=$con->query("SELECT * FROM dealer WHERE dealer.admin_id=".$b['id']);
        while($j=$jeta->fetch_assoc()){
            $kita=$con->query("SELECT * FROM invoice WHERE invoice.dealer_id=".$j['id']);
            while($k=$kita->fetch_assoc()){

            
        
    
?>
<tr>
    <td><?php echo $d['name'] ;?></td>
    <td><?php echo $d['target_month'] ;?></td>
    <td><?php echo $d['amount']  ;?></td>
    <td><?php echo $k['payable'] ?></td>
    
</tr>

<?php
    }
    }
    }
 } ?>
