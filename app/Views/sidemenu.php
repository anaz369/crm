<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
  .navbar-vertical .navbar-nav .nav-link>i {
    min-width: 1.8rem;
    font-size: 14px;
    line-height: 1.5rem;
    text-align: center;
}
ul.nav-submenu {
    font-size: 0px;
}
.icon{
    font-size: 12px;
    color: darkgrey;
    margin-left: 34px;
}
</style>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
<div class="sidenav-header">
<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
<a class="navbar-brand m-0" href="<?= base_url("dashboard")?>">
<img src="<?= base_url()?>assets/img/logos/ethicfin-logo-white.png" class="navbar-brand-img h-100" alt="main_logo">
</a>
</div>
<div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
<ul class="navbar-nav">
<!-- <li class="nav-item mb-2 mt-0">
<a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
<img src="../../assets/img/team-3.jpg" class="avatar">
<span class="nav-link-text ms-2 ps-1">Brooklyn Alice</span>
</a> -->
<div class="collapse" id="ProfileNav" style>
<ul class="nav ">
<li class="nav-item">
<a class="nav-link text-white" href="../../pages/pages/profile/overview.html">
<span class="sidenav-mini-icon"> MP </span>
<span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
</a>
</li>
<li class="nav-item">
<a class="nav-link text-white " href="../../pages/pages/account/settings.html">
<span class="sidenav-mini-icon"> S </span>
<span class="sidenav-normal  ms-3  ps-1"> Settings </span>
</a>
</li>
<li class="nav-item">
<a class="nav-link text-white " href="../../pages/authentication/signin/basic.html">
<span class="sidenav-mini-icon"> L </span>
<span class="sidenav-normal  ms-3  ps-1"> Logout </span>
</a>
</li>
</ul>
</div>
</li>
<hr class="horizontal light mt-0">
<?php 
    $role = session('user_type');
    if (in_array($role, [0, 1])):
?>
<li class="nav-item active">
<a style="background-image: linear-gradient(195deg,#e91e63,#e91e63);" class="nav-link text-white active" href="<?= base_url("createlead") ?>">
<i class="fa-solid fa-plus"></i>
<span class="sidenav-normal  ms-2  ps-1">Create Lead</span>
</a>
</li>
<?php endif;?>

<?php 
    $role = session('user_type');
    if (in_array($role, [0, 1])):
?>
<li class="nav-item active">
<a style=" background: dodgerblue;" class="nav-link text-white active" href="<?= base_url("dashboard")?>">
<i class="material-icons opacity-10">dashboard</i>
<span class="sidenav-normal  ms-2  ps-1">Dashboard</span>
</a>
</li>
<?php endif; ?>

<?php 
    $role = session('user_type');
    if (in_array($role, [0, 1])):
