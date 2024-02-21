<link id="pagestyle" href="https://www.ethicfin.com/bizactdemo2/asset/assets/css/material-dashboard.css?v=3.0.4"
    rel="stylesheet" />

<!-- <link rel="stylesheet" href="https://www.ethicfin.com/bizactdemo2/asset/build/toastr.min.css"> -->

<style>
    .containers {
        display: flex;
        flex-direction: row;
    }

    .item {
        display: flex;
        flex-shrink: 0;
    }

    .divider {
        display: flex;
        flex: 1;
    }

    .opacity-7 {
        opacity: 1 !important;
    }

    .btn-group-sm>.btn i,
    .btn.btn-sm i {
        font-size: 13px;
        margin-right: 5px;
    }

    .navbar-vertical.navbar-expand-xs .navbar-nav .nav-link {
        margin: 0;
    }

    .navbar-vertical .navbar-nav .nav-link>i {
        min-width: 20PX;
        font-size: 20PX;
    }
    .payment-info {
    font-size: 16px; /* Adjust the font size as needed */
    margin-bottom: 20px; /* Add spacing between payment entries */
    /* Add any other styles you want */
}
With these changes, you can easily control the styling of your payment details to match your desired look and feel.






</style>
</head>



<style>
    .dark-version .form-control,
    body.dark-version {
        color: hsl(0deg 0% 100% / 80%) !important;
    }
    .dark-version .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #344767;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 0.5rem;
        outline: 0;
    }



    .dark-version .tablenew th,
    td {

        color: #344767;

    }


    .dark-version .text-dark {
        color: #ffffff !important;
    }

    .dark-version .bg-white .text-dark {
        color: #344767 !important;
    }


    .dark-version .fixed-plugin .fixed-plugin-button {
        background: #344767;
    }



    .dark-version .blur {
        box-shadow: inset 0 0 2px #fefefed1;
        -webkit-backdrop-filter: saturate(200%) blur(30px);
        backdrop-filter: saturate(200%) blur(30px);
        background-color: #344767 !important;
    }


    .dark-version .navbar .nav-link,
    .navbar .navbar-brand {
        color: #ffffff;

    }


    /* .dark-version .tablenew th, td {
    color: #acacac;
}
 */


    .white-version .tablenew th,
    td {
        color: #202940;
    }

    .dark-version .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #1a2035 !important;
        color: white;
    }

    .dark-version .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #fff;
        line-height: 28px;
    }

    .dark-version .select2-container--default .select2-selection--single {
        background-color: #1a2035;
        border: 1px solid #aaa;
        border-radius: 4px;
    }

    .dark-version .select2-container--open .select2-dropdown--below {

        background-color: #344767;
    }

    .dark-version textarea {
        resize: vertical;
        background-color: #1a2035;
        color: #ffffff;
    }



    .font-weight-bold {
        font-weight: 600 !important;
    }

    .dark-version .card-footer {
        padding: 0.5rem 1rem;
        background-color: #344767;
        border-top: 0 solid rgba(0, 0, 0, .125);
    }

    .list-group-item {
        padding: 2.5rem 4rem;
    }

    h5.text-sm {
        text-align: center;
        color: red;
    }

    .profile-image {
        display: flex;
        justify-content: flex-end;
        /* Align to the right side */
        margin: -40px 10px auto;
        /* Adjust margin as needed */
    }

    .profile-image img {
        width: 138px;
        /* Adjust the size of the image */
        height: 140px;
        /* padding: 30px 30px 30px 30px; */
        border-radius: 50%;
        /* This will make the image circular */
        object-fit: cover;
        /* Preserve aspect ratio and cover the container */
    }
    .date{
        font-weight: bold;
        font-size: 15px;
    }
    td {
        font-size:15px;
    }
    .priority{
        margin-left: 100px;
        color: black;
    }

    #formContainer3{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        z-index: 3;
    }

    /* Center the form vertically and horizontally */

    /* Center the form vertically and horizontally */
    #myForm1 {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        width: 400px;

    }
