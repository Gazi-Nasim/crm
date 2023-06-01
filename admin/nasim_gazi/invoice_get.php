<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:index.php');
}

$con = new mysqli('localhost', 'root', '', 'crm');

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start = ($page - 1) * 5;

$q = ("SELECT *, SUM(`payable`) as pmnt FROM `customer_invoice` GROUP BY `invoice_id` order by ID desc limit $start ,5 ");
$data = $con->query($q);


?>

<div id="">
    <?php $sl = 1;
    while ($d = $data->fetch_assoc()) {
        $cntmr_name = $con->query("SELECT `customar`.`name` FROM customar WHERE ID=" . $d['customar_id'])->fetch_assoc();
    ?>
        <tr>
            <td><?php echo $sl; ?></td>
            <td><?php echo $cntmr_name['name'] ?></td>
            <td><?php echo $d['invoice_id'] ?></td>
            <td><?php echo $d['vat'] ?></td>
            <td><?php echo $d['discount'] ?></td>
            <td><?php echo $d['created_at'] ?></td>
            <td><?php echo $d['payable'] ?></td>
            <td>
                <a href="edit_invoice.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-success btn-xs"> <i class="fa fa-edit" aria-hidden="true"></i></a>
                <a href="invoice_details.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="del_invoice.php?invoice_id=<?php echo $d['invoice_id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
        </tr>
    <?php $sl++;
    } ?>
</div>