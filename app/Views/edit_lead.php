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
    #state {
        display: none;
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
                                    <h5 class="text-white" style="margin-left: 10px;">Create Lead</h5>
                                    <div class="multisteps-form__progress">
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="box-body">
                                        <div class="errormessage"></div>
                                    </div>
                                    <form method="post" class="slip" action="<?=base_url('edit-lead/').$newleads['id']?>" enctype="multipart/form-data">
                                        <div class="card mt-1" id="password">
                                            <div class="card-header">
                                                <h5>Edit Lead</h5>
                                            </div>
                
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Customer Name <span class="text-danger">*</span> </label>
                                                            <input class="form-control" id="id" type="text" name="customer_name"
                                                                placeholder="" value="<?= $newleads['customer_name'] ?>" style="border: 1px solid #333 ;"
                                                                required>
                                                            <div style="color: red !important"></div>
                                                        </div>
                                                        <input type="hidden" name="url" value="<?=$url?>" >
                                                        <input type="hidden" name="lead_id" value="<?=$newleads['id']?>" >
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Mobile Number <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control" id="mobile_number"
                                                                name="mobile_number" style="border: 1px solid #333;" value="<?= $newleads['mobile_number'] ?>"
                                                                required>
                                                            <div style="color: red !important"></div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Whatsapp Number <span class="text-danger">*</span> </label>
                                                            <input type="number" required class="form-control"
                                                                id="whatsapp_number" name="whatsapp_number" value="<?= $newleads['whatsapp_number'] ?>"
                                                                style="border: 1px solid #333;">
                                                            <div style="color: red !important"></div>
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Email
                                                                ID</label>
                                                            <input type="text" class="form-control" id="email" value="<?= $newleads['email'] ?>"
                                                                name="email" style="border: 1px solid #333;">
                                                            <div style="color: red !important"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Company Name</label>
                                                            <input type="text" class="form-control" id="company_name" value="<?= $newleads['company_name'] ?>"
                                                                name="company_name" style="border: 1px solid #333;">
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Company Address</label>
                                                            <textarea type="text" class="form-control" id="address"
                                                                name="address"
                                                                style="border: 1px solid #333;"><?= $newleads['address'] ?></textarea></textarea>
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Industry Type</label>
                                                            <select class="form-control" name="industry_type" id="country"
                                                                 onchange="getdesignation();"
                                                                style="border: 1px solid #333;">
                                                                <option value="">--Select type--</option>
                                                                <?php foreach ($industries as $industry) { ?>
                                                                    <option value="<?= $industry['id'] ?>" <?= ($industry['id'] == $newleads['industry_type']) ? 'selected' : ''; ?>>
                                                                        <?= $industry['industry_type'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Country <span class="text-danger">*</span> </label>
                                                            <select class="form-control" name="country" required id="country"
                                                                 onchange="getdesignation();"
                                                                style="border: 1px solid #333;">
                                                                <?php foreach ($countries as $country) {
                                                                    if($country['id']==$newleads['country']){ ?>
                                                                    <option value="<?= $country['id'] ?>">
                                                                        <?= $country['name'] ?>
                                                                    </option>
                                                                    <?php } } ?>
                                                                <!-- <option value="">Select Country</option> -->
                                                                
                                                                <?php foreach ($countries as $country) { ?>
                                                                    <option value="<?= $country['id'] ?>">
                                                                        <?= $country['name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">
                                                            Customer's Country of Origin</label>
                                                            <select class="form-control" name="origincountry"
                                                                id="origincountry"  onchange="getdesignation();"
                                                                style="border: 1px solid #333;">
                                                                <!-- <option value="<?//= $newleads['origincountry'] ?>">
                                                                <?//= $newleads['origincountry'] ?></option> -->
                                                               <?php if($newleads['origincountry']== null){?>
                                                                <option value="">--Select-- </option>
                                                                <?php } ?>
                                                                <?php foreach ($countries as $country) { ?>
                                                                    <option value="<?= $country['name'] ?>" <?= ($country['name'] == $newleads['origincountry']) ? 'selected' : '' ?>>
                                                                        <?= $country['name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Campaign ID</label>
                                                            <input type="text" value="<?= $newleads['campaign_id']?>" class="form-control" id="campaign_id"
                                                                name="campaign_id" style="border: 1px solid #333;">
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($newleads['state'] !== null || $newleads['origincountry'] === 'India'){?>
                                                        <div class="col-lg-6" id="state">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">
                                                                    Select State</label>
                                                                <select class="form-control" name="state" 
                                                                    onchange="getdesignation();"
                                                                    style="border: 1px solid #333;">
                                                                    <!-- <option value="">Select State</option> -->
                                                                    <option value="<?= $newleads['state'] ?>">
                                                                            <?= $newleads['state'] ?>
                                                                        </option>
                                                                    <?php foreach ($states as $state) { ?>
                                                                        <option value="<?= $state['state'] ?>">
                                                                            <?= $state['state'] ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Lead
                                                                Source</label>
                                                                <select class="form-control" name="lead_source" required id="lead_source"
                                                                 onchange="getdesignation();"
                                                                style="border: 1px solid #333;">
                                                                <?php foreach ($leadsource as $leadsources) {
                                                                    if($leadsources['name']==$newleads['lead_source']){ ?>
                                                                    <option value="<?= $leadsources['name'] ?>">
                                                                        <?= $leadsources['name'] ?>
                                                                    </option>
                                                                    <?php } } ?>
                                                                <!-- <option value="">Select Country</option> -->
                                                                
                                                                <?php foreach ($leadsource as $leadsources) { ?>
                                                                    <option value="<?= $leadsources['name'] ?>">
                                                                        <?= $leadsources['name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Reffered By</label>
                                                            <input type="text" class="form-control" id="referred_by" value="<?= $newleads['referred_by'] ?>"
                                                                name="referred_by" style="border: 1px solid #333;">
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>
                                                <?php if ($newleads ['Reseller'] != null){
                                                    ?>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">
                                                                Reseller</label>
                                                            <select class="form-control" name="origincountry"
                                                                id="origincountry" onchange="getdesignation();"
                                                                style="border: 1px solid #333;">
                                                                <option value="<?= $newleads['Reseller'] ?>">
                                                                <?= $newleads['Reseller'] ?></option>
                                                                <?php foreach ($resellers as $reseller) { ?>
                                                                    <option value="<?= $reseller['reseller'] ?>">
                                                                        <?= $reseller['reseller'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                                <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Lead Retrieved Date <span class="text-danger">*</span> </label>
                                                                <input type="date" value="<?php $dateld=date_create($newleads['date']); echo date_format($dateld,"Y-m-d");?>" class="form-control" required id="referred_by"
                                                                name="date" style="border: 1px solid #333;">
                                                            <div style="color: red !important"> </div>
                                                     </div>
                                                 </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-username">Remarks</label>
                                                            <textarea type="text" class="form-control" id="remarks"
                                                                name="remarks"
                                                                style="border: 1px solid #333;"><?= $newleads['remarks'] ?></textarea>
                                                            <div style="color: red !important"> </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="card-footer text-end">
                                                <button class="btn bg-success text-white btn-sm float-end mt-6 mb-0"
                                                    type="submit">Save</button>
                                                 <a href="<?= base_url()?>/viewall-leads"><button
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css" />
<script src="assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
</body>

</html>