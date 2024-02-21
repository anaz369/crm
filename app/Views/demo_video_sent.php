<style>
    a {
        margin-left: 10px;
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
        margin-top: 70px;
        font-weight: bold;
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
                                            <h6 class="text-white text-capitalize ps-3">Demo Video Sent Leads </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

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
                                                        SN</th>
                                                    <th class=" text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Customer Name</th>
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
                                                foreach ($demo_video_sent as $demovideo_sent) {
                                                    $serialNumber++ ?>
                                                    <tr id="row42" style="font-size:20px;" class="text-center">
                                                        <td>
                                                            <?= $serialNumber ?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                                <a href="view-more/<?=$demovideo_sent['id']?>">
                                                                    <?= $demovideo_sent['customername'] ?>
                                                                    <br>
                                                                    <?php if(!empty($mailsent['company_name'])) : ?>
                                                                        <span style="margin-left: 10px; font-size: 12px;">(<?php echo $demovideo_sent['company_name'] ?>)</span>
                                                                    <?php endif?>
                                                                </a>
                                                                
                                                            </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php
                                                            $formattedDate = date('d-M-Y', strtotime($demovideo_sent['leaddate']));
                                                            echo $formattedDate;
                                                         ?>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $demovideo_sent['mobile_number'] ?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $demovideo_sent['email'] ?>
                                                        </td>
                                                        
                                                        <?php 
                                                    
                                                    $role=session('user_type');
                                                    if($role == 0): ?>
                                                        <td style="text-align:center; font-size:16px">
                                                            <?= $demovideo_sent['username'] ?>
                                                        </td>
                                                        <?php endif;?>
                                                        
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

     