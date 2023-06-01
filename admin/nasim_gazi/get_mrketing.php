<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
// if(!isset($_SESSION['role']) =="admin" || $_SESSION['role'] ="super" ){
//     header('Location: ../dashboard.php');
// }
$a_role = $_GET["admn_id"];
$db = new mysqli('localhost', 'root', '', 'crm');
$data = $db->query("SELECT * FROM `admin` WHERE `parent`=" . $a_role);
$mr_id = [];
while ($d = $data->fetch_assoc()) {
    $mr_id[] = $d["id"];
}

$mrid = implode(",", $mr_id);
$qry = ("SELECT `payments`.*, `admin`.`name` FROM `payments` join `admin` on `payments`.`dealer_id`=`admin`.`id` WHERE `collected_by` IN(" . $mrid . ") ORDER by `created_at` ASC ");
$dlr_data = $db->query($qry);
?>

<form action="javascript:(0)">
    <div class="form-group row">
        <div class="col-12 row">
            <div class="col-6">
                <label for="from" style="margin-right: 10px;">From</label>
                <input type="date" id="from" name="from" class="form-control" required>
            </div>

            <div class="col-6">
                <label for="to" style="margin-left:10px; margin-right: 10px">To </label>
                <input type="date" id="to" name="to" class="form-control" required>
            </div>
        </div>

        <div class="container-fluid">
            <div class="col-3 offset-9" style="margin-top: 30px">
                <input type="button" id="src_date" value="Search" class="btn btn-outline-info" style="margin-left: 46px"><a href="" class="btn btn-outline-danger" style="margin-left: 18px">Back</a>
            </div>
        </div>

    </div>


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

</form>