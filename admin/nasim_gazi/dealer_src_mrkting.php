<?php
$con = new mysqli('localhost', 'root', '', 'crm');
$data = $con->query('SELECT * from `admin` where `admin`.`parent`=' . $_POST["id"]);
?>
<div class="form-group ">
<label for="exampleInputEmail1">Dealer Name: </label>
<select name="dealID" id="del" class="form-control">
    <option value="">select dealer</option>
    <?php while ($d = $data->fetch_assoc()) { ?>
        <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
    <?php } ?>
</select>
</div>
