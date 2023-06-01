<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: index.php');
    }

    $a_role=$_GET["mrle"];
    $db=new mysqli('localhost','root','','crm');
    $qry=("SELECT `payments`.*, `admin`.`name` FROM `payments` join `admin` on `payments`.`dealer_id`=`admin`.`id` WHERE  `payments`.`dealer_id`= $a_role" );
    $dlr_data=$db->query($qry);
?>
<!-- <pre> -->
<div class="form-group" id="dlrs">
    <label for="exampleInputEmail1">Admin Details</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dealer's Name</th>           
                <th>Deale   r Amount</th>                
            </tr>
        </thead>
        <tbody>
        <?php while($d=$dlr_data->fetch_assoc()){   ?>
            <tr>
                <td> <?php echo $d["name"] ?> </td>                
                <td> <?php echo $d["amount"] ?></td>
                             
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>





<!-- <div  class="form-group" >
    <label for="exampleInputEmail1">Select A Admin</label>
    <select name="mrk_mana" id="mrkting"  class="form-control">
        <option value="">Select One</option>
    <?php //while($d=$data->fetch_assoc()){ ?>
        <option value="<?php //echo $d['id'] ?>" ><?php //echo $d['name'] ?></option>
    <?php //} ?>
    </select>
</div> -->
<pre>





<script>

</script>



