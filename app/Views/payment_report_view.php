<style>

    a{
        margin-left: 10px;
    }
</style>

<?php include "header.php" ?>
<div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-8">
    <div class="card">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            
                <h5 class="text-white" style="margin-left: 10px;">Payment Report Details <?php
                
                $total=0;
                foreach($paymnt_details as $count): 
                    $total += $count['amount'];
                    
                    endforeach?>( <?=$mode ?> : <?= number_format($total,2)?> ) </h5>
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
                                                
                                                SL</th>
                                           
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Customer Name</th>
                                            <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Contact Details</th>

                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Delivery Date</th>
                                                <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Payment Mode</th>
                                            <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                style="text-align:center;">
                                                Operations</th> 
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    <?php
                                          $sl=1;
                                       foreach($paymnt_details as $paymntdetails): ?> 
                                  
                                    <tr id="tbl_row<?=$paymntdetails['id']?>" style="font-size:20px;">

                                        <td style="text-align: center; font-size: 16px;">
                                           <?=$sl++ ?>                                      
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">

                                           <?=$paymntdetails['customer_name'] ?>
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                                <?= $paymntdetails['email'] ?><br>
                                                <?= $paymntdetails['mobile_number'] ?>
                                        </td>
                                        <td style="text-align: center; font-size: 16px;">
                                            <?php if ($paymntdetails['project_delivery_date'] === null): ?>
                                                Not Delivered<br>
                                            <?php else: ?>
                                                <?= $paymntdetails['project_delivery_date'] ?><br>
                                            <?php endif; ?>
                                             <?= $paymntdetails['amount'] ?> on <?=  date('d-M-Y', strtotime($paymntdetails['payment_date'])) ; ?> 

                                        </td>
                                        <td style="text-align:center; font-size:16px;">
                                           <?= $paymntdetails['payment_mode'] ?>
                                        </td>
                                        <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                <a href="<?=base_url('view-more/') .$paymntdetails['id'] ?>" title="view" >
                                                                        <span
                                                                            style="cursor: pointer;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="
                                                                        fa fa-eye" title="view"
                                                                            style="font-size:20px;"></i>
                                                                        </span>
                                                </a>
                                                <a href="<?=base_url('edit-lead/') .$paymntdetails['id'] ?>" title="edit">
                                                                
                                                                    <span class="EditshowFormButton1" style="cursor: pointer;">
                                                                        <i class="fa fa-edit" id="EditshowFormButton1"
                                                                            style="color: light blue;font-size:20px;"></i>
                                                                        
                                                                    </span>
                                                </a>
                                                
                                                

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
<script>
    function deleteAndClose(id) {
        var result = confirm("Want to delete this?");
    if (result) {
        $.ajax({
            url: "<?= base_url() ?>delete",
            type: 'POST',
            data: { id: id },
            success: function (data) {
                $('#tbl_row' + id).remove();
                // Close the modal
                $('[data-tw-dismiss="modal"]').trigger('click');
                
            },
            error: function (xhr, textStatus, errorThrown) {
                // Handle AJAX error here, if necessary
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
    }
    }
</script>