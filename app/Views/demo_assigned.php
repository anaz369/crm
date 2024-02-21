<style>
    a {
        margin-left: 10px;
    }
    .fa-pencil-alt:before, .fa-pencil:before{
        font-size: 12px;
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
        z-index: 3;
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

    .check{
        border: 1px solid grey;
    }

    #formContainer,
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

    /* Center the form vertically and horizontally */
    #myForm,
    #myFormdemo,
    #myForm2,
    #myForm4{
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

    /* #completed {
        display: none;
    } */
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
                                            <h6 class="text-white text-capitalize ps-3">Demo Assigned Leads </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

                                <form method="get" autocomplete="off" action="demo-assigned">

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
                                                        SL</th>

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
                                                        Remarks</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Demo Date And Time</th>
                                                        <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Assigned To /<br/>Language</th>
                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Timezone</th> -->

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Industry Type</th>
                                                    
                                                     <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role== 0): ?>
                                                     <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Added By</th>   
                                                    <?php endif;?>    

                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center; width: 160px;">
                                                        Operations</th>
                                                </tr>
                                            </thead >
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
                                                foreach ($demo_assigned as $join) {
                                                    $serialNumber++
                                                        ?>
                                                    <tr id="row<?= $join->lead_id ?>" style="font-size:20px;">
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $serialNumber ?>
                                                        </td>
                                                        <td style="text-align: left; font-size: 16px;">
                                                            <span style="font-size: 13px;" data-id="<?= $join->lead_id ?>" data-priority="<?= $join->priority ?>" class="showFormButton2">
                                                                <i style="color: <?php echo ($join->priority == 2) ? 'red' : (($join->priority == 1) ? '#E4A11B' : ''); ?>" 
                                                                    class="fa-solid fa-heart" data-id="<?= $join->lead_id ?>" id="showFormButton2"></i>
                                                            </span>
                                                            <?php
                                                             $uri = service('uri');
                                                             $lastSegment = $uri->getSegment($uri->getTotalSegments());
                                                            // dd($lastSegment);die;
                                                            
                                                            ?>
                                                            <span style="margin-left: 10px;"><?= $join->customer_name ?> <a href="<?= base_url("edit-lead/{$lastSegment}/{$join->lead_id}") ?>"><span class="pencil"><i class="fa fa-pencil"></i></span></a>
                                                            <br>
                                                            <?php if(!empty($join->company_name)) : ?>
                                                                 <span style="margin-left: 28px; font-size: 12px;">(<?php echo $join->company_name ?>)</span>
                                                            <?php endif?>
                                                       
                                                       
                                                       </span>
                                                        </td>

                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $join->email ?><br>
                                                            <?= $join->mobile_number ?>
                                                        </td>
                                                        

                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $join->remark ?>
                                                        </td>

                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php if (!empty($join->postponed_date)) { 
                                                                $originalDate = $join->postponed_date;
                                                                $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                                ?>
                                                                
                                                                <?= $formattedDate ?><br>
                                                                <?= $join->postponed_time ?>

                                                            <?php } else { 
                                                                $originalDate = $join->newdemo_date;
                                                                $formattedDate = date('d-M-Y', strtotime($originalDate));
                                                                ?>
                                                                
                                                                <?= $formattedDate ?><br>
                                                                <?= $join->demo_time ?>

                                                            <?php } ?>   
                                                        </td>

                                                       
                                                        <td style="text-align:center; font-size:16px;">
                                                            <span class="text-info" style="font-size: 17px;">
                                                                <?php if (!empty($join->postponedpresentedby)): ?>
                                                                    <?php foreach ($users as $user): ?>
                                                                        <?php if ($user['id'] == $join->postponedpresentedby): ?>
                                                                            <?= $user['username'] ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <?= $join->presented_by_username ?>
                                                                <?php endif; ?>
                                                            </span><br>
                                                            <span class="text-dark"> <?php if (!empty($join->postponedlanguage)) { ?>
                                                               
                                                                <?= $join->postponedlanguage ?>

                                                            <?php } else { ?>
                                                                
                                                                <?= $join->demolanguage ?>

                                                            <?php } ?>   </span>
                                                        </td>


                                                        <td style="text-align:center; font-size:16px">
                                                            <?php $i_type = $join->industry_type;
                                                            foreach ($industry as $ins) {
                                                                if ($i_type == $ins['id']) {
                                                                    echo $ins['industry_type'];
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $role=session('user_type');
                                                            if($role== 0): ?>
                                                            <td style="text-align:center; font-size:16px;">
                                                                <?= $join->username ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <td class="align-middle" style="margin: left 2px; text-align:center;">
                                                            <a href="view-more/<?= $join->lead_id ?>" title="view">
                                                                <span
                                                                    style="cursor: pointer;" ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="
                                                            fa fa-eye" title="view"
                                                                    style="font-size:20px;"></i>
                                                                </span>
                                                            </a>
                                                            <a href="#" title="edit">
                                                                <?php $id = $join->lead_id;
                                                                $date = $join->demo_date;
                                                                $customer_name = $join->customer_name;
                                                                $remarks = $join->remark;
                                                                $time = $join->demo_time;
                                                                $language = $join->language; 
                                                                $presenter=$join->presented_by

                                                                ?>
                                                                
                                                                <span class="EditshowFormButton1" style="cursor: pointer;"
                                                                    onclick="editdemo('<?php echo $id; ?>','<?php echo $date; ?>','<?php echo addslashes($customer_name); ?>','<?php echo $remarks; ?>','<?php echo $time; ?>','<?php echo $language; ?>','<?php echo $presenter; ?>')"
                                                                    data-id=" <?= $join->lead_id ?> ">
                                                                    <i class="fa fa-edit" id="EditshowFormButton1"
                                                                        data-id=" <?= $join->lead_id ?> "
                                                                        style="color: light blue;font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Edit</span>
                                                                </span>
                                                            </a>



                                                            <a href="#" title="Delete">
                                                                <span style="cursor: pointer;"
                                                                    onclick="confirmDelete('<?= $join->lead_id ?>');">
                                                                    <i class="fa fa-trash" title="Delete"
                                                                        style=" font-size: 20px;"></i>
                                                                </span>
                                                            </a>


                                                            <a href="#" title="Update">
                                                                <span class="showFormButton" style="cursor: pointer;"
                                                                    demo-date="<?= $join->demo_date ?>"
                                                                    demo-time="<?= $join->demo_time ?>"
                                                                    presented="<?= $join->presented_by ?>"
                                                                    data-id=" <?= $join->lead_id ?> ">
                                                                    <i class="fa fa-wrench" id="showFormButton"
                                                                        data-id=" <?= $join->lead_id ?> "
                                                                        demo-date="<?= $join->demo_date ?>"
                                                                        demo-time="<?= $join->demo_time ?>"
                                                                        presented="<?= $join->presented_by ?>"
                                                                        style="font-size:20px;"></i>
                                                                    <span class="title-text"
                                                                        style="display: none;">Update</span>
                                                                </span>
                                                            </a>

                                                            <a href="#" title="Live Update">
                                                                <span class="InfoshowFormButton" style="cursor: pointer;"
                                                                    data-id=" <?= $join->lead_id ?> ">
                                                                    <i class="fa fa-info" id="InfoshowFormButton"
                                                                        data-id=" <?= $join->lead_id ?> "
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
                                }
                                // }
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
            <?php if (empty($search)): ?>
                <div class="print-pri">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <?php if (isset($page) && $page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page-nr=<?= $page - 1 ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <?php if ($page > 4): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page-nr=1">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php for ($counter = $page - 3; $counter <= $page + 3; $counter++): ?>
                                    <?php if ($counter >= 1 && $counter <= $totalPages): ?>
                                        <li class="page-item <?= ($counter == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?page-nr=<?= $counter ?>">
                                                <?= $counter ?>
                                            </a>
                                        </li>

                                    <?php endif; ?>
                                <?php endfor; ?>
                                <?php if ($page < $totalPages - 3): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page-nr=<?= $totalPages ?>">
                                            <?= $totalPages ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!isset($page)): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page-nr=2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </a>
                                    </li>
                                <?php elseif (isset($page) && $page < $totalPages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page-nr=<?= $page + 1 ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <select class="w-20 form-select box mt-3 sm:mt-0"
                            onchange="window.location.href = '?page-nr=' + this.value;">
                            <?php for ($counter = 1; $counter <= $totalPages; $counter++): ?>
                                <option value="<?= $counter ?>" <?= ($counter == $page) ? 'selected' : '' ?>>
                                    <?= $counter ?>
                                </option>
                            <?php endfor; ?>
                        </select>

                    </div>
                </div>
            <?php endif ?>
        </div>
        <script>
            function editdemo(id, date, name, remark, time,language,presenter) {
                // alert(id);alert(date); alert(name);alert(remark)
                var new_time=time;

                console.log(new_time);
                if(new_time>12)
                {
                    new_time=new_time-12.00;
                }
                //$('#editmodal').modal('show'); 
                const [timePart, ampm] = time.split(' ');
                const [hours, minutes] = timePart.split(':');
                
                console.log('fine')

                // Convert to 24-hour format if necessary
                let formattedHours = parseInt(hours, 10);
                if (ampm === 'PM' && formattedHours !== 12) {
                    formattedHours += 12;
                } else if (ampm === 'AM' && formattedHours === 12){
                    formattedHours = 0;
                }

                // Format the time in "hh:mm" format
                const formattedTime = `${formattedHours.toString().padStart(2, '0')}:${minutes}`;
                editmodal.style.display = editmodal.style.display === 'block' ? 'none' : 'block';
                // var rid =$('#ba').val();

                $('#dmid').val(id);

                $('#dmeddate').val(date);
                $('#dmedname').val(name);
                $('#dmedremark').val(remark);
                $('#dmtime').val(formattedTime);
                $('#dmlanguage').val(language);
                // $('#dmlanguage').val(language);

                const presenterSelect = document.getElementById('presenterSelect');
               
                if (presenterSelect) {
                    Array.from(presenterSelect.options).forEach(option => {
                        option.selected = option.value == presenter;
                    });
                }
            }
        </script>
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
                        <a href="demo-assigned"><button class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                type="button">Cancel</button></a>

                    </div>
                </div>
            </form>
        </div>
        <div id="editmodal">
            <form method="post" class="slip" enctype="multipart/form-data" id="myFormdemo" action="demoassigned_edit">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Edit Assigned Leads</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <input id="dmid" type="hidden" name="leadid">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Customer Name</label>
                                    <input type="text" class="form-control" id="dmedname" name="customer_name"
                                        style="border: 1px solid #333; padding-left: 10px;" readonly>
                                    <div style="color: red !important"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Demo Date</label>
                                    <input type="date" class="form-control" id="dmeddate" name="demo_date"
                                        style="border: 1px solid #333; padding-left:10px;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Demo time</label>
                                    <input type="time" class="form-control" id="dmtime" name="demo_time"
                                        style="border: 1px solid #333; padding-left:10px;">
                                    <div style="color: red !important"> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Preferred Language</label>
                                    <select class="form-control" name="language" id="dmlanguage" required
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
                            <div class="col-lg-6" id="">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">
                                        Select Demo Giver</label>
                                    <select id="presenterSelect" class="form-control" name="demo_giver" 
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Remarks</label>
                                    <textarea type="text" class="form-control" id="dmedremark" name="remark"
                                        style="border: 1px solid #333;"></textarea>
                                    <div style="color: red !important"> </div>
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
                closeModal(); 
            });

            function closeModal() {
                // Implement the dismiss action here (e.g., hide the modal)
                var modal = document.getElementById("editmodal");
                modal.style.display = "none";
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

        <div id="formContainer">
            <form method="post" class="slip" enctype="multipart/form-data" id="myForm" action="demo_assigned_update">
                <div class="card mt-1" id="password">
                    <div class="card-header">
                        <h5>Update Demo Status</h5>
                    </div>
                    <div class="card-body pt-0">


                        <div class="row">


                            <div class="col-lg-12" id="statusdiv">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Status</label>
                                    <select class="form-control" name="status" id="demo_status" required
                                        onchange="getdesignation();" style="border: 1px solid #333; padding-left:10px;">
                                        <option value="">Select Demo Status</option>
                                        <option value="1"> Completed </option>
                                        <option value="2"> Postponed </option>
                                        <option value="3"> Aborted </option>

                                    </select>
                                </div>
                            </div>

                            <div id="completed" style="display:none;">
                            <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Additional features</label>
                                                <textarea type="text" class="form-control" id="remarks" name="additional_features" style="border: 1px solid #333; padding-left:10px;"></textarea>
                                                <div style="color: red !important"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="form-group">
                                                <label class="form-control-label" for="input-username">Remarks</label>
                                                <textarea type="text" class="form-control" id="remarks" name="remarks" style="border: 1px solid #333;"></textarea>
                                                <div style="color: red !important"></div>
            
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
                                      

                                        <div class="card-footer text-end">
                                            <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0" type="submit" style="margin-left:2px">Save</button>
                                          <button onclick="cancelupdate()" class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button">Cancel</button>
                                        </div>
                                    </div>
                            </div>


                            <div id="postponed" style="display:none;">
                                <div class="row">
                                   
                                   
                                    <!-- <input type="hidden" value=""> -->
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">New Demo date</label>
                                        <input type="date" class="form-control" id="date" name="new_date"
                                            onchange="updateSelectedDate(this.value)"
                                            style="border: 1px solid #333; padding-left:10px;">
                                        <div style="color: red !important"></div>
                                    </div>
                                </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">New Demo
                                                Time</label>
                                            <input type="time" class="form-control" id="remarks" name="new_time"
                                                style="border: 1px solid #333;"></input>
                                            <div style="color: red !important"> </div>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6" id="">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                Select Demo Giver</label>
                                            <select id="presenterSelect1" class="form-control" name="demo_giver" 
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
                                            <label class="form-control-label" for="input-username">New Demo Time</label>
                                            <!-- <button id="openModal">Select Booking Time</button> -->
                                            <input type="text" class="form-control" id="openModal" name="new_time"
                                                style="border: 1px solid #333;" value=""> </input>
                                            </select>
                                            <div style="color: red !important"> </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Preferred Language</label>
                                            <select class="form-control" name="language"
                                               style="border: 1px solid #333; padding-left:10px;">
                                                <option value="">--Select Language--</option>
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
                                            <textarea type="text" class="form-control" id="remarks"
                                                name="postponed_remarks" style="border: 1px solid #333;"></textarea>
                                            <div style="color: red !important"> </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 "
                                            type="submit" style="margin-left:2px">Save</button>
                                        <button onclick="cancelupdate2()"
                                                class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                                type="button">Cancel</button>

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

                            <div id="aborted" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Date</label>
                                            <input type="date" class="form-control" id="remarks" name="aborted_date"
                                                style="border: 1px solid #333;"></input>
                                            <div style="color: red !important"> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Reason</label>
                                            <textarea type="text" class="form-control" id="remarks"
                                                name="aborted_reason" style="border: 1px solid #333;"></textarea>
                                            <div style="color: red !important"> </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0 "
                                            type="submit" style="margin-left:2px">Save</button>
                                       <button onclick="cancelupdate3()"
                                                class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                                type="button">Cancel</button>

                                    </div>
                                </div>
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
                var result = confirm("Want to delete this?");
                if (result) {
                    // If the user confirms, redirect to the CodeIgniter route
                    window.location.href = "<?php echo site_url('delete_demo_assigned/'); ?>" + id;
                }
            }
        </script>

        <script>
            const showFormButton = document.getElementById('showFormButton');
            const formContainer = document.getElementById('formContainer');
            let lastAppendedInput = null;
            let lastAppendedInputdate = null;
            let lastAppendedInputtime = null;
            let lastAppendedpresented = null;
            // Add a click event listener to the button
            const showFormButtons = document.querySelectorAll('.showFormButton');
            showFormButtons.forEach((showFormButton) => {
                showFormButton.addEventListener('click', () => {
                    // Toggle the visibility of the form container
                    const leadId = showFormButton.getAttribute('data-id');
                    const demo_time = showFormButton.getAttribute('demo-time');
                    const demo_date = showFormButton.getAttribute('demo-date');
                    const presented = showFormButton.getAttribute('presented');


                    const inputField = document.createElement('input');
                    inputField.type = 'hidden'; // You can change the input type as needed
                    inputField.name = 'leadId'; // Set the input field name
                    inputField.value = leadId; // Set the leadId as the input field's value

                    inputField.className = 'form-control'; // Add the 'form-control' class
                    inputField.style.border = '1px solid #333';
                    inputField.style.paddingLeft = '10px';

                    const inputpresenter = document.createElement('input');
                    inputpresenter.type = 'hidden'; // You can change the input type as needed
                    inputpresenter.name = 'presented_by'; // Set the input field name
                    inputpresenter.value = presented; // Set the leadId as the input field's value

                    inputpresenter.className = 'form-control presenter'; // Add the 'form-control' class
                    inputpresenter.style.border = '1px solid #333';
                    inputpresenter.style.paddingLeft = '10px';

                    const inputdate = document.createElement('input');
                    inputdate.type = 'hidden'; // You can change the input type as needed
                    inputdate.name = 'demo_date'; // Set the input field name
                    inputdate.value = demo_date; // Set the leadId as the input field's value

                    inputdate.className = 'form-control'; // Add the 'form-control' class
                    inputdate.style.border = '1px solid #333';
                    inputdate.style.paddingLeft = '10px';

                    const inputtime = document.createElement('input');
                    inputtime.type = 'hidden'; // You can change the input type as needed
                    inputtime.name = 'demo_time'; // Set the input field name
                    inputtime.value = demo_time; // Set the leadId as the input field's value

                    inputtime.className = 'form-control'; // Add the 'form-control' class
                    inputtime.style.border = '1px solid #333';
                    inputtime.style.paddingLeft = '10px';

                    // Append the input field to the form
                    const form = document.getElementById('myForm'); // Replace 'myForm' with your form's actual ID
                    if (lastAppendedInput) {
                        form.removeChild(lastAppendedInput);
                    }
                    lastAppendedInput = inputField;
                    form.appendChild(inputField);

                    if (lastAppendedInputdate) {
                        form.removeChild(lastAppendedInputdate);
                    }
                    lastAppendedInputdate = inputdate;
                    form.appendChild(inputdate);


                    if (lastAppendedpresented) {
                        form.removeChild(lastAppendedpresented);
                    }
                    lastAppendedpresented = inputpresenter;
                    form.appendChild(inputpresenter);

                    if (lastAppendedInputtime) {
                        form.removeChild(lastAppendedInputtime);
                    }
                    lastAppendedInputtime = inputtime;
                    form.appendChild(inputtime);

                    formContainer.style.display = formContainer.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Close the form when clicking outside of it (optional)

            formContainer.addEventListener('click', (event) => {
                if (event.target === formContainer) {
                    formContainer.style.display = 'none';
                }
            });

            const completed = document.getElementById('completed');
            const demo_status = document.getElementById('demo_status');

            // Add a click event listener to the button
            demo_status.addEventListener('change', function () {
                // Check if the selected value is "complete"
                if (this.value === '1') {
                    // Show the "completed" div
                    completed.style.display = 'block';
                } else {
                    // Hide the "completed" div
                    completed.style.display = 'none';
                }
            });

            const postponed = document.getElementById('postponed');

            // Add a click event listener to the button
            demo_status.addEventListener('change', function () {
                // Check if the selected value is "complete"
                if (this.value === '2') {
                    // Show the "completed" div
                    var presenterInput = form.querySelector('.presenter');
                    var presenterValue = presenterInput.value;
                   

                    const presenterSelect = document.getElementById('presenterSelect1');
                    
                    
                         if (presenterSelect) {
                        Array.from(presenterSelect.options).forEach(option => {
                            if (option.value == presenterValue) {
                                option.selected = true;
                            } else {
                                option.selected = false;
                            }
                        });
                    }

                    postponed.style.display = 'block';

                } else {
                    // Hide the "completed" div
                    postponed.style.display = 'none';
                }
            });
            const aborted = document.getElementById('aborted');
            const statusDiv = document.getElementById('statusdiv');

            // Add a click event listener to the button
            demo_status.addEventListener('change', function () {
                // Check if the selected value is "complete"
                if (this.value === '3') {
                    // Show the "completed" div
                    aborted.style.display = 'block';
                    statusDiv.className = 'col-lg-12';
                } else {
                    // Hide the "completed" div
                    aborted.style.display = 'none';
                    statusDiv.className = 'col-lg-6';
                }
            });
        </script>

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
                const formContainer = document.getElementById('completed');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
            function cancelupdate2() {
                const formContainer = document.getElementById('postponed');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
            function cancelupdate3() {
                const formContainer = document.getElementById('aborted');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
            function canceledit() {
                const formContainer = document.getElementById('editmodal');
                formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            }
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

            var presenterInput = form.querySelector('.presenter');
            
            var modal = document.getElementById("bookingModal");

            // Get the button that opens the modal
            var btn = document.getElementById("openModal");

            // Get all time slots
            var timeSlots = document.querySelectorAll(".time-slot");
            // Inside the JavaScript code for the modal


            
            // When the user clicks the button, open the modal
            btn.onclick = function () {
                var form = document.getElementById('formContainer');
                var presenterInput = form.querySelector('.presenter');
                var presenterValue = presenterInput.value;
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
                        // console.log(data);
                        // console.log(demo_presenter)
                        // console.log(selectedDate)

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
        </script>

