<?php
    $con = new mysqli('localhost', 'root', '', 'crm');
    // $data = $con->query('select * from dealer where dealer.id= "customer" ');
    $data = $con->query('select * from customers');
    ?>
    <select name="cusID" id="mark">
        <option value="">select customer</option>
        <?php
        while($d=$data->fetch_assoc()){
        ?>
        <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
        <?php 
        }
        ?>
    </select>
