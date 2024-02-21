<style>
    a {
        margin-left: 10px;
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
        z-index: 3;
    }

    
    .fa-pencil-alt:before, .fa-pencil:before{
        font-size: 12px;
        margin-left: -8px;
    }

    #myForm3 {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }
    #myForm4 {
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

    #formContainer2,
    #formContainer3 {
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

    /* Initially hide the form */
    #formContainer {
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
    #myFormdeli {
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
                                            <h6 class="text-white text-capitalize ps-3"> Project Delivered Leads </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

                                <form method="get" autocomplete="off" action="delivered-leads">

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

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Contact Details</th>
                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                    style="text-align:center;">
                                                    Payment Date</th> -->
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Delivery Date</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Remarks</th>
                                                        <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?> 
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align: center; width: 155px">
                                                        Operations</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;

                                                foreach ($delivered as $deliver) {
                                                    $name = $deliver['customer_name']; ?>

                                                    <tr id="row42" style="font-size:20px;">
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?= $i; ?>

                                                        </td>
                                                        <td style="text-align: left; font-size: 16px;">
                                                            <span style="font-size: 13px;" data-id="<?= $deliver['id'] ?>" data-priority="<?= $deliver['priority']?>" class="showFormButton2">
                                                                <i style="color: <?php echo ($deliver['priority'] == 2) ? 'red' : (($deliver['priority'] == 1) ? '#E4A11B' : ''); ?>" 
                                                                    class="fa-solid fa-heart" data-id="<?= $deliver['id'] ?>" id="showFormButton2"></i>
                                                            </span>
                                                            <?php
                                                             $uri = service('uri');
                                                             $lastSegment = $uri->getSegment($uri->getTotalSegments());
                                                            // dd($lastSegment);die;
                                                            
                                                            ?>
                                                            <span style="margin-left: 10px;"><?= $deliver['customer_name'] ?> <a href="<?= base_url("edit-lead/{$lastSegment}/{$deliver['id']}") ?> ?>"><span class="pencil"><i class="fa fa-pencil"></i></span></a></span>
                                                            <br>
                                                            <?php if(!empty($deliver['company_name'])) : ?>
                                                                 <span style="margin-left: 28px; font-size: 12px;">(<?php echo $deliver['company_name'] ?>)</span>
                                                            <?php endif?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $deliver['email'] ?><br>
                                                            <?= $deliver['mobile_number'] ?>
                                                        </td>
                                                        <!-- <td style="text-align:center; font-size:16px">
                                                    <? //= $deliver->payment_date ?>
                                                </td> -->
                                                        <?php
                                                        // Assuming $join->demo_date contains the date in 'YYYY-MM-DD' format
                                                        $originalDate = $deliver['project_delivery_date'];
                                                        $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                        ?>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $formattedDate ?><br>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $deliver['delivery_remark'] ?>
                                                        </td>

                                                        <?php 
                                                            $role=session('user_type');
                                                            if($role== 0): ?>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $deliver['username'] ?>
                                                            </td>
                                                        <?php endif; ?>


                                                        <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                            <a href="view-more/<?= $deliver['id'] ?>" title="view">
                                                                <span
                                                                    style="cursor: pointer;" ">
                                                              
                                                                                                                                                    <i class="
                                                            fa fa-eye" title="view"
                                                                    style="font-size:20px;"></i>
                                                                </span>
                                                            </a>
                                                            <a href="#" title="edit">
                                                                <?php $id = $deliver['id'];
                                                                $customer_name = $deliver['customer_name'];
                                                                $date = $deliver['project_delivery_date'];
                                                                $remark = $deliver['delivery_remark'];
                                                                $support_given = $deliver['support_given'];
                                                                // dd($support_given);?>
                                                                
                                                                <span class="EditshowFormButton1" style="cursor: pointer;"
                                                                    onclick="editdeli('<?= $id; ?>','<?= $customer_name; ?>','<?= $date; ?>','<?= $remark; ?>','<?= $support_given; ?>')"
                                                                    data-id=" <?= $deliver['id'] ?> ">
                                                                    <i class="fa fa-edit" id="EditshowFormButton1"
                                                                        data-id=" <?= $deliver['id'] ?> "
                                                                        style="color: light blue;font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Edit</span>
                                                                </span>
                                                            </a>


                                                            <!-- <a href="edit-lead/<?= $deliver['id'] ?>" title="Edit">
                                                                <span class="" id="edbtn_42"
                                                                    style="cursor: pointer; font-size:10px">
                                                                    <i class="fa fa-edit"
                                                                        style="color: light blue;font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Edit</span>
                                                                </span>
                                                            </a> -->

                                                            <a href="#" title="Delete">
                                                                <span style="cursor: pointer;"
                                                                    onclick="confirmDelete('<?= $deliver['id'] ?>');">
                                                                    <i class="fa fa-trash" title="Delete"
                                                                        style="font-size: 20px;"></i>
                                                                </span>
                                                            </a>
                                                            <a href="#" title="LiveUpdate">
                                                                <span class="LiveshowFormButton" style="cursor: pointer;"
                                                                    data-id=" <?= $deliver['id'] ?> ">
                                                                    <i class="fa fa-info" id="LiveshowFormButton"
                                                                        data-id=" <?= $deliver['id'] ?>"
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Live
                                                                        Update</span>
                                                                </span>
                                                            </a>


                                                        </td>
                                                        <!-- <td class="align-middle" style="margin: left 2px; text-align:center;">

                                                    
                                                </td> -->

                                                    </tr>
                                                    <?php $i = $i + 1;
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
        </div>
        <script>
    function editdeli(id, name, date, remark, supportgiven) {
        // Display the modal
        console.log(supportgiven)
        editmodal.style.display = editmodal.style.display === 'block' ? 'none' : 'block';
        
        // Set values for existing fields
        $('#dlid').val(id);
        $('#dlname').val(name);
        $('#dldate').val(date);
        $('#dlremark').val(remark);

        
        const supporter =document.getElementById('dlsupportgiven')

        if(supporter){
           Array.from(supporter.options).forEach(option =>{
            option.selected = option.value == supportgiven;
           })
        }
    }
</script>


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

        <div id="formContainer2">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm3" action="viewall-leads">
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

                            <!-- </div> -->




                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                    <button onclick="cancelupdate2()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button"
                             >Cancel</button>

                    </div>
                </div>
            </form>
        </div>
        <script>
            const LiveshowFormButton = document.getElementById('LiveshowFormButton');
            const formContainer2 = document.getElementById('formContainer2');
            let LivelastAppendedInput = null;

            formContainer2.addEventListener('click', (event) => {
                if (event.target === formContainer2) {
                    formContainer2.style.display = 'none';
                }
            });

            // Get a reference to the elements with the class "showFormButton"
            const LiveshowFormButtons = document.querySelectorAll('.LiveshowFormButton');

            // Add click event listeners to each button
            LiveshowFormButtons.forEach((LiveshowFormButton) => {
                LiveshowFormButton.addEventListener('click', () => {
                    // Extract the data-id attribute value
                    const leadId = LiveshowFormButton.getAttribute('data-id');

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm3'); // Replace 'myForm' with your form's actual ID
                    if (LivelastAppendedInput) {
                        form.removeChild(LivelastAppendedInput);
                    }
                    LivelastAppendedInput = inputField;
                    form.appendChild(inputField);
                    formContainer2.style.display = formContainer2.style.display === 'block' ? 'none' : 'block';

                    // Alert the leadId value

                });
            });



        </script>
        <?php include "footer.php" ?>
        <div id="editmodal">
            <form method="post" class="slip" enctype="multipart/form-data" id="myFormdeli" action="deliveredleads_edit">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Edit Delivered Leads</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <input id="dlid" type="hidden" name="leadid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Customer Name</label>
                                    <input type="text" class="form-control" id="dlname" name="customer_name"
                                        style="border: 1px solid #333; padding-left: 10px;" readonly>
                                    <div style="color: red !important"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Delivery Date</label>
                                    <input type="date" class="form-control" id="dldate" name="project_delivery_date"
                                        style="border: 1px solid #333; padding-left:10px;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                           <div class="col-lg-6">
                                <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Support Given By</label>
                                                            <select class="form-control" name="support_given" id="dlsupportgiven"
                                                                 
                                                                style="border: 1px solid #333;">
                                                                <option value="">--Select type--</option>
                                                                <?php foreach ($support as $supportgivn) { ?>
                                                                    <option value="<?= $supportgivn['id'] ?>" <?= ($supportgivn['id'] == isset($delivered['support_given'])) ? 'selected' : ''; ?>>
                                                                        <?= $supportgivn['name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                                
                                                            </select>
                               </div>                         
                            </div> 





                            

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="dlremark" name="delivery_remark"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                    

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 " type="submit"
                            style="margin-left:2px">Save</button>
                         <button onclick="cancelupdate()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button"
                             >Cancel</button>

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
        <script>
            function confirmDelete(id) {
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete-delivery-received/'); ?>" + id;
                }
            }
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


            function cancelupdate() {
                const formContainer = document.getElementById('editmodal');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
            function cancelupdate2() {
                const formContainer = document.getElementById('formContainer2');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
        </script>