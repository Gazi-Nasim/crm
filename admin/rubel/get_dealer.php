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
                <th>Dealer's Amount</th>                
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
