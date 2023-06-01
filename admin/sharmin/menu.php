<?php
$base_url = "http://localhost/crm/admin";
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo $base_url ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $base_url ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php echo $_SESSION['username'] ?>
        </a>
      </div>
    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item dropdown menu-open">
          <!--  class="menu-open" is used to opened menu  -->
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              <?php echo $_SESSION['username'] ?>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <?php if ($_SESSION['role'] == "super") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add New Access</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Products</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/ashraful/products.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Invoice</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sifath/create_invoice.php" class="nav-link">
                      <i class="fas fa-calculator"></i>
                      <p>Create Invoice</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sharmin/list_invoice.php" class="nav-link">
                      <i class="fas fa-calculator"></i>
                      <p>Invoice List</p>
                    </a>
                  </li>
                 

                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Dealer</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Dealer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/t_dealer_list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealers List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Manage</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/payment_ad_wise.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Payments</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/bijoy/payment.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Marketing Payments </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/payament_dealer.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payment Dealer wise</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Leads</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/Alamin/leads.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Leads </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/R_leads.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Marketing Leads</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/lead_list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List of leads manager</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nobel/leads.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Lead</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/ledger.php" class="nav-link ">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Ledger</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php } ?>
          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->

          <?php if ($_SESSION['role'] == "admin") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add New Access</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mahmud/marketing.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Creat Marketing Manager</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Products</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/ashraful/products.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Invoice</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sifath/create_invoice.php" class="nav-link">
                      <i class="fas fa-calculator"></i>
                      <p>Create Invoice</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sharmin/list_invoice.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Invoice List</p>
                    </a>
                  </li>

                  <!-- <li class="nav-item">
                      <a href="<?php echo $base_url ?>/amran/invoice_details.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Invoice Details</p>
                      </a>
                    </li> -->
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Dealer</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Dealer</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/t_dealer_list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealers List</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Manage</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- <li class="nav-item">
                      <a href="<?php echo $base_url ?>/nasim_gazi/payment_ad_wise.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin Payments</p>
                      </a>
                    </li> -->

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/bijoy/payment.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Marketing Payments </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/payament_dealer.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payment Dealer wise</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Leads</p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- <li class="nav-item">
                      <a href="<?php echo $base_url ?>/Alamin/leads.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin Leads </p>
                      </a>
                    </li> -->

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/R_leads.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Marketing Leads</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/lead_list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List of leads manager</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nobel/leads.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Lead</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/ledger.php" class="nav-link ">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Ledger</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php } ?>
          <!-- hanki panki --> 
          <!-- hanki panki --> 
          <!-- hanki panki --> 
          <?php if ($_SESSION['role'] == "marketing") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add New Access</p>
                    </a>
                  </li>
                </ul>
              </li>

    

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Dealer</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Dealer</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/t_dealer_list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer List</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Manage</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/payament_dealer.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payment Dealer wise</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Leads</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/lead_list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List of leads</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nobel/leads.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Lead</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>
              </li>
            </ul>
          <?php } ?>
        <!-- </li> -->

        <!-- agnj -->
        <!-- agnj -->
        <!-- agnj -->
        <!-- agnj -->
        <?php if ($_SESSION['role'] == "dealer") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add New Access</p>
                    </a>
                  </li>
                </ul>
              </li>

      
           

                  <!-- <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/dealer_create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Manage</p>
                    </a>
                  </li>
                </ul>
              </li> -->

           

              <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <i class="fas fa-calculator"></i>
                  <p>Invoice</p>
                </a>

                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sharmin/customer_invoice.php" class="nav-link">
                    <i class="fas fa-calculator"></i>
                      <p>Customer_Invoice</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sharmin/list_customer_invoice.php" class="nav-link">
                    <i class="fas fa-calculator"></i>
                      <p>list_Customer_Invoice</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- <li class="nav-item dropdown ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>
              </li> -->
            </ul>
          <?php } ?>
        </li>


      
        <!-- agnj -->
        <!-- agnj -->
        <!-- agnj -->
        





        <li class="nav-item">
          <a href="<?php echo $base_url ?>/logout.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>