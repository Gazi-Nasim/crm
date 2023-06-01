<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$id = $_POST['id'];
$con = new mysqli('localhost', 'root', '', 'crm');
$q = "SELECT * from `admin` WHERE parent=$id";
$data = $con->query($q);

?>
<select  id="" name="parent" class="form-select">
    <option value="">Select Marketing Manager</option>
    <?php while ($d = $data->fetch_assoc()) { ?>
    <option   value="<?php echo ($d['id']) ?>"><?php echo ($d['name']) ?></option>
    <?php } ?>
</select>