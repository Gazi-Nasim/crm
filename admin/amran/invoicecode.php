<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="invoice.css">

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con = new mysqli('localhost', 'root', '', 'crm');
    $invs = $con->query('select id,dealer_id,invoice_id,product_id,price,quantity,total,vat,discount,payable,created_at, created_by, SUM(payable) from invoice GROUP BY invoice_id having invoice_id=' . $id);
    $data = $invs->fetch_assoc();

    // $query="select admin.name from admin join invoice on invoice.dealer_id=admin.id where invoice.invoice_id=".$id;
    // print_r($con->query($query)) ;
    $dl_name = $con->query("select * from admin join invoice on invoice.dealer_id=admin.id where invoice.invoice_id=" . $id)->fetch_assoc();

    $d_info = $con->query('select * from dealer')->fetch_assoc();




    // echo $dl_name;
}
?>



<!-- Content -->
<div class="page-content container">
    <div class="page-header text-blue-d2">
        <div>
            <label for="dealer_id">Dealer ID: </label>
            <input name="dealer_id" type="text" value="<?php echo $data['dealer_id'] ?>">

        </div>
        <div>
            <label for="dealer_name">Dealer Name: </label>
            <input name="dealer_name" type="text" value="<?php echo $dl_name['name'] ?>">

        </div>



        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    <button>Print</button>
                    <script src="/jquery-3.6.1.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
                    <script>
                        $('button').click(function() {
                            window.print();
                            return false;
                        });
                    </script>
                </a>

                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    <button type="button" class="cmd">Generate PDF</button>

                </a>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                            <span class="text-default-d3">Invoice Details</span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row container">

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-start">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">

                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Dealer information
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Company Name: </span><span><?php echo $d_info['company_name'] ?></span></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Address: </span> <span><?php echo $d_info['address'] ?></span> </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Trade License:</span><span><?php echo $d_info['trade_license'] ?></span></div>


                        </div>

                    </div>
                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">

                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span><span><?php echo $data['invoice_id'] ?></span></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> <span><?php echo $data['created_at'] ?></span> </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Created By:</span><span><?php echo $data['created_by'] ?></span></div>


                        </div>

                    </div>
                    <!-- /.col -->
                </div>



                <div class="container table-responsive">
                    <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                        <tr class="text-white">
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Vat(%)</th>
                            <th>Sub Total</th>
                        </tr>

                        <?php
                        $invoice_loop = $con->query('select * from invoice where invoice_id=' . $id);
                        while ($d = $invoice_loop->fetch_assoc()) {
                            $prod = $con->query('select * from products where id=' . $d['product_id'])->fetch_array();
                        ?>
                            <tr>
                                <td><?php echo $d['id'] ?></td>
                                <td><?php echo $prod['name'] ?></td>
                                <td><?php echo $d['quantity'] ?></td>
                                <td><?php echo $d['price'] ?></td>
                                <td><?php echo $d['vat'] ?></td>
                                <td><?php echo $d['payable'] ?></td>
                            </tr>
                        <?php }

                        ?>

                    </table>


                </div>

                <div class="row mt-3 container col-md-12">
                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                        Extra note such as company or payment information...
                    </div>

                    <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                        <div class="row my-2">
                            <div class="col-7 text-right">
                                <strong>Discount(%): </strong>
                            </div>
                            <div class="col-5">
                                <span class="text-120 text-secondary-d1"></span> <span><?php echo $data['discount'] ?></span>
                            </div>
                        </div>
                        <!-- 
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Vat
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1"></span><span><?php echo $data['vat'] ?></span>
                                </div>
                            </div> -->

                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                            <div class="col-7 text-right">
                                <strong>Payable(TK.): </strong>
                            </div>
                            <div class="col-5">
                                <span class="text-150 text-success-d3 opacity-2"></span><span><?php echo $data['SUM(payable)'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div>
                    <span class="text-secondary-d1 text-105">Thank you for your business</span>
                    <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>