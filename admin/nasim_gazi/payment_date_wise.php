<?php

$from = $_GET["from"];
$to = $_GET["to"];
$db = new mysqli('localhost', 'root', '', 'crm');
$date_qry = ("SELECT `payments`.*, `admin`.`name` FROM `payments` join `admin` on `payments`.`dealer_id`=`admin`.`id` WHERE `created_at`>='$from' and `created_at`<='$to' ORDER by `created_at` ASC ");
$dlr_data = $db->query($date_qry);
?>

<div class="form-group" id="dlrs">
    <label for="exampleInputEmail1">Admin Details</label>
    <table class="table table-striped table-hover table-borderless">
        <thead>
            <tr>
                <th>Dealer's Name</th>
                <th>Created by</th>
                <th>Created at</th>
                <th>Dealer Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($d = $dlr_data->fetch_assoc()) {
                $G = "SELECT * from `admin` where id=" . $d['collected_by'];
                $dt = $db->query($G)->fetch_assoc();
                $total = $total + $d["amount"];
            ?>
                <tr>
                    <td> <?php echo $d["name"] ?> </td>
                    <td> <?php echo $dt["name"] ?> </td>
                    <td> <?php echo $d["created_at"] ?> </td>
                    <td> <?php echo $d["amount"] ?> </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3"><strong> Total Sale </strong></td>
                <td><strong><?php echo $total ?>.00</strong></td>
            </tr>
        </tbody>
    </table>
</div>