<!-- <link rel="stylesheet" href="https://www.teamsignin.com/projectmanagerdemo/assets/css/argon.css?v=1.2.0"
  type="text/css"> -->
  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
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
    margin-bottom: 15px;
    padding-top: 20px;
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
        background-color: #d81b60;
        box-shadow: 2px 2px #574343;
        color: #ffffff;
    }

    button.resell {
        border: none;
        border-radius: 5px;
        background-color: #d81b60;
        box-shadow: 2px 2px #574343;
        color: #ffffff;
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
    .add-button {
        width: 35px;
        height: 37px;
        background-color: #337ab7;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin-left: 15px;
        margin-right: -20px;
        margin-top: 2px;
    }

    /* Add some hover effect to make it more visually appealing */
    .add-button:hover {
        background-color: #286090;
    }
    .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
    height: 100px;
    /* border-radius: 0px 0px 10px 10px; */
}
.image-formate {
    font-size: 10px;
    margin-left: 10px;
}
</style>
<?php include "header.php" ?>
<div class="container-fluid py-4 mt-5" style="padding: 0px 175px;">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-9">
                <div class="row">
                    <div class="col-12 col-lg-12 m-auto">
                        <div class="card">
                            <form method="post" class="slip" action="<?=base_url('ticket')?>" enctype="multipart/form-data"  id="form">
                                <div class="card-header text-center">
                                    <h5>Create New Support Ticket</h5>
                                </div>
                                <div class="col-lg-12">
                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success">
                                            <?= session()->getFlashdata('success') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-username">Title</label>
                                                    <input type="text" name="title" id="title" class="form-control bg-white" style="border: 1px solid #333 ;" required>
                                                <div style="color: red !important"> </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-username">Description</label>
                                                    <textarea name="description" id="description" class="form-control bg-white"  rows="4"style="border: 1px solid #333 ;"></textarea>
                                                <div style="color: red !important"> </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Attach Images/PDF<span class="image-formate">(JPG/JPEG/PNG/PDF)<span></label>
                                                <div class="input-group row">
                                                    <div class="input-row d-flex mt-1 col-lg-6">
                                                        <input type="file" class="form-control FilUploader" name="image[]" id="images" style="border: 1px solid #333;" multiple accept="image/*">
                                                    </div>
                                                    <div class="input-row d-flex mt-1 col-lg-6">
                                                        <input type="text" class="form-control image-description" name="image_description[]" style="border: 1px solid #333;" placeholder="Image Description">
                                                        <button type="button" class="add-button" onclick="duplicateRow(this)">+</button>
                                                    </div>
                                                </div>
                                                <div style="color: red !important"> </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Priority:</label>
                                                <div class="row">
                                                    <div class="col-4 form-check">
                                                        <input type="radio" name="priority" id="low" value="1" class="form-check-input bg-white"
                                                            required>
                                                        <label for="low" class="form-check-label">Low</label>
                                                    </div>
                                                    <div class="col-4 form-check">
                                                        <input type="radio" name="priority" id="medium" value="2" class="form-check-input bg-white"
                                                            required>
                                                        <label for="medium" class="form-check-label">Medium</label>
                                                    </div>
                                                    <div class="col-4 form-check">
                                                        <input type="radio" name="priority" id="high" value="3" class="form-check-input bg-white"
                                                            required>
                                                        <label for="high" class="form-check-label">High</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn submit-button bg-success text-white btn-sm mt-6 mb-0"
                                        type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Use event delegation on a parent element (assuming a parent with ID "form" for example)
    $("#form").on("change", "#images", function () {
        var files = this.files;

        for (var i = 0; i < files.length; i++) {
            var fileSize = files[i].size;

            if (fileSize > 2097150) {
                $(this).val('');
                alert('File Size Should be Less Than 2MB');
            } else {
                var fileExtension = ['pdf', 'jpg', 'jpeg', 'png'];
                var currentExtension = files[i].name.split('.').pop().toLowerCase();

                if ($.inArray(currentExtension, fileExtension) == -1) {
                    alert("Only " + fileExtension.join(', ') + " Files are allowed " );
                    $(this).val('');
                    return; // Stop further processing if any file is invalid
                }
            }
        }
    });

    // Example for duplicating the input field on button click
    $("#duplicateButton").click(function () {
        var clonedInput = $("#images").clone();
        clonedInput.val(''); // Clear the value of the cloned input
        $("#form").append(clonedInput);
    });
</script>


<script>
    function duplicateRow(button) {
        var inputGroup = button.closest('.input-group'); // Get the parent .form-group element
        var clone = inputGroup.cloneNode(true); // Clone the entire input group
        inputGroup.parentNode.appendChild(clone); // Append the cloned input group to the parent
    }
    ClassicEditor
                                .create( document.querySelector( '#description' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
</script>
<?php include "footer.php" ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css" />
<script src="assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
</body>

</html>