<?php include "header.php" ?>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white" style="margin-left: 10px;">Support Team</h5>
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
                                                 SN</th>
            
                                            <th class="text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                 Name</th>
                                           
                                               <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Mobile No</th>
                                              <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        No of Clients</th>

                                              <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        View More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $serialNumber = 1;
                                        foreach ($support_details as $result):
                                        ?>
                                            <tr id="row42" style="font-size:20px;">
                                                <td style="text-align:center; font-size:16px;">
                                                    <?= $serialNumber++ ?>
                                                </td>                       
                                                <td style="text-align: center; font-size: 16px;">
                                                    <?= $result['name'] ?>
                                                </td>
                                                <td style="text-align:center; font-size:16px;">
                                                    <?= $result['mobile_number'] ?>
                                                </td>
                                                <td style="text-align: center; font-size: 16px;">
                                                    <?php echo $result['lead_count'] != NULL ? $result['lead_count'] : '---'  ?>
                                                </td>
                                                <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                    <a href="client-list/<?= $result['id']?>" title="view">
                                                        <span style="cursor: pointer;">
                                                            <i class="fa fa-eye" title="view" style="font-size:20px;"></i>
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