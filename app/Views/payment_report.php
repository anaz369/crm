<?php include "header.php" ?>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white" style="margin-left: 10px;">Payment Wise Report</h5>
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
                                                
                                                Account Name</th>
                                           
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Total No of Order</th>
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Total Amount</th>

                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                               Operation</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    foreach( $payment_modes as $payment_mode ): ?>
                                    <tr id="row42" style="font-size:20px;">
                                        <td style="text-align: center; font-size: 16px;">
                                            <?= $payment_mode['payment_mode'] ?>
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                             <?= $payment_mode['count'] ?>
                                           
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                             <?= number_format($payment_mode['total_amount'],2) ?>
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                        <a href="view-paymentdetails/<?= $payment_mode['payment_mode'] ?>" title="view">
                                                                    <span
                                                                        style="cursor: pointer;" ">
                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="
                                                            fa fa-eye" title="view"
                                                                        style="font-size:20px;"></i>
                                                                    </span>
                                                                </a>
                                           
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