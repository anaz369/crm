<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url()?>assets/img/apple-icon.png">
  <link rel="stylesheet" type="text/css" href="assets/css/virtual-select.min.css">
  <link rel="icon" type="image/png" href="<?= base_url('./assets/img/logos/ethicfin-logo-white.png') ?>">
  <link id="pagestyle" href="https://accounts.ethicfin.com/asset/assets/css/material-dashboard.css?v=3.0.4"
    rel="stylesheet" />
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="path/to/select2.min.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
  <!-- Include jQuery (required for Select2) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Include Select2 JS -->
  <script src="path/to/select2.min.js"></script>

  
  <title>
    ETHICFIN
  </title>
  <!--     Fonts and icons     -->
  <style>
    .table tbody tr:last-child td, .table.align-items-center td, .table.align-items-center th {
      text-wrap: wrap;
  font-size:13px !important;
  }
  .fa, .fa-brands, .fa-classic, .fa-regular, .fa-sharp, .fa-solid, .fab, .far, .fas {
      font-size: 15px !important;
  }
    
    #logout-button {
      position: fixed;
      top: 0;
      width: 100%;
      background-color: #fff;
      padding-top: 15px;
      z-index: 1000;
      /* padding-left: 1146px; */
      height: 75px;
    }

    .form-control {
      padding-right: 5px;
      padding-left: 5px;
    }
  </style>

<body class="g-sidenav-show  bg-gray-200 white-version">
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-2" href="">
        <img src="<?= base_url('./assets/img/logos/ethicfin-logo-white.png') ?>" class="navbar-brand-img h-100"
          alt="main_logo">
        <span class="ms-1 font-weight-bold text-white"></span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto " id="sidenav-collapse-main">
    <div class="container py-1 px-3">
          
          <div class="fixed-top" id="welcome-logout">
            <div class="fixed-top text-end" id="logout-button">
            <div class="d-flex justify-content-between align-items-center">
                <div style="color: red; font-weight: bold; margin-left: 300px;">
                    <span>Welcome</span>
                    <span><?php echo session('username'), "...!"; ?></span>
                </div>
                <div>
                    <form method="get" action="<?= base_url('viewall-leads')?> " class="d-flex">
                        <input type="text" name="search" placeholder="Search..." style="margin-right: 2px;"
                              class="form-control">
                        <button class="btn bg-gradient-primary mb-1 mx-2" title="Filter" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>

                <div>
                    <a class="text-black info" href="<?= base_url('logout') ?>" style="margin-right: 5px;">
                        
                        <span>Logout</span>
                        <span><i class="material-icons" style="vertical-align: middle; font-size: 24px;">logout</i></span>
                    </a>
                    

                </div>
             </div>
            </div>
          </div>
        </div>
      <ul class="navbar-nav">
        <?php include('sidemenu.php'); ?>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div id="scrollable-navbar">
      
      <nav class="navbar navbar-main navbar-expand-lg mt-4 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
        id="navbarBlur" data-scroll="true">
      </nav>
    </div>
    <!-- End Navbar -->