</style>

<?php include("header.php") ?>
<div class="container-fluid py-4" style="margin-top: 50px;">
    <div class="container-fluid px-2 px-md-4">
        <div class="card card-body ">
            <div class="row gx-4 mb-2">
                <div class="col-12">
                    <div class="d-flex flex-column border-0 d-flex  mb-2 bg-gray-100 border-radius-lg">
                    <h5 class="text-sm" id="zname" style="font-size: 18px !important;">
                            <?= $leads['customer_name']; ?>

                            <?php
                            switch ($leads['priority']) {
                                case 0:
                                    $priority = 'Low';
                                    break;
                                case 1:
                                    $priority = 'Medium';
                                    break;
                                case 2:
                                    $priority = 'High';
                                    break;
                                default:
                                    $priority = '';
                                    break;
                            }
                            ?>

                            <span class="priority text-dark font-weight-bold" >Priority : <?= $priority ?></span>
                        </h5>
                        <div class="containers" style="height:150px;">
                            <div class="item">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><span class=" ">Company name</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                   
                                                </span> </span><span class=" text-dark font-weight-bold" id="zn3">
                                                    <?= $leads['company_name'] ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Address</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                   
                                                </span> </span><span class=" text-dark font-weight-bold" id="zn3">
                                                    <?= $leads['address'] ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Mobile number </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :</span><span class=" text-dark font-weight-bold" 
                                                    id=" zn2">
                                                    <?= $leads['mobile_number'] ?>
                                                </span></span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td><span class=" ">Whatsapp number </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> : </span><span class=" text-dark font-weight-bold "
                                                    id=" zn3">
                                                    <?= $leads['whatsapp_number'] ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Email </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                </span><span class=" text-dark font-weight-bold"  id="
                                                    zn3">
                                                    <?= $leads['email'] ?>
                                                </span></span></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Support given By </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                </span><span class=" text-dark font-weight-bold"  id="
                                                    zn3">
                                                    <?= $leads['supportgiven'] ?>
                                                </span></span></td>
                                            </td>
                                        </tr>
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="divider"></div>
                            <div class="item">
                                <table>
                                    <tbody>
                                        <!-- <tr>
                                            <td><span class=" ">Demo Date </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                    <? //= $list['marital_status'] ?>
                                                </span> </span><span class=" text-dark font-weight-bold  id="
                                                    zn3">
                                                    
                                                    <?php echo !empty($leadid['demo_actual_date']) ? $leadid['demo_actual_date'] : ' '; ?>

                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Demo Given By</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                    <? //= $list['email'] ?>
                                                </span> </span><span class=" text-dark font-weight-bold  id="
                                                    zn3">
                                                    <?php echo ($leadid) ? $leadid['presented_by'] : " " ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Payment Date </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                    <? //= $list['joining_date'] ?>
                                                </span> </span><span class=" text-dark font-weight-bold id="
                                                    zn3">
                                                    
                                                    <?php echo !empty($payment['payment_date']) ? $payment['payment_date'] : " " ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Payment Mode </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                    <? //= $list['father_name'] ?>
                                                </span> </span><span class=" text-dark font-weight-bold  id=" zn3">
                                               
                                                <?php echo !empty($payment['payment_mode']) ? $payment['payment_mode'] : " " ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Payment Status </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                    <? //= $list['address'] ?>
                                                </span> </span><span class=" text-dark font-weight-bold" id=" zn3">
                                               
                                                <?php echo !empty($payment['payment_status']) ? $payment['payment_status'] : " " ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Delivery Date</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                    <? //= $list['home_phone'] ?>
                                                </span> </span><span class=" text-dark font-weight-bold id="
                                                    zn3">
                                                    
                                                    <?php echo !empty($leads['project_delivery_date']) ? $leads['project_delivery_date'] : " " ?>
                                                </span></span></td>
                                        </tr> -->


                                        <tr>
                                            <td><span class=" ">Industry type </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                   
                                                </span> </span><span class=" text-dark font-weight-bold id="
                                                    zn3">
                                                   
                                                    
                                                   <?php $i_type = $leads['industry_type'];
                                                   foreach ($industries as $ins) {
                                                       if ($i_type == $ins['id']) {
                                                           echo $ins['industry_type'];
                                                       }
                                                   }
                                                   ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Country </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                   
                                                </span> </span><span class=" text-dark font-weight-bold  id=" zn3">
                                                <?php foreach($countries as $country){
                                                    if($country['id']==$leads['country']){
                                                        echo $country['name'];
                                                    }
                                                } ?>    
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Campaign ID</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                </span><span class=" text-dark font-weight-bold"  id="
                                                    zn3">
                                                    <?= $leads['campaign_id'] ?>
                                                </span></span></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Referred by </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                   
                                                </span> </span><span class=" text-dark font-weight-bold id="
                                                    zn3">
                                                    <?= $leads['referred_by'] ?>
                                                </span></span></td>
                                        </tr>

                                        <tr>
                                            <td><span class=" ">Remarks</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> : <span id="zn7">
                                                       
                                                    </span> </span><span class=" text-dark font-weight-bold id="
                                                    zn3">
                                                   
                                                    <?php echo !empty($leads['remarks']) ? $leads['remarks'] : " " ?>
                                                </span></span></span></td>
                                        </tr>   

                                        <tr>
                                            <td><span class=" ">Lead created by </span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :
                                                </span><span class=" text-dark font-weight-bold" id="zn3">
                                                    <?= $leads['username'] ?>
                                                </span></span></td>
                                            </td>
                                        </tr>                                     
                                    </tbody>
                                </table>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<br>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 50px;
    text-align: right;">
                 <button class="btn bg-gradient-success mb-1 mx-2 showFormButtonabort" data-id="<?=$leads['id'] ?>" id="showFormButtonabort" title="Filter">
                                     Update Call Status
                                </button>
            </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="containers">
                            <div class="item">
                                <div>
                                    <h6 class="text-white text-capitalize ps-3">Timeline</h6>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="item"></div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">



                            <?php if($leads['status'] == 7) { ?>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step bg-success p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                        done_all
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">

                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Project Delivered</h6>
                                    <p class="text-secondary  mt-1 mb-0 date">
                                        <?php $leaddate = $leads['project_delivery_date']; echo date('d-M-Y', strtotime($leaddate)); ?>
                                    </p>
                                    <p class="text-sm text-dark date mb-0">
                                        Email sent by : <?= $leads['email_sent_by'] ?>
                                    </p>
                                    <p class="text-sm text-dark">
                                        <?= $leads['delivery_remark'] ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>

                            <?php $payments=array_reverse($payments);
                            foreach ($payments as $payment) { ?>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step bg-primary p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                        paid
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">
                                        <?= ($payment['payment_status']=='Partial Payment')? "Partial Payment":" Full Payment" ?>
                                    </h6>
                                    <p class="text-secondary  mt-1 mb-0 date">
                                        <?php $d_date= $payment['payment_date']; $date=date('d-M-Y', strtotime($d_date)); echo $date;?>
                                    </p>
                                    <p class="text-sm text-dark mb-2 ">
                                        A payment of rupees <span class="date"><?= $payment['amount']?></span> was
                                        received through/as <span class="date"> <?=$payment['payment_mode']?></span>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php if($leads['invoice_status']== 1){?>
                            <div class="timeline-block">
                                <span class="timeline-step bg-info text-white p-3">
                                <i class="fa-solid fa-file-invoice"></i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mt-2">Invoice Sent On  <span>
                                    <?php
                                                        $originalDate = $leads['invoice_sent_date'];
                                                        $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                        echo $formattedDate;
                                                        ?>
                                    </span></h6>
        
                                     
                                    <p class="text-dark text-xl">
                                     Invoice Number : <?= $leads['invoice_number'] ?>
                                    </p>  
                                </div>
                            </div>
                            <?php } ?>


                            <?php if($leads['offer_mail_status']== 1){?>
                            <div class="timeline-block mb-2">
                                <span class="timeline-step bg-info text-white p-3">
                                <i class="fa-solid fa-envelope"></i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mt-2">Offer Mail Sent On <?= date('d-M-Y', strtotime($leads['offer_sent_date'])) ?></h6>         
                                      
                                </div>
                            </div>
                            <?php } ?>

                            <?php if($demos){
                                foreach($demos as $demo){
                                   if($demo['demo_actual_date']) {
                                    ?>
                            <div class="timeline-block">
                                 <span class="timeline-step bg-info p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                    <span class="material-symbols-outlined">
                                assignment_turned_in
                                </span>
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Demo Completed</h6>
        
                                     <p class="text-secondary  mt-1 mb-0 date">
                                     <?= date('d-M-Y', strtotime($demo['demo_actual_date'])) ?> || <?= $demo['demo_actual_time'] ?>
                                    </p> 
                                    <?php if($demo['additional_features']){?>
                                        <p class="text-dark text-xl">
                                        Additional Features :</br> 
                                        <?= $demo['additional_features']?>
                                        </p> 
                                    <?php }?>
                                    <p class="text-dark text-xl">
                                        <?= $demo['remark_after_demo']?>
                                    </p>                    
                                      
                                </div>
                            </div>
                            <?php }}} ?>


                            <?php  
                            
                            foreach($aborteds as $aborted){
                            if ($aborted['status']==2) { ?>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step bg-danger p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                    <span class="material-symbols-outlined">
                                        block
                                        </span>
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">
                                        Demo Aborted
                                    </h6>
                                    <p class="text-secondary  mt-1 mb-0 date">
                                     <?=  date('d-M-Y', strtotime($aborted['abort_date'])) ; ?>
                                        ||
                                        <span><?=  $aborted['demo_time']; ?></span>
                                    </p>
                                    <p class="text-sm text-dark">
                                        <?= $aborted['abort_reason']; ?>
                                    </p>
                                </div>
                            </div>
                            <?php }} ?>



                            <?php 
                               foreach ($postponed as $key => $result) {
                                // Check if the current element is the 'count' element
                                if ($key === 'count') {
                                    $count = $result;
                                    // dd($count);
                                    continue;
                                }
                                if($postponed['count'] > 1){
                                ?>
                                <div class="timeline-block">
                                    <span class="timeline-step bg-warning p-3">
                                        <i class="material-icons text-white text-sm opacity-10">
                                            <span class="material-symbols-outlined">
                                                error
                                            </span>
                                        </i>
                                    </span>
                                    <div class="timeline-content pt-1">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Re-scheduled to</h6>
                                        <p class="text-secondary  mt-1 mb-0 date">
                                            <?= date('d-M-Y', strtotime($result['demo_date'])) ?> || <?= $result['demo_time'] ?>
                                        </p>  
                                        <p class="text-secondary text-xl">
                                            <?= $result['remark'] ?>
                                        </p>                    
                                    </div>
                                </div>
                            <?php } }?>

                            <?php $demos=array_reverse($demos);
                            foreach ($demos as $demo) { 
                             
                                                        // Assuming $newlead['contact_date'] contains the date in 'YYYY-MM-DD' format
                                                        $demo_date = $demo['demo_date'];
                                                        $demo_Date = date('d-M-Y', strtotime($demo_date));

                                                        $demo_actual_date = $demo['demo_actual_date'];
                                                        $demo_actual_Date = date('d-M-Y', strtotime($demo_actual_date));

                                                        ?>

                            

                            <?php  if ($demo['status'] == 0 || $demo['status'] == 3 || $demo['status'] == 2 ) { ?>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step bg-info p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                    <span class="material-symbols-outlined">
                                    assignment
                                    </span>
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">
                                        Demo Assigned:
                                    </h6>
                                    <p class="text-secondary  mt-1 mb-0 date">
                                     <?=  date('d-M-Y', strtotime($demo['demo_date'])) ; ?>
                                        ||
                                        <span><?=
                                         $demo['demo_time']; ?></span>
                                    </p>
                                    <p class="text-sm text-dark date mb-0">
                                        <?= 'Assinged to: ' .$demo['presenter']; ?>
                                    </p>
                                    <p class="text-sm text-dark">
                                        <?= $demo['remark']; ?>
                                    </p>
                                </div>
                            </div>
                            <?php } }?>
                            
                            <!-- <?php
                            
                            
                            if($leads['status']==5){
                                
                                ?>
                            <div class="timeline-block">
                                <span class="timeline-step p-3" style="    background-color: #f2d000!important;">
                                    <i class="material-icons text-white text-sm opacity-10">
                                        <span class="material-icons">
                                            perm_phone_msg
                                        </span>
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Demo Aborted </h6>
                                    <p class="text-secondary  mb-0 date">
                                        <?php
                                            // Assuming $newlead['contact_date'] contains the date in 'YYYY-MM-DD' format
                                            // $originalDate = $demo['abort_date'];
                                            // $formattedDate = date('d-M-Y', strtotime($originalDate));
                                            ?>

                                       
                                    <p class=" text-dark mt-1 mb-2 text-xl">
                                        <?= $leads['contact_remarks'] ?>
                                    </p>
                                </div>
                            </div>
                            <?php }?> -->

                            <?php
                                if ($leads['contact_date']) {
                                    $respondtitle = "";

                                    if ($leads['status'] == 1 || $leads['status'] > 2) {
                                        $respondtitle = "Responded On: ";
                                    } elseif ($leads['status'] == 2) {
                                        $respondtitle = "Not Responded On:";
                                    }
                                    ?>

                                    <div class="timeline-block">
                                        <?php if ($leads['status'] == 1 || $leads['status'] > 2) { ?>
                                            <span class="timeline-step p-3" style="background-color: #f2d000!important;">
                                                <i class="material-icons text-white text-sm opacity-10">
                                                    <span class="material-icons">
                                                        perm_phone_msg
                                                    </span>
                                                </i>
                                            </span>
                                        <?php } if ($leads['status'] == 2) { ?>
                                            <span class="timeline-step bg-danger p-3">
                                                <i class="material-icons text-white text-sm opacity-10">
                                                <span class="material-symbols-outlined">
                                                    phone_disabled
                                                    </span>
                                                </i>
                                            </span>
                                        <?php } ?>
                                        <div class="timeline-content pt-1">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0"><?= $respondtitle; ?> </h6>
                                            <p class="text-secondary mb-0 date">
                                                <?php
                                                // Assuming $newlead['contact_date'] contains the date in 'YYYY-MM-DD' format
                                                $originalDate = $leads['contact_date'];
                                                $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                echo $formattedDate;
                                                ?>
                                            </p>
                                            <p class="text-dark mt-1 mb-2 text-xl">
                                                <?= $leads['contact_remarks'] ?>
                                            </p>
                                        </div>
                                    </div>

                                <?php } ?>


                            <?php if($leads['date']){?>
                            <div class="timeline-block mt-1">
                                <span class="timeline-step bg-dark p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                        <span class="material-icons">
                                            download
                                        </span>
                                    </i>
                                </span>
                                <div class="timeline-content pt-1">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Lead Received On</h6>
                                    <p class="text-secondary  mb-0 date">
                                        <?php
                                            $originalDate4 = $leads['date'];
                                            echo date('d-M-Y', strtotime($originalDate4));
                                            ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>


            <div class="col-6"> 
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="containers">
                            <div class="item">
                                <div>
                                    <h6 class="text-white text-capitalize ps-3">Live Updates 
                                    
                            </h6>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="item"></div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">

                        <?php $call_details=array_reverse($call_details);
                            foreach ($call_details as $remarks) {
                            $date = $remarks['call_date'];
                             $Date = date('d-M-Y', strtotime($date));?>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-secondary p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                     support_agent
                                    </i>
                                    </span>
                                    <div class="timeline-content pt-1">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Call Details</h6>
                                        <p class="text-secondary  mt-1 mb-0 date"><?=$Date?></p>
                                        <?php
                                            date_default_timezone_set('Asia/Kolkata');
                                        ?>

                                        <p class="text-sm text-dark mt-1 mb-2"> 
                                            <span><?= date('h:i A', strtotime($remarks['call_start_time'])) ?></span> --
                                            <span><?= date('h:i A', strtotime($remarks['call_end_time'])) ?></span>
                                        </p>

                                        <p class="text-sm text-dark mt-1 mb-2 "> 
                                        <?= $remarks['call_remarks']?>
                                        </p>
                                        <p class="text-sm text-dark mt-1 mb-2 "> 
                                            Next Followup Date <span style=" font-weight: 500; font-size: 12px;" > : <?=date('d-M-Y', strtotime($remarks['next_followup_date'])) ?></span>
                                        </p>
                                         <p class="date"> </p>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php $remark=array_reverse($remark);
                            foreach ($remark as $remarks) {
                            $date = $remarks['date'];
                             $Date = date('d-M-Y', strtotime($date));?>
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step bg-info p-3">
                                    <i class="material-icons text-white text-sm opacity-10">
                                  tips_and_updates
                                    </i>
                                    </span>
                                    <div class="timeline-content pt-1">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Live update</h6>
                                        <p class="text-secondary  mt-1 mb-0 date"><?=$Date?></p>
                                
                                        <p class="text-xl text-dark mt-3 mb-2 "> 
                                        <?= $remarks['remark']?>
                                        </p>
                                        <p class="date"> </p>
                                    </div>
                                </div>
                            <?php } ?>
    
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
<?php include("footer.php") ?>
<div id="formContainer3">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm1" action="<?=base_url('client-call')?>">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Call Status</h5>
                    </div>
                    <div class="card-body pt-0">
                        
                        <style>
                            .form-label, label {
                                margin-bottom:0px;
                            }
                            input, textarea {
                                margin-bottom:10px;
                            }
                        </style>


                        <div class="row">
                         <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Call Date</label>
                                    <input type="date" class="form-control" id="lostdate" name="curr_date"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Start Time</label>
                                    <input type="time" class="form-control" id="lostdate" name="start_time"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">End TIme</label>
                                    <input type="time" class="form-control" id="lostdate" name="end_time"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Call Remarks</label>
                                            <textarea type="text" class="form-control" id="remarks"
                                                name="remarks" style="border: 1px solid #333;"></textarea>
                                            <div style="color: red !important"> </div>
                            </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Next Followup Date</label>
                                    <input type="date" class="form-control" id="lostdate" name="followp_date"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button id="cancel2" class="btn bg-danger text-white btn-sm float-end mb-0"
                        type="button">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
</html>

<script>
            const showFormButtonabort = document.getElementById('showFormButtonabort');
            const formContainer3 = document.getElementById('formContainer3');
            let lastAppendedInput3 = null;

            formContainer3.addEventListener('click', (event) => {
                if (event.target === formContainer3) {
                    formContainer3.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const showFormButtons1 = document.querySelectorAll('.showFormButtonabort');

            // Add click event listeners to each button
            showFormButtons1.forEach((showFormButtonabort) => {
                showFormButtonabort.addEventListener('click', () => {
                    var currentDate = new Date().toISOString().split('T')[0];

                    // Set the value of the date field to the current date
                    document.getElementById("lostdate").value = currentDate;
                    // Extract the data-id attribute value
                    const leadId = showFormButtonabort.getAttribute('data-id');
                    console.log(leadId)
                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm1'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInput3) {
                        form.removeChild(lastAppendedInput3);
                    }
                    lastAppendedInput3 = inputField;
                    form.appendChild(inputField);
                    formContainer3.style.display = formContainer3.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });

            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel2");
                var formContainer = document.getElementById("formContainer3");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none";
                });
            });

 </script>