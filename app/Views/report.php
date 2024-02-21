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
<!-- End Navbar -->
<div class="container-fluid py-4 mt-6">
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">language</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize font-weight-bolder"><a href="country_report">Country vise
                                report</a></p>
                        <h4 class="mb-0">
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <canvas id="barChart" width="400" height="200"></canvas>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                const ctx = document.getElementById('barChart').getContext('2d');
                                const countryData = <?= json_encode($country_lead_joins); ?>; // Convert PHP array to JavaScript array
                                console.log(countryData)
                                const labels = countryData.map(item => item.name);
                                const leadCounts = countryData.map(item => item.leadcount);
                                const convertedCounts = countryData.map(item => item.convertedcount);
                                const data = {
                                    labels: labels,
                                    datasets: [
                                        {
                                            label: leadCounts,
                                            data: [12, 19, 3, 5, 2],
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1,
                                        },
                                        {
                                            label: convertedCounts,
                                            data: [6, 12, 8, 14, 7], // Replace with your second data set
                                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                            borderColor: 'rgba(255, 159, 64, 1)',
                                            borderWidth: 1,
                                        },
                                    ],
                                };

                                const config = {
                                    type: 'bar',
                                    data: data,
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                            },
                                        },
                                    },
                                };

                                const myChart = new Chart(ctx, config);
                            </script>

                        </h4>
                    </div>
                </div>
                
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">today</i>
                    </div>
                    <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize font-weight-bolder"><a href="month_report">Month vise
                                report</a></p>
                <h4 class="mb-0">
                    <?php
                    // Create data points for the chart
                    $dataPoints = array();
                    $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

                    // Assuming you have an array of monthwise leads from the new method
                    $leadCounts = array_fill(1, 12, 0); // Initialize with zeros

                    foreach ($monthwiseleads as $lead) {
                        $thisMonth = intval($lead['month']);

                        // Increment the count for the corresponding month
                        $leadCounts[$thisMonth]++;
                    }

                    for ($i = 0; $i < count($months); $i++) {
                        $dataPoints[] = array("label" => $months[$i], "y" => $leadCounts[$i + 1]);
                    }
                    ?>
                    <div id="chartContainer" style="height: 400px; width: 100%; margin-top: 20px;"></div>

                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                animationEnabled: true,
                                title: {
                                    text: ""
                                },
                                subtitles: [{
                                    text: ""
                                }],
                                data: [{
                                    type: "pie",
                                    yValueFormatString: "#,##0.",
                                    indexLabel: "{label} ({y})",
                                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            chart.render();
                        });
                    </script>
                </h4>
            </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                </div>
            </div>
        </div>


        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-5">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize font-weight-bolder"><a href="presented_report">Presented
                                By report</a></p>
                        <h4 class="mb-0">
                            <div class="table-responsive p-0 mt-5">
                                <table class="table align-items-center  mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Sl No</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Name</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Total Leads</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Converted Leads</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="row42" style="font-size:20px;">
                                            <td style="text-align:center; font-size:16px;">1</td>
                                            <td style="text-align:center; font-size:16px;">Nadeer Vk</td>
                                            <td style="text-align:center; font-size:16px;">12</td>
                                            <td style="text-align:center; font-size:16px;">4</td>
                                            
                                        </tr>
                                        <tr id="row42" style="font-size:20px;">
                                            <td style="text-align:center; font-size:16px;">2</td>
                                            <td style="text-align:center; font-size:16px;">Suhair Aikkara</td>
                                            <td style="text-align:center; font-size:16px;">8</td>
                                            <td style="text-align:center; font-size:16px;">4</td>
                                           

                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </h4>
                    </div>
                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
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