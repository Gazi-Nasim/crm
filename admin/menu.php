<?php
$base_url = "http://localhost/crm/admin";
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo $base_url ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
        <a href="#" class="d-block"> <?php echo $_SESSION['username'] ?>
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
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "admin") { echo "menu-open"; } ?> ">
                <a href="#" class="nav-link ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item dropdown ">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "new_acs") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon "></i>
                      <p>Add New Access</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "products") { echo "menu-open active"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Products</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item  ">
                    <a href="<?php echo $base_url ?>/ashraful/products.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "asr_pdtcs") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "admin_target") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Targets</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item " >
                    <a href="<?php echo $base_url ?>/mamun/admin_target.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ad_trgt_active") { echo "active_one"; } ?>">
                      <i class="fas fa-calculator"></i>
                      <p >Create Admin Target</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/admin_target_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ad_trgt_list") { echo "active_one"; } ?>">
                      <i class="fas fa-calculator"></i>
                      <p>Admin Target List</p>
                    </a>
                  </li>

                  <li class="nav-item ">
                    <a href="<?php echo $base_url ?>/alamin/marketing_target.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "manager_trgt") { echo "active_one"; } ?>">
                      <i class="fas fa-calculator"></i>
                      <p>Create Manager Target</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "invoice") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Invoice</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sifath/create_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "sif_crt_inv") { echo "active_one"; } ?>">
                      <i class="fas fa-calculator"></i>
                      <p>Create Invoice </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sharmin/list_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "srm_invo_list") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Invoice List</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "payment") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/payment_insert.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt-pmnt") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Insert Payment</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/payment_ad_wise.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "nas_ad_pay") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Wise</p>
                    </a>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="<?php echo $base_url ?>/bijoy/payment.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "mr_pay") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Marketing Wise </p>
                    </a>
                  </li> -->
                  
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/payment_sa_Wise.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ad_to_pay") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin to Marketing Wise</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/payament_dealer.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dealer_pay") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Wise</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/due_payment.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dealer_due") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Due</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "dealer") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Dealer</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/dealer_create.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_dlr_taw") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Dealer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/t_dealer_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_list") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealers List</p>
                    </a>
                  </li>


                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "leads") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Leads</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/Alamin/leads.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ala_leads") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Leads </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/R_leads.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "leas_mngr") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manager Leads</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/lead_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "lead_Rlist") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List of leads manager</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nobel/leads.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_lead_Nbl") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Lead</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "report") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link" id="angleRight">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/ledger.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ledgr_nas") { echo "active_one"; } ?>">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Dealer Ledger</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mahmud/customer_ledger.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ledgr_cstmr") { echo "active_one"; } ?>">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Customer Ledger</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/bijoy/admin_report.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "amnTrgt_bjy") { echo "active_one"; } ?>">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Admin Target</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sifath/m_manager_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "mngr_lst_sft") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manager Target</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/opu/dealer_achievement.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_acvmnt") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Target</p>
                    </a>
                  </li>


                </ul>

              </li>
            </ul>
          <?php } ?>

          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->

          <?php if ($_SESSION['role'] == "admin") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "admin") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item dropdown ">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "new_acs") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon "></i>
                      <p>Add New Access</p>
                    </a>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mahmud/marketing.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_mr") { echo "active_one"; } ?>  ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Creat Marketing Manager</p>
                    </a>
                  </li> -->

                </ul>                 
                
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "products") { echo "menu-open active"; } ?> ">
                <a href="#" class="nav-link  ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Products</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/ashraful/products.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "asr_pdtcs") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "invoice") { echo "menu-open active"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Invoice</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/crt_mrkting_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_mr_in") { echo "active_one"; } ?> ">
                      <i class="fas fa-calculator"></i>
                      <p>Create Invoice</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sharmin/list_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "srm_invo_list") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Invoice List</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "dealer") { echo "menu-open active"; } ?>">
                <a href="#" class="nav-link ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Dealer</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/dealer_create.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_dlr_taw") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Dealer</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/tawhid/t_dealer_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_list") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealers List</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/dealer_create.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_dlr") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Manage</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "admin_target") { echo "menu-open active"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Targets</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/alamin/marketing_target.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "manager_trgt") { echo "active_one"; } ?> ">
                      <i class="fas fa-calculator"></i>
                      <p>Manager Target</p>
                    </a>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="<?php echo $base_url ?>/ashraful/" class="nav-link">
                      <i class="fas fa-calculator"></i>
                      <p>Dealer Target</p>
                    </a>
                  </li> -->


                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "payment") { echo "menu-open active"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/bijoy/payment.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "mr_pay") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Marketing Payments </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/payament_dealer.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dealer_pay") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payment Dealer Wise</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "leads") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Leads</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/R_leads.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "leas_mngr") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon  "></i>
                      <p>Manager Leads</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/lead_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "lead_Rlist") { echo "active_one"; } ?>  ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List of leads manager</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nobel/leads.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_lead_Nbl") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Lead</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "report") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/ledger.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ledgr_nas") { echo "active_one"; } ?>">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Ledger</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/sifath/m_manager_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "mngr_lst_sft") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manager Target</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php } ?>
          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->
          <!-- hanki panki -->
          <?php if ($_SESSION['role'] == "marketing") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "admin") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Users</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/admin.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "new_acs") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon "></i>
                      <p>Add New Access</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "dealer") { echo "menu-open"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Dealer</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/t_dealer_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_lst_mun") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mamun/dealer_create.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_dlr") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Manage</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "target") { echo "menu-open"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Targets</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/ashraful/dealer_target.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_trgt") { echo "active_one"; } ?>">
                      <i class="fas fa-calculator"></i>
                      <p>Target</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu_in"] == "dealer_pay") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/payament_dealer.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dealer_pay") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dealer Wise</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "leads") { echo "menu-open"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Leads</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/lead_list.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "lead_Rlist") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List of leads</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nobel/leads.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_lead_Nbl") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon "></i>
                      <p>Dealer Lead</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "report") { echo "menu-open"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mahmud/customer_ledger.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ledgr_cstmr") { echo "active_one"; } ?>">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Ledger</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/opu/dealer_achievement.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "dlr_acvmnt") { echo "active_one"; } ?> ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Target</p>
                    </a>
                  </li>
                </ul>

              </li>
            </ul>

          <?php } ?>
          <?php if ($_SESSION['role'] == "dealer") { ?>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "customer") { echo "menu-open"; } ?> ">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Customer</p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/customer_create.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_cstmr") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create New</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "invoice") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Invoice</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item <?php if ($_SESSION["mnu_f"] == "invoice_per") { echo "menu-open"; } ?> ">
                    <a class="nav-link">
                      <i class="right fas fa-angle-right"></i>
                      <p>Performa</p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo $base_url ?>/sharmin/customer_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_parforma") { echo "active_one"; } ?> ">
                          <i class="fas fa-calculator"></i>
                          <p>Create</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo $base_url ?>/sharmin/list_customer_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "cstmr_list_sr") { echo "active_one"; } ?> ">
                          <i class="fas fa-calculator"></i>
                          <p>List</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/nasim_gazi/crt_cstmr_invoice.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "crt_payable") { echo "active_one"; } ?> ">
                      <i class="fas fa-calculator"></i>
                      <p>Payable</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "payment") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link  ">
                  <i class="right fas fa-angle-left"></i>
                  <p>Payments</p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/amran/customer_payment.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "cstmr_pmnt") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Customer Wise</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/rubel/customer_due_payment.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "cstmr_due") { echo "active_one"; } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Due</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php if ($_SESSION["mnu"] == "report") { echo "menu-open"; } ?>">
                <a href="#" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p>Report</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $base_url ?>/mahmud/customer_ledger.php" class="nav-link <?php if ($_SESSION["mnu_in"] == "ledgr_cstmr") { echo "active_one"; } ?> ">
                      <i class="fa fa-calculator nav-icon"></i>
                      <p>Ledger</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php } ?>

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