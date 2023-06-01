
<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../index.php');
}

echo "<pre>";
var_dump($_POST);
echo "</pre>";

$con = new mysqli('localhost', 'root', '', 'crm');
$invoice_id = $_GET['invoice_id'];
$con->query("DELETE FROM `customer_invoice` WHERE `customer_invoice`.`invoice_id`=$invoice_id");


$dealer_id = $_SESSION["id"];
$customer_id = $_POST["customar_id"];
$type = "taxable";
$proID = $_POST['proID'];
$price = $_POST['prices'];
$qID = $_POST['qnttys'];
$total = $_POST['totls'];
$vat = $_POST['vats'];
$discount = $_POST['discount'];
$pable = $_POST["paid"];
$create_at = $_POST['created_at'];
$created_by = $_SESSION['id'];

foreach ($qID as $indx => $qIDs) {
  $s_prID = $proID[$indx];
  $s_qID = $qIDs;
  $s_vat = $vat[$indx];
  $s_price = $price[$indx];
  $s_total = $total[$indx];

  echo $query = "INSERT INTO `customer_invoice` (`id`, `dealer_id`, `customer_id`, `type`, `invoice_id`, `product_id`, `price`, `quantity`, `total`, `vat`, `discount`, `payable`, `created_at`, `created_by`) VALUES (NULL, " . $dealer_id . ", " . $customer_id . ", '" . $type . "', " . $invoice_id . ", " . $s_prID . ", " . $s_price . ", " . $s_qID . ", " . $s_total . ", " . $s_vat . ", " . $discount . ", " . $pable . ", '" . $create_at . "', " . $created_by . ")";

  $con->query($query);
}

header('Location: crt_cstmr_invoice.php');
