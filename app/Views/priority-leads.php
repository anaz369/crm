<style>
    a {
        margin-left: 10px;
    }


    /* Initially hide the form */
    #formContainer,
    #formContainer2 {
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




    #formContainers{
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
    #myForm,
    #myForm5 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

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
    }

    .error {
        font-size: 20px;
        color: red;
        margin-top: 80px;
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
                                            <h6 class="text-white text-capitalize ps-3">Hot Leads </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($error)) { ?>
                                    <p class="text-center error">
                                        <?= $error ?>
                                    </p>;
                                    <?php
                                } else { ?>
                            <div class="card-body px-0 pb-2">
                            <form type="get" autocomplete="off">
                                <div class="row">

                                    <div class="col-1 col-sm-1"></div>
                                    <div class="col-1 col-sm-2 mt-1">
                                        <select id="multipleSelect" name="priority[]" multiple placeholder="Select Priority" data-search="true" data-silent-initial-value-set="true">
                                            <option value="1">Medium</option>
                                            <option value="2">High</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <div class="input-group input-group-dynamic">
                                            <input name="from" value="" class="multisteps-form__input form-control" type="date"/>
                                        </div>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <div class="input-group input-group-dynamic">
                                            <input name="to" value="" class="multisteps-form__input form-control" type="date"/>
                                        </div>
                                        <span></span>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <div class="input-group input-group-dynamic">
                                            <input name="search" value="" placeholder="Search" class="multisteps-form__input form-control" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-3 col-sm-1">
                                        <button class="btn bg-gradient-primary btn-sm ms-auto mb-0 btn-new" title="filter"><i class="fas fa-search" aria-hidden="true"></i></button>
                                    </div>
                                   
                                </form>
                                <!-- <form method="get" autocomplete="off" action="newlead">

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
                                </form> -->
                                    <?php if(isset($from_date) && isset($to_date)) : ?> 
                                        <p style="margin-left: 10px; font-size: 15px; ">Showing <?= count($priority_leads) ?> results for the date range <span style="font-size: 14px; margin-left: 1px;"><?=date('d-M-Y', strtotime($from_date))?> <span style="" > to</span> <?=date('d-M-Y', strtotime($to_date))?> </span> </p>
                                    <?php endif ?> 
                                    <div class="table-responsive pt-2">

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
                                                        Priority</th>  
                                                     <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Lead Date</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Phone number</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Email</th>
                                                     <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
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
                                                foreach ($priority_leads as $newlead) {
                                                    $serialNumber++ ?>
                                                    <tr id="row42" style="font-size:20px;" class="text-center">
                                                        <td>
                                                            <?= $serialNumber ?>
                                                        </td>
                                                        <td style="text-align:left; font-size:16px;">
                                                            <span style="font-size: 13px;" data-id="<?= $newlead['id'] ?>" data-priority="<?= $newlead['priority']?>" class="showFormButton2">
                                                                <i style="color: <?php echo ($newlead['priority'] == 2) ? 'red' : (($newlead['priority'] == 1) ? '#E4A11B' : ''); ?>" 
                                                                    class="fa-solid fa-heart" data-id="<?= $newlead['id'] ?>" id="showFormButton2"></i>
                                                            </span>
                                                            <span style="margin-left: 10px;"><?=$newlead['customer_name']?></span>
                                                            <br>
                                                            <?php if(!empty($newlead['company_name'])) :?>
                                                                 <span style="margin-left: 28px; font-size: 12px;">(<?php echo $newlead['company_name'] ?>)</span>
                                                            <?php endif?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php echo ($newlead['priority'] == 1) ? 'Medium' : (($newlead['priority'] == 2) ? '<span class="text-danger">High</span>' : ''); ?>
                                                        </td>

                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php
                                                            $formattedDate = date('d-M-Y', strtotime($newlead['date']));
                                                            echo $formattedDate;
                                                         ?>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $newlead['mobile_number'] ?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $newlead['email'] ?>
                                                        </td>
                                                        
                                                        <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role == 0): ?>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $newlead['username'] ?>
                                                        </td>
                                                        <?php endif;?>
                                                        <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                            <a href="view-more/<?= $newlead['id'] ?>" title="view">
                                                                <span style="cursor: pointer;">
                                                                    <i class="
                                                            fa fa-eye" title="view"
                                                                        style="font-size:20px;"></i>
                                                                </span>
                                                            </a>
                                                            <a href="edit-lead/<?= $newlead['id'] ?>" title="Edit">
                                                                <span class="" id="edbtn_42"
                                                                    style="cursor: pointer; font-size:10px">
                                                                    <i class="fa fa-edit"
                                                                        style="color: light blue;font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Edit</span>
                                                                </span>
                                                            </a>
                                                            <a href="#" title="Delete">
                                                                <span style="cursor: pointer;"
                                                                    onclick="confirmDelete('<?= $newlead['id'] ?>');">
                                                                    <i class="fa fa-trash" title="Delete"
                                                                        style="font-size: 20px;"></i>
                                                                </span>
                                                            </a>

                                                            <a href="#" title="Update">
                                                                <span class="showFormButton" style="cursor: pointer;"
                                                                    data-id=" <?= $newlead['id'] ?> ">
                                                                    <i class="fa fa-wrench" id="showFormButton"
                                                                        data-id=" <?= $newlead['id'] ?> "
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">Update</span>
                                                                </span>
                                                            </a>

                                                            <a href="#" title="Live Update">
                                                                <span class="InfoshowFormButton" style="cursor: pointer;"
                                                                    data-id=" <?= $newlead['id'] ?> ">
                                                                    <i class="fa fa-info" id="InfoshowFormButton"
                                                                        data-id=" <?= $newlead['id'] ?> "
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">Update</span>
                                                                </span>
                                                            </a>
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

        <?php include "footer.php" ?>

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
                        <a href="prioritized-leads"><button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                type="button">Cancel</button></a>

                    </div>
                </div>
            </form>
        </div>

        <div id="formContainer">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm" action="new_lead_update">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Lead</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">



                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Contacted Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        style="border: 1px solid #333;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Status</label>
                                    <select class="form-control" name="status" id="country" required
                                        onchange="getdesignation();" style="border: 1px solid #333;">
                                        <option value="">Select Status</option>
                                        <option value="1"> Responded </option>
                                        <option value="2"> Not Responded </option>

                                    </select>
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
                        <a href="prioritized-leads"><button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                type="button">Cancel</button></a>
                    </div>
                </div>
            </form>
        </div>

        <div id="formContainer2">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm5" action="update-priority">
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
                        <button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" id="cancel3"
                            type="button">Cancel</button>

                    </div>
                </div>
            </form>
        </div>

        <script>
            function confirmDelete(id) {
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete/'); ?>" + id;
                }
            }
        </script>

        <script>
            function cancelupdate() {
                const formContainer = document.getElementById('formContainer');
                formContainer.style.display = formContainer.style.display === none;
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

        <script src="assets/js/virtual-select.min.js"></script>

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




            const showFormButton2 = document.getElementById('showFormButton2');
            const formContainer2 = document.getElementById('formContainer2');
            let lastAppendedInput2 = null;

            formContainer2.addEventListener('click', (event) => {
                if (event.target === formContainer2) {
                    formContainer2.style.display = 'none';
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

                    const form = document.getElementById('myForm5'); 
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
                    formContainer2.style.display = formContainer2.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });

            document.addEventListener("DOMContentLoaded", function () {
                var cancelButton = document.getElementById("cancel3");
                var formContainer = document.getElementById("formContainer2");

                cancelButton.addEventListener("click", function () {
                    formContainer.style.display = "none";
                });
            });


            VirtualSelect.init({ 
            ele: '#multipleSelect' 
            });





        </script>
       