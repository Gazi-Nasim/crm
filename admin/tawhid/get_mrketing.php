<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: index.php');
    }

    $a_role=$_GET["mrle"];
    $db=new mysqli('localhost','root','','crm');
    $data=$db->query("SELECT * FROM `admin` WHERE `parent`=".$a_role);
    $mr_id=[];
    while($d=$data->fetch_assoc()){
        $mr_id[]=$d["id"];
        }
    $mrid=implode("," ,$mr_id);
    $qry=("SELECT `payments`.*, `admin`.`name` FROM `payments` join `admin` on `payments`.`dealer_id`=`admin`.`id` WHERE `collected_by` IN(".$mrid.")");
    $dlr_data=$db->query($qry);
?>
<!-- <pre> -->
<div class="form-group" id="dlrs">
    <label for="exampleInputEmail1">Admin Details</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dealer's Name</th>           
                <th>Dealer Amount</th>
                <th>Created by</th>
            </tr>
        </thead>
        <tbody>
        <?php while($d=$dlr_data->fetch_assoc()){          
            $G="select * from `admin` where id=".$d['collected_by'];
            $dt=$db->query($G)->fetch_assoc();           
            ?>
            <tr>
                <td> <?php echo $d["name"] ?> </td>                
                <td> <?php echo $d["amount"] ?></td>
                <td> <?php echo $dt["name"] ?> </td>                
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



