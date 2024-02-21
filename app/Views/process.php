<!DOCTYPE html>
<html>

<body>

    <?php
    $output = "";
    ?>

    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary font-weight-bolder" style="text-align:center;">
                    SL</th>
                <th class="text-uppercase text-secondary font-weight-bolder" style="text-align:center;">
                    Customer Name</th>

                <th class="text-uppercase text-secondary font-weight-bolder" style="text-align:center;">
                    Lead Date</th>

                <th class="text-uppercase text-secondary font-weight-bolder" style="text-align:center;">
                    Contact Details</th>
                <th class="text-uppercase text-secondary font-weight-bolder" style="text-align:left;">
                    Status</th>

                
                    <th class="text-uppercase text-secondary font-weight-bolder" style="text-align:center;">
                        Added By</th>
               
               

            </tr>
        </thead>
        <tbody>
           
               <?php foreach ($allleads as $alllead) {?>
                <tr id="row42" style="font-size:20px;">
                    <td style="text-align:center; font-size:16px;">
                        
                    </td>
                    <td style="text-align: left; font-size: 16px;">
                        <?= $alllead['customer_name'] ?>
                        <!-- Display other customer details as needed -->
                    </td>

                    <td style="text-align:center; font-size:16px;">
                        <?= date('d-M-Y', strtotime($alllead['date'])) ?>
                        <!-- Format the lead date as needed -->
                    </td>

                    <td style="text-align:center; font-size:16px;">
                        <span><?= $alllead['mobile_number'] ?></span><br>
                        <span><?= $alllead['email'] ?></span>
                        <!-- Display other contact details as needed -->
                    </td>

                    <td style="text-align:left; font-size:16px;">
                                                            <?php
                                                            switch ($alllead['status']) {
                                                                case 0:
                                                                    echo 'Lead Received on <span style="color: #1C8BEE ;">' . date('d-M-Y', strtotime($alllead['date'])) . '</span>';
                                                                    break;
                                                                case 1:
                                                                    echo 'Responded on <span style="color: #1C8BEE ;">' . date('d-M-Y', strtotime($alllead['contact_date'])) . ' </span>';
                                                                    break;
                                                                case 2:
                                                                    echo 'Not Responded on <span style="color: #1C8BEE ;">' . date('d-M-Y', strtotime($alllead['contact_date'])) . '</span>';
                                                                    break;
                                                                case 3:
                                                                    $postponed=$alllead['postponed_date'];
                                                                    if(!empty($postponed))
                                                                    {
                                                                        echo 'Demo Assigned on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($postponed)) . '</span>';
                                                                        
                                                                    }
                                                                    else
                                                                    {
                                                                        echo 'Demo Assigned on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['demodate'])) . '</span>';

                                                                    }
                                                                    break;
                                                                case 4:
                                                                    echo 'Demo Completed on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['democompleteddate'])) . '</span>';
                                                                    break;
                                                                case 5:
                                                                    echo 'Demo Aborted on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['abort_date'])) . ' </span>';
                                                                    break;
                                                                case 6:
                                                                    echo 'Payment Received on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['paymentdate'])) . ' </span>';
                                                                    break;
                                                                case 7:
                                                                    echo 'Delivered on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($alllead['project_delivery_date'])) . ' </span>';
                                                                    break;
                                                                default:
                                                                    echo 'Unknown Status';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>


                    
                        <td style="text-align:center; font-size:16px">
                            <?= $alllead['username'] ?>
                        </td>
                    

                    

                </tr>

                <?php 
                  }
             ?>

        </tbody>
    </table>

</body>

</html>
