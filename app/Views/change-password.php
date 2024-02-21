<!-- <link rel="stylesheet" href="https://www.teamsignin.com/projectmanagerdemo/assets/css/argon.css?v=1.2.0"
  type="text/css"> -->
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

    .dark-version .card-footer {
        padding: 0.5rem 1rem;
        background-color: #344767;
        border-top: 0 solid rgba(0, 0, 0, .125);
    }

    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
<style>
    .form-control-s {
        display: block;
        width: 100%;
        padding: 0.5rem 0;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5rem;
        color: #495057;
        background-color: transparent;
        background-clip: padding-box;
        border: 1px solid #d2d6da;
        appearance: none;
        border-radius: 0.375rem;
        transition: 0.2s ease;
        text-align: left;
        padding: 0.525rem 0.75rem !important;
    }

    .select2 {
        /line-height: 1.1 !important;/

    }

    .select2-selection--single {
        height: 38px !important;
    }

    h5 {
        color: #2121e3;
    }

    button.btn.bg-success.btn-sm.float-end.mt-6.mb-0 {
        margin-left: 15px;
    }

    button.btn {
        height: 35px;
        width: 80px;
    }

    .btn {
        text-transform: uppercase;
    }
    input.form-control {
        margin-bottom: 20px;
    }

    textarea.form-control {
        margin-bottom: 20px;
    }

    label.form-control-label {
        margin-bottom: 10px;
    }

    select.form-control {
        margin-bottom: 20px;
    }
</style>
<?php include "header.php" ?>
<div class="container-fluid py-6">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-9">



                <div class="row">
                    <div class="col-12 col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="containers">
                                    <div class="item">
                                        <div>
                                            <h6 class="text-white text-capitalize ps-3">Change Password</h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item"></div>
                                </div>
                            </div>
                                <div class="card-body">

                                    <div class="box-body">
                                        <div class="errormessage"></div>
                                    </div>
                                    <form method="post" action="<?= base_url('passwordchange') ?>" class="slip" enctype="multipart/form-data">
                                        <div class="card mt-1" id="password">
                                            <div class="card-header">
                                                <!-- <h5>Change Password</h5> -->
                                                <?php if (session()->has('msg')): ?>
                                                    <div class="text-danger">
                                                        <?php echo session('msg'); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (session()->has('success')): ?>
                                                    <div class="text-success">
                                                        <?php echo session('success'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Current password</label>
                                                            <input class="form-control" id="id" type="text" name="current_password"
                                                                placeholder="" style="border: 1px solid #333 ;"
                                                                required>
                                                            <div style="color: red !important"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">New password</label>
                                                            <input type="text" class="form-control" id="designation"
                                                                name="new_pass" style="border: 1px solid #333;"
                                                               >
                                                            <div style="color: red !important"></div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="card-footer text-end">
                                                <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0"
                                                    type="submit">Update</button>
                                                 <a href=""><button
                                                    class="btn bg-danger text-white btn-sm float-end mt-6 mb-0" type="button">Cancel</button></a>

                                            </div>
                                        </div>
                                    </form>
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
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css" />
<script src="assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
</body>

</html>