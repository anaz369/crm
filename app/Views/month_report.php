<?php include "header.php" ?>
<style>
     #yearSelect {
        margin-left: 5px;
         padding: 4px 4px;
         outline: none;
        }

        /* Style the label */
        label {
            display: block;
            margin-bottom: 8px;
        }
</style>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white" style="margin-left: 10px;">Month wise Report</h5>
                <div class="multisteps-form__progress">
                </div>
            </div>
            <!-- <div
            class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">language</i>
          </div> -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('countryReportChart').getContext('2d');
                const countryData = <?= json_encode($country_lead_joins); ?>;

                const labels = countryData.map(item => item.name);
                const leadCounts = countryData.map(item => item.leadcount);
                const convertedCounts = countryData.map(item => item.convertedcount);
            </script>
            <div class="text-end pt-1">
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
            <form id="yearForm" action="<?= base_url('month_report')?>" method="get">
            <label for="yearSelect">Select Year:</label>
            <select name="year" id="yearSelect">
            <option <?php if(isset($year)): echo ($year == '2024') ? 'selected' : ''; endif?> value="2024">2024</option>
            <option <?php if(isset($year)): echo ($year == '2023') ? 'selected' : ''; endif ?> value="2023">2023</option>
        </select>

        </form>

         </form>
        </div>
        <hr class="dark horizontal my-0">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-5">
            <div class="card">
                <div class="card-header p-3 pt-2">
                   
                    <div class="text-end pt-1">
                     
                        <h4 class="mb-0">
                            <div class="table-responsive p-0 mt-5">
                                <table class="table align-items-center  mb-0">
                                    <thead>
                                        <tr>
            
                                            <th class="text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                 Month</th>
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Total Leads</th>

                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Demo Given</th>    

                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Converted Leads</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                               Convertion Rate (in%)</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                    
                                    foreach( $monthwiseleads as $leads ): ?>
                                        <tr id="row42" style="font-size:20px;">
                                        <td style="text-align: center; font-size: 16px;">
                                            <?= date("F", mktime(0, 0, 0, $leads['month'], 1)) ?>
                                        </td>
                                            <td style="text-align:center; font-size:16px;"><?=$leads['total_leads']?></td>
                                            <td style="text-align:center; font-size:16px;"><?=$leads['total_demo']?></td>
                                            <td style="text-align:center; font-size:16px;"><?=$leads['converted_leads']?></td>
                                            <td style="text-align:center; font-size:16px;">
                                                Demo Wise : <span><?= number_format($leads['conversion_rate2'], 2) ?></span> <br>
                                                Total Lead Wise : <span><?= number_format($leads['conversion_rate1'], 2) ?></span>
                                            </td>

                                        </tr>
                                        <?php endforeach;?>
                                       
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

<script>
    $(document).ready(function(){
        $('#yearSelect').on('change', function(){
            $('#yearForm').submit();
        });
    });
</script>
<?php include "footer.php" ?>