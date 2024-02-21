<?php include "header.php" ?>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white" style="margin-left: 10px;">User Wise Report</h5>
                <div class="multisteps-form__progress">
                </div>
            </div>
        <hr class="dark horizontal my-0">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-5">
            <div class="card">
                <div class="card-header p-3 pt-2">
                   
                    <div class="text-end pt-1">
                     
                        <h4 class="mb-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center  mb-0">
                                    <thead>
                                        <tr>
            
                                            <th class="text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                
                                                 Name</th>
                                           
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Total Leads</th>
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Total Demo</th>

                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Converted Leads</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                               Convertion Rate (in %)</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    foreach( $users as $user ): ?>
                                    <tr id="row42" style="font-size:20px;">
                                        <td style="text-align: center; font-size: 16px;">
                                            <?= $user['username'] ?>
                                           
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                            <?= $user['totalleads'] ?>
                                           
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                            <?= $user['demogiven'] ?>
                                           
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                            <?= $user['covertedleads'] ?>
                                           
                                        </td>
                                        <td style="text-align:center; font-size:16px;">
                                                Demo Wise : <span><?= number_format($user['demo_conversion_rate'], 2) ?></span> <br>
                                                Total Lead Wise : <span><?= number_format($user['lead_conversion_rate'], 2) ?></span>
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
<?php include "footer.php" ?>