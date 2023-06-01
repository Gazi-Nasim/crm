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
$total=0;
$data = $con->query("SELECT admin.name,amount,collected_by,created_at FROM `payments` JOIN admin ON admin.id=payments.dealer_id WHERE admin.parent=".$id);
while($d = $data->fetch_assoc()){
    $b=$con->query("select * from admin where id=".$d['collected_by'])->fetch_assoc();
    $total=$total+$d['amount'];
?>
<tr>
    <td><?php echo date("d/m/Y", strtotime($d['created_at'])) ?></td>
    <td><?php echo $d['name'] ?></td>
    <td><?php echo $b['name'] ?></td>
    <td><?php echo $d['amount'] ?></td>
</tr>

<?php } ?>
<tr>
    <th colspan="3">Total</th>
    <td><strong><?php echo $total ?>.00</strong></td>
</tr>