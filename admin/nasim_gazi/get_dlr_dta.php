<?php
    $mr_id=$_GET["m_id"];
    $db=new mysqli("localhost","root","","crm");
    $qry=("SELECT * FROM `payments` where `payments`.`collected_by`=".$mr_id );
    $result=$db->query($qry);  
   
?>
    
<?php  $i=1; while($mr_data=$result->fetch_assoc()){  ?>
<tr>
    <td><input type="text" class="form-control" value="<?php echo $mr_data["created_at"] ?>"></td>
    <td class=""> <input type="text" class="form-control" value="<?php ?>"></td>
    <td ><input type="text" class="de<?php echo $i ?> form-control" value="<?php echo $mr_data["amount"] ?>"></td>
    <td ><input type="text" class="cr<?php echo $i ?> form-control" value="<?php echo $mr_data["amount"] ?>"></td>
    <td ><input type="text" class="totl form-control" value="<?php ?>"></td>
    
</tr>
<?php  echo $i+=1; } ?>
   
