<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php include "header.php" ?>
<style>
h6 {
    font-size: 15px;
}

.red {
    color: #e91e63;
    ;
}

.hover-info {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.hover-info::before {

    content: attr(data-info);
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #f8f9fa;
    padding: 5px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    z-index: 1;
    display: none;
}
.raw-1{
  margin-bottom: 20px;
}

.hover-info:hover::before {
    display: flex;
}
</style>
<style>
    .message-container {
        display: flex;
        justify-content: flex-start;
        margin: 10px 10px 20px 10px;
    }

    .message-box {
        position: relative;
        max-width: 400px;
        padding: 10px;
        margin-top: auto; /* Move the box to the bottom */
        background-color:  #d1edbb; /* Change background color as needed */
        border-radius: 10px;
        font-family: 'Helvetica', sans-serif; /* Change font as needed */
    }

    .message-box::before {
        content: '';
        position: absolute;
        bottom: -10px; /* Adjust the distance from the bottom */
        left: 0; /* Start from the left */
        border-width: 10px;
        border-style: solid;
        border-color: transparent transparent transparent  #d1edbb; /* Match the background color */
    }
</style>
<!-- End Navbar -->

<div class="container-fluid fixed-start py-4 mt-5">
    <div class="row">
    <?php if( !empty($call_details )): ?>   
    <div class="message-container">
    <div class="message-box" onclick="window.location.href='<?= base_url('call-details') ?>';">
        <?php
        if(count($call_details) == 1 ):?>
        <p><strong><?= count($call_details);?></strong> follow-up for today </p>
        <?php else : ?>
         <p><strong><?= count($call_details);?></strong> follow-up for today </p>
         <?php endif; ?>
    </div>
    </div>
    <?php endif;?>
        <div class="row raw-1">
            <div class="col-xl-12 col-md-12">
                <div class="alert " role="alert" style="background-color:white;">
                    <strong style="color:green;">TODAY DEMO SCHEDULED !! <i
                            class="ni ni-favourite-28"></i></strong> <br>
                            <div class="table-responsive p-0">
                                        <table class="table align-items-center  mb-0">
                                            <thead>
                                                <tr>  <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        SN</th>
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Customer Name</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Contact Details</th>
                                            
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Language</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Time</th>

                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Industry</th> 
                                                       
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Assigned</th>  
                                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  <?php
                                                  $i=1;
                                                  $today=date('Y-m-d');
                                                  foreach ($today_demo_assigned as $today_demo) :
                                                    if ($today_demo->postponed_date == $today) {
                                                ?>
                                                        <tr id="row42" style="font-size:20px;">
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $i++ ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <a href="view-more/<?= $today_demo->lead_id ?>"> <?= $today_demo->customer_name ?></a>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <span><?= $today_demo->email ?></span><br>
                                                                <span class="text-dark" style=" font-size: 14px;"><?= $today_demo->mobile_number ?></span>
                                                                <span></span>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $today_demo->language ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">

                                                                <?= $today_demo->postponed_time ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $today_demo->industry_type ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                By <?= $today_demo->assigned_by ?><br>
                                                                To <?= $today_demo->presented_by_username ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    } else if ($today_demo->demo_date == $today) {
                                                ?>
                                                        <tr id="row42" style="font-size:20px;">
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $i++ ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <a href="view-more/<?= $today_demo->lead_id ?>"> <?= $today_demo->customer_name ?></a>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <span><?= $today_demo->email ?></span><br>
                                                                <span class="text-dark" style=" font-size: 14px;"><?= $today_demo->mobile_number ?></span>
                                                                <span></span>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $today_demo->language ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $today_demo->demo_time ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $today_demo->industry_type ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                By <?= $today_demo->assigned_by ?><br>
                                                                To <?= $today_demo->presented_by_username ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                endforeach;
                                                ?>
                                                  </tbody>
                                              </table>
                                            </div>
                                      </div>
        </div>
                </div>
                

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">today</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-md mb-0 text-capitalize font-weight-bolder">TODAY</p>
                        <h6 class="mb-0 ">Total Leads : <?=$daily_leads?> <span class="hover-info" data-info="Yesterday"
                                style="color: #007bff;">(<?=$yesterday_leads?>)</span> /<span class="red">
                                <?=$todaylead_byId?></span><span class="red"> (<?=$yesterdaylead_byId?>)</span></h6>
                        <h6 class="mb-0">Total Demos : <?= $daily_demo ?> <span class="hover-info" data-info="Yesterday"
                                style="color: #007bff;">(<?=$yesterday_demo?>)</span> /<span class="red">
                                <?=$todaydemo_byId?></span><span class="red"> (<?=$yesterdaydemo_byId?>)</span></h6>
                        <h6 class="mb-0">Total Closed : <?= $daily_closing ?> <span class="hover-info"
                                style="color: #007bff;" data-info="Yesterday ">(<?=$yesterday_closed?>)</span> /<span
                                class="red"> <?=$todayclosed_byId?></span><span class="red">
                                (<?=$yesterdayclosed_byId?>)</span></h6>

                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">date_range</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-md mb-0 text-capitalize font-weight-bolder">THIS MONTH</p>
                        <h6 class="mb-0 ">Total Leads : <?=$monthwise_leads?> <span class="hover-info"
                                data-info="Last Month " style="color: #007bff;">(<?=$lastmonth_leads?>)</span> /<span
                                class="red"> <?=$monthlylead_byId?></span><span class="red">
                                (<?=$lastmonthlead_byId?>)</span></h6>
                        <h6 class="mb-0">Total Demos : <?= $monthwise_demo ?> <span class="hover-info"
                                data-info="Last Month " style="color: #007bff;">(<?=$lastmonth_demo?>)</span> /<span
                                class="red"> <?=$monthlydemo_byId?></span><span class="red">
                                (<?=$lastmonthdemo_byId?>)</span></h6>
                        <h6 class="mb-0">Total Closed : <?= $monthwise_closing ?> <span class="hover-info"
                                data-info="Last Month" style="color: #007bff;">(<?=$lastmonth_closed?>)</span> /<span
                                class="red"> <?=$monthlyclosed_byId?></span><span class="red">
                                (<?=$lastmonthclosed_byId?>)</span></h6>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">access_time</i>
                    </div>
                    <div class="text-end pt-1 ">
                        <p class="text-md mb-0 text-capitalize font-weight-bolder">LIFE LONG</p>
                        <h4 class="mb-0">
                            <h6 class="mb-0 ">Total Leads : <span style="color: #007bff;"><?= $alls?></span></h6>

                            <h6 class="mb-0">Total Demos : <span
                                    style="color: #007bff;"><?= $demo_assigneds?></span></h6>
                            <h6 class="mb-0">Total Closed : <span style="color: #007bff;"><?=$total_closed?></span></h6>
                        </h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
                </div>
            </div>
        </div>
        <div class="row raw-1 mt-5">
            <div class="col-xl-12 col-md-12">
                <div class="alert " role="alert" style="background-color:white;">
                    <strong style="color:green;"><i
                            class="ni ni-favourite-28"></i></strong> <br>
                            <div class="table-responsive p-0">
                                        <table class="table align-items-center  mb-0">
                                            <thead>
                                                <tr> 
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:left;">
                                                        Description</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Total leads
                                                    </th>
                                            
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        My leads
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("viewall-leads")?>"> Total Leads
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $alls ?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $all ?>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("newlead")?>"> New Leads
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $newlead ?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $newleads ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("respondedlead") ?>"> Responded Leads
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                        <?= $respondeds ?>
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $responded ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("notrespondedlead") ?>"> Not Responded
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $not_respondeds ?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $not_responded ?>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("demo-assigned")?>"> Demo Assigned
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $demo_assigned_only ?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $demo_assigned ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("demo-completed") ?>"> Demo Completed
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $demo_completed_only ?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $demo_completed ?>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("demo-aborted") ?>"> Demo Aborted
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $demo_aborteds ?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $demo_aborted ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                        <td style="text-align:left; font-size:16px;">
                                                          
                                                        <a href="<?= base_url("payment-received") ?>"> Payment Received
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                          <span  ><?= $payment?></span><br> 
                                                        <span></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                        <?= $payments ?>
                                                        </td>
                                                    </tr>

                                                    <tr id="row42" style="font-size:20px;">
                                                    
                                                    <td style="text-align:left; font-size:16px;">
                                                      
                                                    <a href="<?= base_url("delivered-leads")?>"> Delivered Leads
                                                    </td>
                                                    <td style="text-align:center; font-size:16px;">
                                                      <span  ><?= $delivereds?></span><br> 
                                                    <span></span>
                                                    </td>
                                                    <td style="text-align:center; font-size:16px">
                                                    <?= $delivered ?>
                                                    </td>
                                                </tr>
                                              
                                                  </tbody>
                                              </table>
                                            </div>
                                      </div>
        </div>
                </div>
        
        <div class="col-xl-4 col-sm-6 mb-xl-0 mt-6">
            <div class="card">
                <a href="new-tickets">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize font-weight-bolder">New Support Tickets</p>
                            <h4 class="mb-0">
                                <?= count($all_ticket) ?>
                            </h4>
                        </div>
                    </div>
                </a>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mt-6">
            <div class="card">
                <a href="active-tickets">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize font-weight-bolder">Active Support Tickets</p>
                            <h4 class="mb-0">
                                <?= count($active_tickets) ?>
                            </h4>
                        </div>
                    </div>
                </a>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-0 mt-6">
            <div class="card">
                <a href="closed-tickets">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-danger shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">block</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize font-weight-bolder">Closed Support Tickets</p>
                            <h4 class="mb-0">
                                <?= count($closed_tickets) ?>
                            </h4>
                        </div>
                    </div>
                </a>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
                </div>
            </div>
        </div>

        



    </div>
    <?php include "footer.php" ?>
</div>
</main>

<!--   Core JS Files   -->
<script src="./assets/js/core/popper.min.js"></script>
<script src="./assets/js/core/bootstrap.min.js"></script>
<script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="./assets/js/plugins/chartjs.min.js"></script>
<script>
var ctx = document.getElementById("chart-bars").getContext("2d");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
            label: "Sales",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "rgba(255, 255, 255, .8)",
            data: [50, 20, 10, 22, 50, 10, 40],
            maxBarThickness: 6
        }, ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5],
                    color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 500,
                    beginAtZero: true,
                    padding: 10,
                    font: {
                        size: 14,
                        weight: 300,
                        family: "Roboto",
                        style: 'normal',
                        lineHeight: 2
                    },
                    color: "#fff"
                },
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5],
                    color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                    display: true,
                    color: '#f8f9fa',
                    padding: 10,
                    font: {
                        size: 14,
                        weight: 300,
                        family: "Roboto",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});


