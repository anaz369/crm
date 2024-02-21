<style>
    a {
        margin-left: 10px;
    }

    .fa-pencil-alt:before, .fa-pencil:before{
        font-size: 12px;
        margin-left: -8px;
    }

    #formContainer,
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

    #myForm {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

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

    .btn-group-sm>.btn i,
    .btn.btn-sm i {
        font-size: 20px;
        margin-bottom: 3px;
    }



    .error {
        font-size: 20px;
        
        margin-top: 70px;
        font-weight: bold;
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
                                            <h6 class="text-white text-capitalize ps-3">All Aborted Lead </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

                                <form method="get" autocomplete="off" action="demo-aborted">

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

                                            <button class="btn bg-gradient-primary btn-sm ms-auto mb-0" title="filter"
                                                type="submit" style="width: 70px; height: 40px;"><i class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </div>
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
                                                        SL</th>
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Customer Name</th>
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Reason</th>
                                                        <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?> 
                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                    width="20%" style="text-align:center;">
                                                    Phone number</th>
                                                <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                    width="20%" style="text-align:center;">
                                                    Email</th> -->

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center; width: 160px;">
                                                        Operations</th>
                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                    width="33%" style="text-align:center;">
                                                    Update</th> -->

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
                                                foreach ($abortedjoin as $join) {$serialNumber++ ?>
                                                    <tr id="row42" style="font-size:20px;">
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?= $serialNumber ?>

                                                        </td>
                                                        <td style="text-align: center; font-size: 16px;">
                                                            <span style="font-size: 13px;" data-id="<?= $join->lead_id ?>" data-priority="<?= $join->priority ?>" class="showFormButton2">
                                                                <i style="color: <?php echo ($join->priority == 2) ? 'red' : (($join->priority == 1) ? '#E4A11B' : ''); ?>" 
                                                                    class="fa-solid fa-heart" data-id="<?= $join->lead_id ?>" id="showFormButton2"></i>
                                                            </span>
                                                            <span style="margin-left: 10px;"><?= $join->customer_name ?> <a href="edit-lead/<?=  $join->lead_id ?>"><span class="pencil"><i class="fa fa-pencil"></i></span></a>
                                                        </span>
                                                        <br>
                                                            <?php if(!empty( $join->company_name)) : ?>
                                                                 <span style="margin-left: 28px; font-size: 12px;">(<?php echo $join->company_name ?>)</span>
                                                            <?php endif?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $join->abort_reason ?>

                                                        </td>
                                                        <?php 
                                                            $role=session('user_type');
                                                            if($role== 0): ?>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $join->username ?>
                                                            </td>
                                                        <?php endif; ?>
                                                        <!-- <td style="text-align:center; font-size:16px;">
                                                    11/02/2023
                                                </td>
                                                <td style="text-align:center; font-size:16px">
                                                    example@gmail.com
                                                </td> -->


                                                                
                                                        <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                            <a href="view-more/<?=  $join->id ?>" title="view">
                                                                <span
                                                                    style="cursor: pointer;" ">
                                                                                                                                                                                                                                                                                                    <i class="
                                                            fa fa-eye" title="view"
                                                                    style="font-size:20px;"></i>
                                                                </span>
                                                            </a>
                                                            <!--<a href="edit-lead" title="Edit">-->
                                                            <!--    <span class="" id="edbtn_42"-->
                                                            <!--        style="cursor: pointer; font-size:10px">-->
                                                            <!--        <i class="fa fa-edit"-->
                                                            <!--            style="color: light blue;font-size:20px;"></i>-->
                                                            <!--        <span class="title-text" style="display: none;">Edit</span>-->
                                                            <!--    </span>-->
                                                            <!--</a>-->

                                                            <a href="#" title="Delete">
                                                                <span style="cursor: pointer;"
                                                                    onclick="confirmDelete('<?= $join->id ?>');">
                                                                    <i class="fa fa-trash" title="Delete"
                                                                        style=" font-size: 20px;"></i>
                                                                </span>
                                                            </a>
                                                            <a href="#" title="Update">
                                                                <span class="showFormButton" style="cursor: pointer;"
                                                                    data-id=" <?=  $join->id ?>">
                                                                    <i class="fa fa-wrench" id="showFormButton"
                                                                        data-id=" <?=  $join->id ?> ?> "
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">Update</span>
                                                                </span>
                                                            </a>


                                                        </td>

                                                    </tr>
                                                    <?php 
                                                }
                                }
                                ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <div class="pagination  text-center">

                                    <div style='margin-top: 10px;'>
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
        <?php include "footer.php" ?>
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
        <div id="formContainer">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm">
            <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update To New Demo Schedule</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Demo Schedule date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        onchange="updateSelectedDate(this.value)"
                                        style="border: 1px solid #333; padding-left:10px;">
                                    <div style="color: red !important"></div>
                                </div>
                            </div>


                            
                            <div class="col-lg-6" id="">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">
                                        Select Demo Giver</label>
                                    <select class="form-control" name="demo_giver" required
                                        onchange="getpresenter(this.value);" style="border: 1px solid #333;">
                                        <option value="">--Select--</option>
                                        <?php foreach ($users as $user) { ?>
                                            <option value="<?= $user['id'] ?>">
                                                <?= $user['username'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Demo Schedule time</label>
                                    <!-- <button id="openModal">Select Booking Time</button> -->
                                    <input type="text" class="form-control" id="openModal" name="time"
                                        style="border: 1px solid #333;" value=""> </input>
                                    </select>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Preferred Language</label>
                                    <select class="form-control" name="language" id="demo_status" required
                                        onchange="getdesignation();" style="border: 1px solid #333; padding-left:10px;">
                                        <option value="">--Select--</option>
                                        <option value="English"> English </option>
                                        <option value="Malayalam"> Malayalam </option>
                                        <option value="Arabic"> Arabic </option>
                                        <option value="Hindi"> Hindi </option>
                                    </select>
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
                            <!-- <button id="openModal">Select Booking Time</button> -->

                            <!-- The Modal -->
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
        <script>
            function confirmDelete(id) {
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete_demo_aborted/'); ?>" + id;
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
                console.log(leadId)

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
            let selectedDate = '';
            let demo_presenter = '';

            function updateSelectedDate(date) {
                selectedDate = date;
            }
            function getpresenter(presenter) {
                demo_presenter = presenter;
            }
            var modal = document.getElementById("bookingModal");

            // Get the button that opens the modal
            var btn = document.getElementById("openModal");

            // Get all time slots
            var timeSlots = document.querySelectorAll(".time-slot");
            // Inside the JavaScript code for the modal


            
            // When the user clicks the button, open the modal
            btn.onclick = function () {
                $.ajax({
                    type: "POST",  // Use POST or GET based on your server-side code
                    url: "noslot",  // Replace with the actual URL of your controller method
                    data: { selectedDate: selectedDate,
                        presenter:demo_presenter
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        console.log(data);
                        console.log(demo_presenter)
                        console.log(selectedDate)

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
        </script>