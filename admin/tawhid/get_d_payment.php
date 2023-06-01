<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$id = $_POST['id'];
$con = new mysqli('localhost', 'root', '', 'crm');
$q = "SELECT admin.name, payments.amount, payments.created_at FROM admin JOIN payments ON admin.id=payments.dealer_id
WHERE payments.collected_by=$id";
$data = $con->query($q);
?>
<div class="container" id="paym">
    <table class="table table-bordered">
        <tr>
            <th>Dealer Name</th>
            <th>Payment Amount</th>
            <th>Created At</th>
        </tr>
        <?php while($d=$data->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $d['name'] ?></td>
            <td><?php echo $d['amount'] ?></td>
            <td><?php echo $d['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>