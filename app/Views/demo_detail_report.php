<style>
    a {
        margin-left: 9px;
    }

    .fa-pencil-alt:before, .fa-pencil:before{
        font-size: 10px;
        margin-left: -8px;
    }

    

    .btn-group-sm>.btn i,
    .btn.btn-sm i {
        font-size: 20px;
        margin-bottom: 3px;
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
                                            <h6 class="text-white text-capitalize ps-3">Details </h6>
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
                                                        Status</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Payment</th>
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
                                                foreach ($report as $complete) {
                                                    // dd($complete->customer_name);
                                                        // dd($complete);
                                                        $serialNumber++ ?>
                                                        <tr id="row42" style="font-size:20px;">
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $serialNumber ?>
                                                            </td>
                                                            <td style="text-align: left; font-size: 16px;">
                                                                
                                                                <?php
                                                                $uri = service('uri');
                                                                $lastSegment = $uri->getSegment($uri->getTotalSegments());
                                                                // dd($lastSegment);die;
                                                                
                                                                ?>
                                                               <a href=" <?=base_url()?>view-more/<?= $complete->lead_id?>"><span style="margin-left: 10px;"><?= $complete->customer_name ?></span></a>
                                                               <br>
                                                                <?php if(!empty($complete->company_name)) : ?>
                                                                    <span style="margin-left: 15px; font-size: 12px;">( <?php echo $complete->company_name ?> )</span>
                                                                <?php endif?>
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
                                                            <?php
                                                            switch ($complete->m_status){ 
                                                                case 4:
                                                                echo 'Demo Completed on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($complete->demo_actual_date)) . '</span>';
                                                                break;
            
                                                            case 6:
                                                                echo 'Payment Received on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($complete->payment_date)) . ' </span>';
                                                                break;
                                                            case 7:
                                                                echo 'Delivered on <span style="color: #1C8BEE ;"> ' . date('d-M-Y', strtotime($complete->project_delivery_date)) . ' </span>';
                                                                break;
                                                            default:
                                                                echo 'Unknown Status';
                                                                break;
                                                            
                                                            }
                                                            ?>
                                                           
                                                            </td>
                                                            <td style="text-align:center; font-size:16px">
                                                                <?php if ($complete->m_status == 6 || $complete->m_status == 7) : ?>
                                                                    <a href="#"><span style="font-weight: 600;"><?= number_format($complete->amount, 2) ?></span></a><br>
                                                                    <?php if (!empty($complete->payment_mode)) : ?>
                                                                        <span style="font-size: 12px;"><?php echo $complete->payment_mode ?></span>
                                                                    <?php endif ?>
                                                                <?php else : ?>
                                                                    ---
                                                                <?php endif ?>
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
            </div>
        </div>

     
      
        <?php include "footer.php" ?>

       
        <!-- <script>
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
        </script> -->