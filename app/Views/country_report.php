<?php include "header.php" ?>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white" style="margin-left: 10px;">Country Vise Report</h5>
                <div class="multisteps-form__progress">
                </div>
            </div>
            <!-- <div
            class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">language</i>
          </div> -->
            <div class="text-end pt-1">
                <!-- <p class="text-sm mb-0 text-capitalize font-weight-bolder">Country vise report</p> -->
                <h4 class="mb-0">
                    <canvas id="countryReportChart" width="400" height="200"></canvas>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('countryReportChart').getContext('2d');
                        const countryData = <?= json_encode($country_lead_joins); ?>; // Convert PHP array to JavaScript array
                        console.log(countryData)
                        const labels = countryData.map(item => item.name);
                        const leadCounts = countryData.map(item => item.leadcount);
                        const convertedCounts = countryData.map(item => item.convertedcount);

                        const data = {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Total Leads',
                                    data: leadCounts,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                },
                                {
                                    label: 'Total Converted',
                                    data: convertedCounts,
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
                                        suggestedMin: 0,  // Set the minimum value for the y-axis
                                        suggestedMax: 25, // Set the maximum value for the y-axis
                                        stepSize: 5,
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
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-5">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <!-- <div
                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">group</i>
                    </div> -->
                    <div class="text-end pt-1">
                     
                        <h4 class="mb-0">
                            <div class="table-responsive p-0 mt-5">
                                <table class="table align-items-center  mb-0">
                                    <thead>
                                        <tr>
                                        <th class="text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                
                                                 Country</th>
                                            <th class="text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                
                                                 Leads</th>
                                           
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Responded</th>

                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Not Responded</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Demo Assigned</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Demo Completed</th>
                                             <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Converted</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($country_lead_joins as $join): ?>
                                        <tr id="row42" style="font-size:20px;">
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->name) ? $join->name : ''; ?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->leadcount) ? $join->leadcount : ''; ?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->respondedcount) ? $join->respondedcount : ''; ?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->notrespondedcount) ? $join->notrespondedcount : ''; ?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->demoassignedcount) ? $join->demoassignedcount : ''; ?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->democompletedcount) ? $join->democompletedcount : ''; ?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                <?php echo isset($join->convertedcount) ? $join->convertedcount : ''; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
</div>
<?php include "footer.php" ?>