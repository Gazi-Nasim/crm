<?php
if(isset($_POST['submit'])){
    $dealer_id=$_POST['dealer_id'];
    $customer_id=$_POST['customer_id'];
    $con= mysqli_connect('localhost','root','','crm');
    $query=("SELECT * from `admin` where `role`='dealer' ");
    $q=$con->query($query);

    if($con){
        echo "connected";
    }else{
        echo "not connected";
    }
}

$send= "INSERT INTO customer_invoice(dealer_id,customer_id) values ('$dealer_id','customer_id')";

$result=mysqli_query($con,$send);

if($result){
    echo "inserted";
}else{
    echo "not success";
}

// For show
$show="select * from customer_invoice"

?>


<form action="customer_invoice.php" method="post">
    <select name="dealer_id" id="">
    <option value="">Dealer Name:</option>
    <?php while($data1=$q->fetch_assoc()){ //var_dump($data)?>
    <option value="<?php echo $data1['id'] ?>"><?php echo $data1['name'] ?></option>
    <?php } ?>

    </select>&nbsp;
        Customer ID: <input type="text" name="customer_id" id=""> 
    <input type="submit" name="submit" value="submit">
</form>


INSERT INTO `customer_invoice`(`dealer_id`, `customer_id`, `invoice_id`, `product_id`, `price`, `quantity`, `total`, `vat`, `discount`, `payable`, `created_at`, `created_by`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]')