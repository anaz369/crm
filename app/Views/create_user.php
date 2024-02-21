<!-- <link rel="stylesheet" href="https://www.teamsignin.com/projectmanagerdemo/assets/css/argon.css?v=1.2.0"
  type="text/css"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rq/ZUuI5YVX13biA2t4zDAxpJUSa4p9JxS9z3fkcHY4FS+Xbux2IS9n6Z6dH98b6" crossorigin="anonymous"></script>

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

    #state {
        display: none;
    }

    .grey-background {
        background-color: #f0f0f1;
        /* Light grey color */
        padding: 20px;
        /* Optional padding to add space around the content */
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
        /*line-height: 1.1 !important;*/

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
        padding: 8px 15px;
    }

    button.lead_sources {
        border: none;
        border-radius: 5px;
        background-color: #ec9e2d;
        box-shadow: 2px 2px #574343;
        color: #868686;
        margin-left: 20px;
    }

    .indstr,
    .reseller {
        /* float: left; */
        display: flex;
        justify-content: end;
        align-items: end;
        margin-left: 480px;
    }

    button.industry_types {
        border: none;
        border-radius: 5px;
        background-color: #ab9c3d;
        box-shadow: 2px 2px #574343;
        color: #405945;
    }

    button.resell {
        border: none;
        border-radius: 5px;
        background-color: #ab9c3d;
        box-shadow: 2px 2px #574343;
        color: #405945;
        margin-left: 6px;
    }

    #formContainers,
    #formContainers2,
    #formContainers3 {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background-color: rgba(0, 0, 0, 0.0);
        /* Semi-transparent background */
        z-index: 3;

    }

    #addindustryform,
    #addleadsourceform,
    #addresellerform {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-20%, -20%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }
</style>
<?php include "header.php" ?>
<div class="container-fluid py-4 mt-6">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-9">



                <div class="row">

                    <div class="col-12 col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h5 class="text-white" style="margin-left: 10px;">Create User</h5>
                                    <div class="multisteps-form__progress">
                                    </div>
                                </div>



                                <div class="card-body">

                                    <div class="box-body">
                                        <div class="errormessage"></div>
                                    </div>
                                    <form method="post" class="slip" enctype="multipart/form-data">
                                        <div class="card mt-1" id="password">
                                            <div class="card-header">
                                                <h5>Create User</h5>
                                                <?php if (session()->has('msg')): ?>
                                                    <div class="text-danger">
                                                        <?php echo session('msg'); ?>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Name</label>
                                                            <input class="form-control" id="id" type="text"
                                                                name="username" placeholder=""
                                                                style="border: 1px solid #333 ;" required>
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Designation</label>
                                                            <input class="form-control" id="id" type="text"
                                                                name="designation" placeholder=""
                                                                style="border: 1px solid #333 ;" required>
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">
                                                                Email(Username)</label>
                                                            <input type="email" class="form-control" id="mobile_number"
                                                                name="email" style="border: 1px solid #333;" required>
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                id="mobile_number" name="password"
                                                                style="border: 1px solid #333;" required>
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>




                                                </div>


                                                <div class="card-footer text-end">
                                                    <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0"
                                                        type="submit">Save</button>
                                                    <a href="<?= base_url('dashboard')?>"><button
                                                            class="btn bg-danger text-white btn-sm float-end mt-6 mb-0"
                                                            type="button">Cancel</button></a>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#cancel').click(function () {
            $('#formContainers').hide();
        });
    });
    $(document).ready(function () {
        $('#industry_type').click(function () {
            $('#formContainers').show();
        });
    });

    $(document).ready(function () {
        $('#cancel3').click(function () {
            $('#formContainers3').hide();
        });
    });
    $(document).ready(function () {
        $('#reseller').click(function () {
            $('#formContainers3').show();
        });
    });


    $(document).ready(function () {
        $('#cancel2').click(function () {
            $('#formContainers2').hide();
        });
    });
    $(document).ready(function () {
        $('#lead_source').click(function () {
            $('#formContainers2').show();
        });
    });

</script>
<script>
    $(document).ready(function () {
        // Initially hide the "Select Reseller" dropdown
        $('#resellers').hide();

        // Add a change event handler to the checkbox
        $('#resellerCheckbox').change(function () {
            if (this.checked) {
                $('#resellers').show();
            } else {
                $('#resellers').hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Initially, check the value of the "Country" dropdown on page load
        checkCountryValue();

        // Listen for changes in the "Country" dropdown
        $('#origincountry').change(function () {
            checkCountryValue();
        });

        function checkCountryValue() {
            var selectedCountry = $('#origincountry').val();

            // If the selected country is "India," show the "State" dropdown; otherwise, hide it
            if (selectedCountry === 'India') {
                $('#state').show();
            } else {
                $('#state').hide();
            }
        }
    });
</script>
<link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css" />
<script src="assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
</body>

</html>