var ctx2 = document.getElementById("chart-line").getContext("2d");

new Chart(ctx2, {
    type: "line",
    data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0,
            borderWidth: 0,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255, 255, 255, .8)",
            pointBorderColor: "transparent",
            borderColor: "rgba(255, 255, 255, .8)",
            borderColor: "rgba(255, 255, 255, .8)",
            borderWidth: 4,
            backgroundColor: "transparent",
            fill: true,
            data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
            maxBarThickness: 6

        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5],
                    color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                    display: true,
                    color: '#f8f9fa',
                    padding: 10,
                    font: {
                        size: 14,
                        weight: 300,
                        family: "Roboto",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#f8f9fa',
                    padding: 10,
                    font: {
                        size: 14,
                        weight: 300,
                        family: "Roboto",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});

var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

new Chart(ctx3, {
    type: "line",
    data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0,
            borderWidth: 0,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255, 255, 255, .8)",
            pointBorderColor: "transparent",
            borderColor: "rgba(255, 255, 255, .8)",
            borderWidth: 4,
            backgroundColor: "transparent",
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5],
                    color: 'rgba(255, 255, 255, .2)'
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#f8f9fa',
                    font: {
                        size: 14,
                        weight: 300,
                        family: "Roboto",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#f8f9fa',
                    padding: 10,
                    font: {
                        size: 14,
                        weight: 300,
                        family: "Roboto",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});
</script>
<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>