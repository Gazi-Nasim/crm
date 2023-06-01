<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:index.php');
}
$mr_id = $_GET["dlr_id"];
var_dump($mr_id);
$db = new mysqli('localhost', 'root', '', 'crm');
$data = $db->query("SELECT * FROM `payments` WHERE `collected_by`=" . $mr_id);
// $mrs_data = $data->fetch_assoc();
// echo json_encode($mrs_data);
?>
<div class="form-group ">
    <label for="exampleInputEmail1">Dealer ID: </label>
    <!-- <input type="text" name="name" class="form-control" id="exampleInputEmail1"  placeholder="" > -->
    <select name="dealID" id="dilr">
        <option value="">Select Dealer</option>
        <?php while ($q = $data->fetch_assoc()) { ?>
            <option value="<?php echo $q['id'] ?>"><?php echo $q['name'] ?></option>
        <?php } ?>
    </select>
</div>
