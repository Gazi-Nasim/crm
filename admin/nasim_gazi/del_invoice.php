<?php
$con=new mysqli('localhost','root','','crm');
$id=$_GET['invoice_id'];
$query="DELETE from `customer_invoice` where `invoice_id`=".$id;
$con->query($query);
header('Location:list_invoice.php');
?>
 <H1>Kamon Lage</H1>
<?php
header('Location:test.php');