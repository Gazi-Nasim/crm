 <?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}
 $con = new mysqli('localhost', 'root', '', 'crm');
 if (isset($_POST['amount'])) {
     $id=$_GET['id'];
     $name=$_POST['name'];
     $amount =$_POST['amount'];
     $month =$_POST['month'];
     $created_at=$_POST['created_at'];
     $query="update dealer_target set amount='$amount',target_month='$month',created_at='$created_at' where admin_id=".$id;
     $query1="update admin set name='$name'where id=".$id;
     $con->query($query);
     $con->query($query1);
     header('Location:dealer_target.php');
  };
  ?>