?>
<li class="nav-item">
    <a href="javascript:void(0);" class="nav-link text-white" onclick="toggleManageLeads()">
        <i id="manageLeadsIcon" class="fa fa-folder"></i>
        <span class="nav-link-text ms-2 ps-1">Manage Leads</span>
        <i  style="font-size: 12px;" class="fa-solid fa-chevron-down icon"></i>
    </a>
    <div class="collapse" id="manageLeads">
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("viewall-leads")?>">
                <i class="fa fa-eye"></i>
                    <span class="sidenav-normal  ms-2  ps-1">All Leads</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("prioritized-leads")?>">
                <i class="fas fa-heart"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Hot Leads</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("newlead")?>">
                <i class="material-icons text-white opacity-10" style="font-size: 18px; ">
                  fiber_new
                </i>
                 <span class="sidenav-normal  ms-2  ps-1">New Leads</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("respondedlead") ?>">
                <i class="fa fa-reply"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Responded</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("notrespondedlead") ?>">
                <i class="material-icons">close</i>
                    <span class="sidenav-normal  ms-2  ps-1">Not Responded</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("demo-assigned")?>">
                <i class="fa fa-check"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Demo Assigned</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("demo-completed") ?>">
                <i class="fa fa-thumbs-up"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Demo Completed</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("demo-aborted") ?>">
                <i class="fa fa-ban"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Demo-Aborted</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("invoice-sent") ?>">
                <i class="fa-solid fa-file-invoice"></i>
                    <span class="sidenav-normal  ms-2  ps-1">invoice Sent Leads</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("offer-mailsent") ?>">
                <i class="fa-solid fa-envelope"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Offer Mail Sent Leads</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("trial-account") ?>">
                <i class="fi fi-rr-calendar-clock"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Trial Account Sent</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("demo-video") ?>">
                <i class="material-icons text-white text-lg opacity-10" style="font-size: 20px;" >
                <span class="material-symbols-outlined">
                  play_circle
                </span>
                </i>
                    <span class="sidenav-normal  ms-2  ps-1">Demo Video Sent Leads</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("lost-leads") ?>">
                <i class="material-icons text-white text-lg opacity-10" style="font-size: 20px;" >
                <span class="material-symbols-outlined">
                  delete_forever
                </span>
                </i>
                    <span class="sidenav-normal  ms-2  ps-1">Lost Leads</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("payment-received") ?>">
                <i class="material-icons"> attach_money</i>
                    <span class="sidenav-normal  ms-2  ps-1">Payment Received</span>
                    
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("delivered-leads")?>">
                  <i class="fa fa-truck"></i>
                    <span class="sidenav-normal  ms-2  ps-1">Delivered leads</span>
                    
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("viewdaily-leads")?>">
                  <i class="fa fa-folder-open"></i>
                  <span class="sidenav-normal  ms-2  ps-1">Daily Plan</span>      
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("support-team")?>">
                
                                    <i class="material-icons text-white text-lg opacity-10" style="font-size: 20px;" >
                                      support_agent
                                    </i>
                                    
                  <span class="sidenav-normal  ms-2  ps-1">Support team</span>      
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="<?= base_url("campaign-list")?>">
                
                                    <i class="material-icons text-white text-lg opacity-10" style="font-size: 20px;" >
                                   <span class="material-symbols-outlined">
                                    campaign
                                    </span>
                                    </i>
                                    
                  <span class="sidenav-normal  ms-2  ps-1">Campaign ID List</span>      
                </a>
            </li>
        </ul>
    </div>
</li>
<?php endif;?>
  <?php 
    $role=session('user_type');
    if($role== 0):                                                  
  ?>
  <li class="nav-item">
      <a data-bs-toggle="collapse" href="javascript:void(0);" class="nav-link text-white" onclick="toggleManageUsers()" >
        <i class="fa fa-user"></i>
          <span class="nav-link-text ms-2 ps-1">Manage User</span>
      </a>
      <div class="collapse" id="manageUsers">
          <ul class="nav">
              <!-- User-related links -->
              <li class="nav-item active">
                  <a class="nav-link text-white" href="<?= base_url("createuser") ?>">
                  <i class="fa fa-user"></i>
                      <span class="sidenav-normal  ms-2  ps-1">Create User</span>
                  </a>
              </li>
              <li class="nav-item active">
                  <a class="nav-link text-white" href="<?= base_url("listuser") ?>">
                  <i class="fa fa-user"></i>
                      <span class="sidenav-normal  ms-2  ps-1">List User</span>
                  </a>
              </li>

              <!-- Other user-related links -->
          </ul>
      </div>
  </li>
  

<?php endif;?>
<li class="nav-item">
      <a  href="<?= base_url('passwordchange') ?>" class="nav-link text-white" >
      <i class="material-icons text-white opacity-10" style="font-size: 22px;">
    lock_reset
  </i>

          <span class=" ms-2 ps-1">Change Password</span>
      </a>
  </li>


<li class="nav-item">
<hr class="horizontal light" />
<!-- <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">DOCS</h6> -->
</li>
<?php 
    $role = session('user_type');
    if (in_array($role, [0, 1])):
?>
<li class="nav-item">
<a data-bs-toggle="collapse" href="javascript:void(0);" class="nav-link text-white" onclick="toggleManageTickets()">
<i class="material-icons opacity-10">confirmation_number</i>
  <span class="nav-link-text ms-2 ps-1">Tickets</span>
