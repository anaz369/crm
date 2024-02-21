<?php include "header.php" ?>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white" style="margin-left: 10px;">Demo Wise Report</h5>
                <div class="multisteps-form__progress">
                </div>
            </div>
            <div class="card-body px-0 pb-2">
            <form action="presented_report" type="get" autocomplete="off">

              <div class="row">

                <div class="col-1 col-sm-1"> </div>
                <div class="col-3 col-sm-3">
                    <div class="input-group input-group-dynamic">
                    <input name="from" value=""  class="multisteps-form__input form-control" type="date"/>
                    </div>
                </div>
                <div class="col-3 col-sm-3">
                    <div class="input-group input-group-dynamic">
                    <input name="to" value=""  class="multisteps-form__input form-control" type="date"/>
                    </div>
                </div>

                <div class="col-2 col-sm-2">
                    
             <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto mb-0 btn-new"  title="filter"><i class="fas fa-search" aria-hidden="true"></i></button>
                </div>
                </div>
    
         </form>




            <!-- <div>
            class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">language</i>
          </div> -->
            <div class="text-end pt-1">
                <!-- <p class="text-sm mb-0 text-capitalize font-weight-bolder">Country vise report</p> -->
                <h4 class="mb-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center  mb-0">
                            <thead>
                                <tr>
                                <th class=" text-uppercase text-secondary  font-weight-bolder "
                                        style="text-align:center;">
                                        sl.no</th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder "
                                        style="text-align:center;">
                                        Name</th>
                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                        style="text-align:center;">
                                        Total Demo</th>
                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                        style="text-align:center;">
                                        Converted Leads</th>
                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                        style="text-align:center;">
                                        conversion Rate (IN%)</th>   

                                        <th class="  text-uppercase text-secondary  font-weight-bolder "
                                        style="text-align:center;">
                                        Operations</th>    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl=1;
                                foreach ($democount as $democounts):
                                   ?>

                                        <tr id="row42" style="font-size:20px;">
                                        <td style="text-align:center; font-size:16px;">
                                                <?= $sl++ ?>
                                            </td>

                                            <td style="text-align:center; font-size:16px;">
                                                <?= $democounts['presented_by']?>
                                            </td>
                                            
                                            <td style="text-align:center; font-size:16px;">
                                                <?= $democounts['total_demos']?>
                                            </td>
                                            <td style="text-align:center; font-size:16px;">
                                                 <?= $democounts['total_converted_leads']?>
                                            </td>
                                          
                                            <td style="text-align:center; font-size:16px;">
                                                 <?= number_format($democounts['conversion_rate'],2) ?>
                                            </td>

                                            <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                            <a href="detail-report/<?= $democounts['presenter'] ?>" title="view">
                                                                <span
                                                                    style="cursor: pointer;">
                                                                                                                                                                                                                                            <i class="
                                                                    fa fa-eye" title="view"
                                                                    style="font-size:20px;"></i>
                                                                </span>
                                                        </a>
                                             </td> 
                                        </tr>
                                    <?php endforeach;
                                ?>
                                <tr style="font-size:20px;">
                                    <td colspan="2"  ><strong><span style=" margin-right: 50px; font-size:15px; font-weight: 600;">Total Count</span></strong></td>
                                    <td style="text-align:center; font-size:16px;"><?=$totalcount['total_demos'] ?></strong></td>
                                    <td style="text-align:center; font-size:16px;"><?=$totalcount['total_converted_leads'] ?></strong></td>
                                    <td style="text-align:center; font-size:16px;"><?= number_format($totalcount['conversion_rate'],2) ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </h4>
            </div>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
        </div>
    </div>
</div>
<?php include "footer.php" ?>