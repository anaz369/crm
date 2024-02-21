<style>
    a {
        margin-left: 9px;
    }

    .fa-pencil-alt:before, .fa-pencil:before{
        font-size: 10px;
        margin-left: -8px;
    }

    #editmodal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        z-index: 100;
    }

    #formContainer,
    #formContainer2,
    #formContainer3,
    #formContainers {
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

    #myForm4{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        width: 400px; 
    }

    /* Center the form vertically and horizontally */
    #myForm,
    #myFormdemo,
    #myForm2 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }

    .btn-group-sm>.btn i,
    .btn.btn-sm i {
        font-size: 20px;
        margin-bottom: 3px;
    }

    .error {
        font-size: 20px;
        color: red;
        margin-top: 70px;
        font-weight: bold;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    /* Styles for the time slots */
    .time-slots {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .time-slot {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
        cursor: pointer;
    }

    .time-slot:hover {
        background-color: #f2f2f2;
    }

    .disabled {
        background-color: #FF9999;
        /* Change to a grey background color or any color you prefer */
        cursor: not-allowed;
        /* Change the cursor to indicate it's not clickable */
        pointer-events: none;
        /* Disable pointer events (clicks, hovers, etc.) */
        opacity: 0.5;
        /* Reduce the opacity to visually indicate it's disabled */
    }

    .custom-select {
            position: relative;
        }

        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .custom-select::before {
            content: '\25BC'; 
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
     }
</style>
<?php include "header.php" ?>
<div class="container-fluid py-4">
    <div class="row">

        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="containers">
                                    <div class="item">
                                        <div>
                                            <h6 class="text-white text-capitalize ps-3">Demo completed Lead </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

                                <form method="get" autocomplete="off" action="demo-completed">

                                    <div class="row">

                                        <div class="col-1 col-sm-1"> </div>
                                        <div class="col-3 col-sm-3">
                                        </div>
                                        <div class="col-3 col-sm-3">
                                        </div>

                                        <div class="col-3 col-sm-3">
                                            <div class="input-group input-group-dynamic">
                                                <input name="search" value="" placeholder="Search"
                                                    class="multisteps-form__input form-control" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-2 col-sm-2">
                                            <button class="btn bg-gradient-primary btn-sm ms-auto " title="filter"
                                                type="submit" style="width: 70px; height: 40px;"><i class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                </form>
                                <?php if (!empty($error)) { ?>
                                    <p class="text-center error">
                                        <?= $error ?>
                                    </p>;
                                    <?php
                                } else { ?>
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center  mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Sl.no</th>


                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Customer Name</th>   
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Contact Details</th>

                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Contact Details</th> -->
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Presentation Details</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Remarks</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Additional Feature</th>
                                                        <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?> 

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center; width: 160px; ">
                                                        Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                 if (isset($page)) {
                                                    $id = $page;
                                                } else {
                                                    $id = 1;
                                                    $page = 1;
                                                }
                                                $currentPage = isset($page) ? $page : 1;
                                                $serialNumber = ($currentPage - 1) * isset($itemsPerPage);
                                                foreach ($democomplete_lead_join as $complete) {
                                                    // dd($complete->customer_name);
                                                        // dd($complete);
                                                        $serialNumber++ ?>
                                                        <tr id="row42" style="font-size:20px;">
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $serialNumber ?>
                                                            </td>
                                                            <td style="text-align: left; font-size: 16px;">
                                                                <span style="font-size: 13px;" data-id="<?= $complete->lead_id ?>" data-priority="<?= $complete->priority ?>" class="showFormButton2">
                                                                    <i style="color: <?php echo ($complete->priority == 2) ? 'red' : (($complete->priority == 1) ? '#E4A11B' : ''); ?>" 
                                                                        class="fa-solid fa-heart" data-id="<?= $complete->priority ?>" id="showFormButton2"></i>
                                                                </span>
                                                                <?php
                                                                $uri = service('uri');
                                                                $lastSegment = $uri->getSegment($uri->getTotalSegments());
                                                                // dd($lastSegment);die;
                                                                
                                                                ?>
                                                                <span style="margin-left: 10px;"><?= $complete->customer_name ?> <a href="<?= base_url("edit-lead/{$lastSegment}/{$complete->lead_id}") ?>"><span class="pencil"><i class="fa fa-pencil"></i></span></a>
                                                            </span>
                                                                <br>
                                                            <?php if(!empty($complete->company_name)) : ?>
                                                                 <span style="margin-left: 28px; font-size: 12px;">(<?php echo $complete->company_name ?>)</span>
                                                            <?php endif?>
                                                           
                                                            </span>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $complete->email ?><br>
                                                                <?= $complete->mobile_number ?>

                                                            </td>
                                                            <?php
                                                            // Assuming $join->demo_date contains the date in 'YYYY-MM-DD' format
                                                            $originalDate = $complete->demo_actual_date;
                                                            $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                            ?>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $complete->demo_presenter ?> <br>
                                                                <?= $formattedDate ?> <br>
                                                                <?= $complete->demo_actual_time ?>

                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $complete->remark_after_demo ?>
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?= $complete->additional_features ?>
                                                            </td>

                                                            <?php 
                                                            $role=session('user_type');
                                                            if($role== 0): ?>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $complete->username ?>
                                                            </td>
                                                        <?php endif; ?>


                                                            <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                                <a href="view-more/<?= $complete->lead_id ?>" title="view">
                                                                    <span
                                                                        style="cursor: pointer;" ">
                                                                          <i class="fa fa-eye" title="view"
                                                                        style="font-size:20px;"></i>
                                                                    </span>
                                                                </a>

                                                                <a href="#" title="edit">
                                                                    <?php $id = $complete->lead_id;
                                                                    $date = $complete->demo_actual_date;
                                                                    $presenter = $complete->presented_by;
                                                                    $customer_name = $complete->customer_name;
                                                                    $time = $complete->demo_actual_time;
                                                                    $presented_by = $complete->demo_presenter;
                                                                    $remark = $complete->remark_after_demo;
                                                                    $additional = $complete->additional_features;
                                                                    $invoice_status = $complete->invoice_status;
                                                                    $offer_sent_status = $complete->offer_mail_status;
                                                                    $invoice_sent_date=$complete-> invoice_sent_date;
                                                                    $invoice_number=$complete-> invoice_number;
                                                                    $offer_sent_date=$complete->offer_sent_date;
                                                                    $trial_account_status=$complete->trial_account_status;
                                                                    $trial_account_username=$complete->trial_account_username;
                                                                    $trial_expiry_date=$complete->trial_expiry_date;
                                                                    $trial_sent_date=$complete->trial_sent_date;
                                                                    ?>
                                                                    <span class="EditshowFormButton1"  style="cursor: pointer;"
                                                                        onclick="editdmcom('<?php echo $id; ?>','<?php echo $date; ?>','<?php echo $presenter; ?>','<?php echo $customer_name; ?>','<?php echo $time; ?>','<?php echo $presented_by; ?>','<?php echo $remark; ?>','<?php echo $additional; ?>','<?php echo $invoice_status; ?>','<?php echo $offer_sent_status; ?>','<?php echo $invoice_sent_date; ?>','<?php echo $invoice_number; ?>','<?php echo $offer_sent_date; ?>','<?php echo $trial_account_status; ?>','<?php echo $trial_account_username; ?>','<?php echo $trial_expiry_date; ?>','<?php echo $trial_sent_date; ?>')"
                                                                        data-id=" <?= $complete->lead_id ?> " data-presenter="<?= $complete->presented_by ?>">
                                                                        <i class="fa fa-edit" id="EditshowFormButton1"
                                                                            data-id=" <?= $complete->lead_id ?> "
                                                                            style="color: light blue;font-size:20px;"></i>
                                                                        <span class="title-text" style="display: none;">Edit</span>
                                                                    </span>
                                                                </a>
                                                                <a href="#" title="Delete">
                                                                    <span style="cursor: pointer;"
                                                                        onclick="confirmDelete('<?= $complete->lead_id?>');">
                                                                        <i class="fa fa-trash" title="Delete"
                                                                            style=" font-size: 20px;"></i>
                                                                    </span>
                                                                </a>

                                                                <a href="#" title="Update">
                                                                    <span class="showFormButton" style="cursor: pointer;"
                                                                        data-id=" <?=$complete->lead_id ?>">
                                                                        <i class="fa fa-wrench" id="showFormButton"
                                                                            data-id=" <?= $complete->lead_id ?>"
                                                                            style="font-size:20px;"></i>
                                                                        <span class="title-text"
                                                                            style="display: none;">Update</span>
                                                                    </span>
                                                                </a>
                                                                <a href="#" title="Update">
                                                                    <span class="InfoshowFormButton" style="cursor: pointer;"
                                                                        data-id=" <?= $complete->lead_id ?> ">
                                                                        <i class="fa fa-info" id="InfoshowFormButton"
                                                                            data-id=" <?= $complete->lead_id ?> "
                                                                            style="font-size:20px;"></i>
                                                                        <span class="title-text"
                                                                            style="display: none;">Update</span>
                                                                    </span>
                                                                </a>

                                                            </td>
                                                            <td class="align-middle" style="margin: left 2px; text-align:center;">


                                                            </td>

                                                        </tr>
                                                        <?php 
                                                    
                                                }
                                } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(empty($search)):?> 
            <div class="print-pri">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                    <nav class="w-full sm:w-auto sm:mr-auto">
                        <ul class="pagination">
                            <?php if (isset($page) && $page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=<?= $page - 1 ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    </a>
                                </li>
                                <?php if ($page > 4) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php for ($counter = $page - 3; $counter <= $page + 3; $counter++): ?>
                                <?php if ($counter >= 1 && $counter <= $totalPages) : ?>
                                    <li class="page-item <?= ($counter == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page-nr=<?= $counter ?>"><?= $counter ?></a>
                                    </li>
                                    
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages - 3) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=<?= $totalPages ?>"><?= $totalPages ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!isset($page)): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php elseif (isset($page) && $page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page-nr=<?= $page + 1 ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <select class="w-20 form-select box mt-3 sm:mt-0" onchange="window.location.href = '?page-nr=' + this.value;">
                        <?php for ($counter = 1; $counter <= $totalPages; $counter++): ?>
                            <option value="<?= $counter ?>" <?= ($counter == $page) ? 'selected' : '' ?>><?= $counter ?></option>
                        <?php endfor; ?>
                    </select>

                </div>
            </div>
            <?php endif ?>             
            </div>
        </div>

        <div id="formContainer3">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm4" action="update-priority">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5> Update Priority</h5>
                    </div>
                    <div class="card-body pt-0">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Priority</label>
                                <div class="custom-select">
                                    <select class="select2" id="prioritySelect" name="priority">
                                        <option value="0">Low</option>
                                        <option value="1">Medium</option>
                                        <option value="2">High</option>
                                    </select>
                                </div>
                                <div style="color: red !important"> </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" id="cancel2"
                            type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>

        <div id="formContainers">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm2" action="viewall-leads">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Lead</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="remarks" name="remark"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                     <button onclick="cancelupdate2()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>
        <script>
            const InfoshowFormButton = document.getElementById('InfoshowFormButton');
            const formContainers = document.getElementById('formContainers');
            let lastAppendedInputs = null;

            formContainers.addEventListener('click', (event) => {
                if (event.target === formContainers) {
                    formContainers.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const InfoshowFormButtons = document.querySelectorAll('.InfoshowFormButton');

            // Add click event listeners to each button
            InfoshowFormButtons.forEach((InfoshowFormButton) => {
                InfoshowFormButton.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = InfoshowFormButton.getAttribute('data-id');

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm2'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInputs) {
                        form.removeChild(lastAppendedInputs);
                    }
                    lastAppendedInputs = inputField;
                    form.appendChild(inputField);
                    formContainers.style.display = formContainers.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });

        </script>
        <script>
            function editdmcom(id, date, presenter, name, time, presented_by, remark, additional, invoice_status, mail_sent_status,invoice_sent_date,invoice_number,offer_sent_date,trial_link_status,trial_account_username,trial_expiry_date,trial_sent_date) {
                // Parse the time into hours, minutes, and AM/PM
                const [timePart, ampm] = time.split(' ');
                const [hours, minutes] = timePart.split(':');

                // Convert to 24-hour format if necessary
                let formattedHours = parseInt(hours, 10);
                if (ampm === 'PM' && formattedHours !== 12) {
                    formattedHours += 12;
                } else if (ampm === 'AM' && formattedHours === 12) {
                    formattedHours = 0;
                }

                // console.log(invoice_number);

                // Format the time in "hh:mm" format
                const formattedTime = `${formattedHours.toString().padStart(2, '0')}:${minutes}`;

                // Set the values to the modal fields
                $('#dmcid').val(id);
                $('#dmceddate').val(date);
                $('#dmcedname').val(name);
                $('#dmcedpresented_by').val(presented_by);
                $('#openModal').val(formattedTime);
                $('#dmremark').val(remark);
                $('#addfeatures').val(additional);
                $('#invoiceDate').val(invoice_sent_date);
                $('#invoiceNumber').val(invoice_number);
                $('#offerDate').val(offer_sent_date);
                $('#account_username').val(trial_account_username);
                $('#expiry_date').val(trial_expiry_date);
                $('#trial_sent_date').val(trial_sent_date);

                $('#invoiceSent').prop('checked', invoice_status == 1);
                $('#offersent').prop('checked', mail_sent_status == 1);
                $('#trial_account').prop('checked', trial_link_status == 1);

                const presenterSelect = document.getElementById('presenterSelect');
               console.log(presenter)
                if (presenterSelect) {
                    Array.from(presenterSelect.options).forEach(option => {
                        option.selected = option.value == presenter;
                    });
                }

                // Manually trigger change events for checkboxes
                handleInvoiceSentChange();
                handleOfferSentChange();
                handleTrialaccountChange();

                editmodal.style.display = editmodal.style.display === 'block' ? 'none' : 'block';
            }

            // Function to handle change event for Invoice Sent checkbox
            function handleInvoiceSentChange() {
                var invoiceDateField = document.getElementById('invoiceDateField');
                var invoiceTimeField = document.getElementById('invoiceTimeField');
                if ($('#invoiceSent').prop('checked')) {
                    invoiceDateField.style.display = 'block';
                    invoiceTimeField.style.display = 'block';
                } else {
                    invoiceDateField.style.display = 'none';
                    invoiceTimeField.style.display = 'none';
                }
            }

            // Function to handle change event for Offer Mail Sent checkbox
            function handleOfferSentChange(){
                var offersentField = document.getElementById('offersentField');
                if ($('#offersent').prop('checked')) {
                    offersentField.style.display = 'block';
                } else {
                    offersentField.style.display = 'none';
                }
            }

            function handleTrialaccountChange(){
                var trial_sent_date = document.getElementById('trial_account_sent');
                var trial_expiry_date = document.getElementById('expiry_date_field');
                var account_username = document.getElementById('account_field');

                if ($('#trial_account').prop('checked')){
                    trial_sent_date.style.display = 'block';
                    trial_expiry_date.style.display = 'block';
                    account_username.style.display = 'block';
                } else{
                    trial_sent_date.style.display = 'none';
                    trial_expiry_date.style.display = 'none';
                    account_username.style.display = 'none';
                }
            }
            // Attach change event listeners
            $('#invoiceSent').change(handleInvoiceSentChange);
            $('#offersent').change(handleOfferSentChange);
            $('#trial_account').change(handleTrialaccountChange);
        </script>


        <?php include "footer.php" ?>
        <div id="editmodal">
            <form method="post" class="slip" enctype="multipart/form-data" id="myFormdemo" action="democompleted_edit">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Edit Demo Completed Leads</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <input id="dmcid" type="hidden" name="leadid">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Customer Name</label>
                                    <input type="text" class="form-control" id="dmcedname" name="customer_name"
                                        style="border: 1px solid #333; padding-left: 10px;" readonly>
                                    <div style="color: red !important"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Demo Date</label>
                                    <input type="date" class="form-control" id="dmceddate" name="demo_actual_date"
                                        style="border: 1px solid #333; padding-left:10px;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                          
                            <div class="col-lg-6">
                                    <div class="form-group">
                                            <label class="form-control-label" for="input-username">Demo Time</label>
                                            <!-- <button id="openModal">Select Booking Time</button> -->
                                            <input type="text" class="form-control" id="openModal" name="demo_actual_time"
                                                style="border: 1px solid #333;" value=""> </input>
                                            </select>
                                            <div style="color: red !important"> </div>
                                        </div>
                             </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea class="form-control" id="dmremark" name="editremark"
                                        style="border: 1px solid #333; padding-left:10px;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Additional Features</label>
                                    <textarea class="form-control" id="addfeatures" name="additional_features"
                                        style="border: 1px solid #333; padding-left:10px;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                           
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">Presented By</label>
                                <div class="custom-select">
                                    <select class="select2" id="presenterSelect" name="presented_by">
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id']?>"><?= $user['username']?></option>
                                     <?php endforeach; ?>  
                                    </select>
                                </div>
                                <div style="color: red !important"> </div>
                            </div>
                         </div>
                         <div class="col-lg-4 mt-3">
                                                    <div>
                                                        <label class="form-check-label" for="invoiceSent">Invoice Sent</label>
                                                        <input style=" border: 1px solid grey;" class="form-check-input check" type="checkbox" id="invoiceSent" name="invoice_sent">
                                                    </div>
                                                    <div class="form-group" style="display: none;" id="invoiceDateField">
                                                    <label class="form-control-label" for="input-username">Invoice Date</label>
                                                    <input type="date" class="form-control" id="invoiceDate" name="invoice_date" style="border: 1px solid #333;">
                                                </div>
                                                <div class="form-group" style="display: none;" id="invoiceTimeField">
                                                    <label class="form-control-label" for="input-username">Invoice Number</label>
                                                    <input type="text" class="form-control" id="invoiceNumber" name="invoice_number" style="border: 1px solid #333;">
                                                </div>
                                                   
                                         </div>
                                         <div class="col-lg-4 mt-3">
                                                    <div >
                                                        <label class="form-check-label" for="trailaccount">Trial Account Sent</label>
                                                        <input  style=" border: 1px solid grey;"class="form-check-input check" type="checkbox" id="trial_account" name="trial_account">
                                                    </div>
                                                    
                                                    <div class="form-group" style="display: none;" id="account_field">
                                                    <label class="form-control-label" for="input-username">Account Username</label>
                                                    <input type="text" class="form-control" id="account_username" name="account_username" style="border: 1px solid #333;">
                                                    </div>
                                                    <div class="form-group" style="display: none;" id="trial_account_sent">
                                                    <label class="form-control-label" for="input-username">Trial Sent Date</label>
                                                    <input type="date" class="form-control" id="trial_sent_date" name="trial_sent_date" style="border: 1px solid #333;">
                                                    </div>
                                                    <div class="form-group" style="display: none;" id="expiry_date_field">
                                                    <label class="form-control-label" for="input-username">Expiry Date</label>
                                                    <input type="date" class="form-control" id="expiry_date" name="expiry_date" style="border: 1px solid #333;">
                                                    </div>
                                               
                                                   
                                         </div>
                                         <div class="col-lg-4 mt-3">
                                                    <div >
                                                        <label class="form-check-label" for="offersent">Offer Mail Sent</label>
                                                        <input  style=" border: 1px solid grey;"class="form-check-input check" type="checkbox" id="offersent" name="offersent">
                                                    </div>
                                                    <div class="form-group" style="display: none;" id="offersentField">
                                                    <label class="form-control-label" for="input-username">Offer Sent Date</label>
                                                    <input type="date" class="form-control" id="offerDate" name="offer_date" style="border: 1px solid #333;">
                                                </div>    
                                         </div>

                                         <div id="bookingModal" class="modal">
                                        <div class="modal-content">
                                            <h2>Select Booking Time</h2>
                                            <div class="time-slots">
                                                <!-- Generate time slots -->
                                                <?php
                                                $startTime = strtotime("09:00 AM");
                                                $endTime = strtotime("09:00 PM");
                                                while ($startTime < $endTime) {
                                                    $time = date("h:i A", $startTime);
                                                    echo "<div class='time-slot' data-time='$time' id='$time'>$time</div>";
                                                    $startTime = strtotime('+30 minutes', $startTime);
                                                }
                                                ?>


                                            </div>
                                        </div>
                                    </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                        <button onclick="canceledit()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>
        <script>
            // Step 1: Identify the button
            var cancelButton = document.getElementById("cancelButton");

            // Step 2: Add an event listener to the button
            cancelButton.addEventListener("click", function () {
                // Step 3: Implement the dismiss action
                closeModal(); // Custom function to close the modal
            });

            function closeModal() {
                // Implement the dismiss action here (e.g., hide the modal)
                var modal = document.getElementById("editmodal");
                modal.style.display = "none";
            }
        </script>


        <div id="formContainer">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm" action="demo_complete_update">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Payment</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">



                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Payment Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Selling Amount</label>
                                    <input type="text" class="form-control" id="date" name="selling_amount"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Payment Mode</label>
                                    <select class="form-control" name="mode" id="country" required
                                        onchange="getdesignation();" style="border: 1px solid #333;">
                                        <option value="">Select Mode</option>
                                        <?php foreach($payment_methods as $pay_methods): ?>
                                        <option value="<?=$pay_methods['name'] ?>"><?=$pay_methods['name'] ?> </option>
                                        <?php endforeach?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Payment Status</label>
                                    <select class="form-control" name="payment_status" id="country" required
                                        onchange="getdesignation();" style="border: 1px solid #333;">
                                        <option value="">Select Status</option>
                                        <option value="Full Payment"> Full Payment </option>
                                        <option value="Partial Payment"> Partial Payment</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Amount</label>
                                    <input type="" class="form-control" id="remarks" name="amount"
                                        style="border: 1px solid #333;" placeholder="0.00"
                                        pattern="^\d+(\.\d{1,2})?$"></input>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="remarks" name="remarks"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <!-- </div> -->




                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                       <button onclick="cancelupdate()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>
        <script>
            // Step 1: Identify the button
            var cancelButtonUpdatedemo = document.getElementById("cancelButtonUpdatedemo");

            // Step 2: Add an event listener to the button
            cancelButtonUpdatedemo.addEventListener("click", function () {
                // Step 3: Implement the dismiss action
                closeModal(); // Custom function to close the modal
            });

            function closeModal() {
                // Implement the dismiss action here (e.g., hide the modal)
                var modal = document.getElementById("formContainer");
                modal.style.display = "none";
            }
        </script>
        <script>
            function confirmDelete(id) {
                console.log(id)
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete_democompleted/'); ?>" + id;
                }
            }
        </script>
        <script>
            const showFormButton = document.getElementById('showFormButton');
            const formContainer = document.getElementById('formContainer');
            let lastAppendedInput = null;

            formContainer.addEventListener('click', (event) => {
                if (event.target === formContainer) {
                    formContainer.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const showFormButtons = document.querySelectorAll('.showFormButton');

            // Add click event listeners to each button
            showFormButtons.forEach((showFormButton) => {
                showFormButton.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = showFormButton.getAttribute('data-id');

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInput) {
                        form.removeChild(lastAppendedInput);
                    }
                    lastAppendedInput = inputField;
                    form.appendChild(inputField);
                    formContainer.style.display = formContainer.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel");
                var formContainer = document.getElementById("formContainer");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none"; // Hide the formContainer
                });
            });
    
            const showFormButton2 = document.getElementById('showFormButton2');
            const formContainer3 = document.getElementById('formContainer3');
            console.log('work');
            let lastAppendedInput2 = null;

            formContainer3.addEventListener('click', (event) => {
                if (event.target === formContainer3) {
                    formContainer3.style.display = 'none';
                }
            });

            const showFormButtons2 = document.querySelectorAll('.showFormButton2');

            showFormButtons2.forEach((showFormButton2) => {
                showFormButton2.addEventListener('click', () => {
                    const leadId = showFormButton2.getAttribute('data-id');
                    const priority=showFormButton2.getAttribute('data-priority');
                    console.log(leadId)
                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; 
                    inputField.name = 'leadId'; 
                    inputField.value = leadId; 

                    inputField.className = 'form-control'; 
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    const form = document.getElementById('myForm4'); 
                    if (lastAppendedInput2) {
                        form.removeChild(lastAppendedInput2);
                    }
                    const prioritySelect = document.getElementById('prioritySelect'); 
                    if (prioritySelect) {
                        Array.from(prioritySelect.options).forEach(option => {
                            option.selected = option.value === priority;
                        });
                    }
                    lastAppendedInput2 = inputField;
                    form.appendChild(inputField);
                    formContainer3.style.display = formContainer3.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel2");
                var formContainer = document.getElementById("formContainer3");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none";
                });
            });
        </script>

        <script>
            document.getElementById('invoiceSent').addEventListener('change', function () {
                var invoiceDateField = document.getElementById('invoiceDateField');
                var invoiceTimeField = document.getElementById('invoiceTimeField');
                if (this.checked) {
                    invoiceDateField.style.display = 'block';
                    invoiceTimeField.style.display = 'block';
                } else {
                    invoiceDateField.style.display = 'none';
                    invoiceTimeField.style.display = 'none';
                }
            });

            document.getElementById('offersent').addEventListener('change', function () {
                var offersentField = document.getElementById('offersentField');
                if (this.checked) {
                    offersentField.style.display = 'block';
                } else {
                    offersentField.style.display = 'none';
                }
            });

            document.getElementById('trial_account').addEventListener('change', function () {
                var trial_sent_date = document.getElementById('trial_account_sent');
                var trial_expiry_date = document.getElementById('expiry_date_field');
                var account_username = document.getElementById('account_field');

                if (this.checked) {
                    trial_sent_date.style.display = 'block';
                    trial_expiry_date.style.display = 'block';
                    account_username.style.display = 'block';
                } else{
                    trial_sent_date.style.display = 'none';
                    trial_expiry_date.style.display = 'none';
                    account_username.style.display = 'none';
                }
            });
      </script>

        <script>
            let selectedDate = '';
            let demo_presenter = '';

            function updateSelectedDate(date) {
                selectedDate = date;
            }
            var form = document.getElementById('formContainer');

            // var presenterInput = form.querySelector('.presenter');
            
            var modal = document.getElementById("bookingModal");

            // Get the button that opens the modal
            var btn = document.getElementById("openModal");

            // Get all time slots
            var timeSlots = document.querySelectorAll(".time-slot");

            btn.onclick = function () {
                var form = document.getElementById('formContainer');
                var presenterInput = document.getElementById('dmcid');
                var presenterValue = presenterInput.value;

                console.log(presenterValue);
                var modal = document.getElementById("bookingModal");
                console.log(selectedDate)
                $.ajax({
                    type: "POST",  // Use POST or GET based on your server-side code
                    url: "noslot",  // Replace with the actual URL of your controller method
                    data: { selectedDate: selectedDate,
                        presenter:presenterValue
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                       

                        for (var i = 0; i < data.length; i++) {
                            var slotdate = data[i]['demo_date'];
                            var demo_presented = data[i]['presented_by'];
                            var demo_time = data[i]['demo_time'];

                            if (slotdate == selectedDate) {
                                console.log(slotdate, selectedDate);
                                var element = document.getElementById(demo_time);

                                // Check if the element exists
                                if (element) {
                                    // Set the background color

                                    element.classList.add('disabled');
                                }
                            }
                        }

                    },
                    
                    error: function (error) {
                        // Handle any errors here
                    }
                });
                modal.style.display = "block";
            }

            // When the user clicks on a time slot, set the selected time
            timeSlots.forEach(function (slot) {
                slot.onclick = function () {
                    var selectedTime = slot.getAttribute("data-time");
                    // Set the value of the input field using the correct variable name
                    document.getElementById('openModal').value = selectedTime;
                    modal.style.display = "none";
                }
            });

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            }

            function cancelupdate() {
                const formContainer = document.getElementById('formContainer');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }

            function canceledit() {
                const formContainer = document.getElementById('editmodal');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }

            function cancelupdate2() {
                const formContainer = document.getElementById('formContainers');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
        </script>