</a>
<div class="collapse " id="basicExamples">
<ul class="nav ">
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("new-tickets") ?>">
  <i class="material-icons opacity-10">confirmation_number</i>
    <span class="sidenav-normal  ms-2  ps-1"> New <b class="caret"></b></span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("active-tickets") ?>">
  <i class="material-icons opacity-10">confirmation_number</i>
    <span class="sidenav-normal  ms-2  ps-1"> Active <b class="caret"></b></span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("closed-tickets") ?>">
  <i class="material-icons opacity-10">confirmation_number</i>
    <span class="sidenav-normal  ms-2  ps-1"> Closed <b class="caret"></b></span>
  </a>
</li>
</ul>
</div>
</li>
<?php endif;?>

<?php 
    $role=session('user_type');
    if($role == 2):                                                  
?>
<li class="nav-item">
<a data-bs-toggle="collapse" href="javascript:void(0);" class="nav-link text-white" onclick="toggleManageTickets()">
<i class="material-icons opacity-10">confirmation_number</i>
  <span class="nav-link-text ms-2 ps-1">Tickets</span>
</a>
<div class="collapse " id="basicExamples">
<ul class="nav ">
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("ticket")?>">
    <i class="material-icons opacity-10">confirmation_number</i>
    <span class="sidenav-normal  ms-2  ps-1">Rise Ticket<b class="caret"></b></span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("list_ticket") ?>">
    <i class="material-icons opacity-10">confirmation_number</i>
    <span class="sidenav-normal  ms-2  ps-1"> List Ticket <b class="caret"></b></span>
  </a>
</li>
</ul>
</div>
</li>
<li class="nav-item">
<a class="nav-link" href="<?= base_url("change-cuspass") ?>">
<i class="fa-solid fa-lock"></i>
<span class="nav-link-text ms-2 ps-1">Change Password</span>
</a>
</li>

<?php endif;?>


<?php 
    $role=session('user_type');
    if($role== 0):                                                  
?>
<li class="nav-item">
<a data-bs-toggle="collapse" href="javascript:void(0);" class="nav-link text-white" onclick="toggleManageReport()">
<i class="material-icons text-white opacity-10" style="font-size: px;">
    summarize
  </i>
  <span class="nav-link-text ms-2 ps-1">Report</span>
</a>
<div class="collapse " id="basicExamples2">
<ul class="nav ">
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("country_report") ?>">
  <i class="fa-solid fa-globe"></i>
    <span class="sidenav-normal  ms-2  ps-1"> Country WIse Report <b class="caret"></b></span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("month_report") ?>">
  <i class="fa-solid fa-calendar-days"></i>
    <span class="sidenav-normal  ms-2  ps-1"> Month WIse Report <b class="caret"></b></span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("userwise_report") ?>">
  <i class="material-icons text-white opacity-10" style="font-size: 18px;">
    group
  </i>
    <span class="sidenav-normal  ms-2  ps-1"> User WIse Report <b class="caret"></b></span>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("presented_report") ?>">
  <i class="material-icons"> query_stats</i>
    <span class="sidenav-normal  ms-2  ps-1"> Demo Wise Report <b class="caret"></b></span>
  </a>
</li>

<li class="nav-item ">
  <a class="nav-link text-white " aria-expanded="false" href="<?= base_url("payment_report") ?>">
  <i class="fa-solid fa-money-bill-transfer"></i>
    <span class="sidenav-normal  ms-2  ps-1"> Payment Report <b class="caret"></b></span>
  </a>
</li>
</ul>
</div>
</li>

<?php endif;?>
</ul>
</div>
</aside>

<script>
    function toggleManageLeads() {
        var manageLeadsDropdown = document.getElementById('manageLeads');
        var bsManageLeads = new bootstrap.Collapse(manageLeadsDropdown);
    }

    function toggleManageUsers() {
        var manageUsers = document.getElementById('manageUsers');
        var bsManageUsers = new bootstrap.Collapse(manageUsers);
    }

    function toggleManageTickets(){
        var manageTicket = document.getElementById('basicExamples');
        var bsManageTicket= new bootstrap.Collapse(manageTicket);
    }

    function toggleManageReport(){
        var manageTicket = document.getElementById('basicExamples2');
        var bsManageTicket= new bootstrap.Collapse(manageTicket);
    }
</script>
