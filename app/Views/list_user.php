<style>
    a {
        margin-left: 10px;
    }

    .popup-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }
    .delete {
        width: 15px;
        float: right;
        margin-left: 5px;
    }

    .close {
        position: absolute;
        width: 14px;
        float: right;
        top: 10px;
        right: 10px;
    }

    .ad-select {
        padding: 5px;
        margin-top: -13px;
    }
    .task-form-popup {
        position: absolute;
        width: 450px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

    .btn {
        margin-top: 7px;
        background: #1C8BEE;
        border: none;
        border-radius: 4px;
        padding: 3px 10px;
        color: white;
        padding: 1px 15px;
        margin-bottom: 6px;
    }

    /* Center the form vertically and horizontally */
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
    #myForm {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }

    .pass{
        width: 23px;
        margin-top: -10px;
    }

    .error {
        font-size: 20px;
        color: red;
        margin-top: 70px;
        font-weight: bold;
    }
</style>
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
  .toggle.ios .toggle-handle { border-radius: 20rem; }
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
                                            <h6 class="text-white text-capitalize ps-3">All User </h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">

                                <form method="get" autocomplete="off" action="listuser">

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
                                                        Name</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Designation</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Email</th>


                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Operations</th>
                                                    <!-- <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                    width="33%" style="text-align:center;">
                                                    Update</th> -->
                                                    <!-- 
                                                <th width="15%"></th>
                                                <th width="15%"></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($allusers as $alluser) { ?>


                                                    <tr id="row42" style="font-size:20px;">
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?= $i ?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?= $alluser['username'] ?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $alluser['designation'] ?>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?= $alluser['email'] ?>
                                                        </td>




                                                        <td class="align-middle" style="margin: left 2px; text-align:center; max-width: 100px;">


                                                            <a href="edit-user/<?= $alluser['id'] ?>" title="Edit">
                                                                <span class="" id="edbtn_42"
                                                                    style="cursor: pointer; font-size:10px">
                                                                    <i class="fa fa-edit"
                                                                        style="color: black;font-size:20px;"></i>
                                                                    <span class="title-text" style="display: none;">Edit</span>
                                                                </span>
                                                            </a>

                                                            

                                                            <a href="#" title="Delete"
                                                                onclick="confirmDelete('<?= $alluser['id'] ?>')">
                                                                <span style="cursor: pointer;">
                                                                    <i class="fa fa-trash" title="Delete"
                                                                        style="color: red; font-size: 20px;"></i>
                                                                </span>
                                                            </a>

                                                            <a href="#" class="editTaskButton" title="change-password" data-toggle="modal" data-target="#changePasswordModal" data-id="<?= $alluser['id']?>">
                                                                <span class="" id="edbtn_42" style="cursor: pointer; font-size:10px">
                                                                    <img class="pass" src="https://icons.veryicon.com/png/o/business/background-management-system/change-password-5.png" alt="">
                                                                    <span class="title-text" style="display: none;">change pass</span>
                                                                </span>
                                                            </a>
                                                        
                                                            <div class="form-check form-switch">
                                                                <input style="float: right; margin: -18px 30px 0px 20px;" 
                                                                    data-id="<?=$alluser['id']?>" 
                                                                    data-status="<?=$alluser['status']?>"
                                                                    class="form-check-input user-switch" 
                                                                    type="checkbox" 
                                                                    role="switch" 
                                                                    id="flexSwitchCheckChecked"
                                                                <?php echo ($alluser['status'] != '3') ? 'checked':''?>> 
                                                            </div>

                                                            <div id="editContainer" class="popup-container">
                                                                <!-- <img class="editTaskClose close" src="http://cdn.onlinewebfonts.com/svg/img_342859.png" alt=""> -->
                                                                <div id="taskFormPopup" class="task-form-popup">
                                                                    <img class="editTaskClose close"
                                                                        src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-close-512.png"
                                                                        alt="">
                                                                    <form id="editTaskForm" method="post" action="<?=base_url('change-pass/'.$alluser['id']) ?>" >
                                                                        
                                                                        <div style="display: flex; flex-direction: column; gap: 10px;">
                                                                            <label style="margin-top: 4px;" for="task_title">Change Password:</label>
                                                                            <input style="margin-top: -8px; padding: 6px;" id="taskTitleInput" type="text"
                                                                                name="new_pass" placeholder="New Password">
                                                                        </div>
                                                                        <button style="padding: 3px 11px 5px 11px;"  class="btn btn-primary" type="submit">Update</button>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </td>
                                                      
                                                    </tr>
                                                    <?php $i = $i + 1;

                                                }

                                } ?>
                                        </tbody>


                                    </table>
                                    <script>
                                        function confirmDelete(id) {
                                            var result = confirm("Want to delete this?");
                                            if (result) {
                                                // If the user confirms, redirect to the CodeIgniter route
                                                window.location.href = "<?php echo site_url('delete_listuser/'); ?>" + id;
                                            }
                                        }
                                    </script>
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
        
        <?php include "footer.php" ?>
        <script>
    document.querySelectorAll(".editTaskButton").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("editContainer").style.display = "block";
        });
    });

    document.querySelectorAll(".editTaskClose").forEach(closeButton => {
        closeButton.addEventListener("click", function () {
            document.getElementById("editContainer").style.display = "none";
            // resetSelect()
        });
    });

    $(document).ready(function () {
    $('.user-switch').change(function () {
        var userId = $(this).data('id');
        
        if (!this.checked) {
            var confirmation = confirm("Are you sure want to block this user?");
            
            if (!confirmation) {
                // User clicked Cancel, revert the switch state and exit
                $(this).prop('checked', true);
                return;
            }
        }
        $.ajax({
            url: '<?=base_url()?>block-user', 
            type: 'POST', 
            data: {
                userId: userId,
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});



</script>