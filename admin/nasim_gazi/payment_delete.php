<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['id'];
$query="DELETE from `payments` where `payments`.`id`=".$id;
$con->query($query);

?>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
 <H1>Kamon Lage</H1>
<?php
header('Location:../tawhid/payment_insert.php');