<link id="pagestyle" href="https://www.ethicfin.com/bizactdemo2/asset/assets/css/material-dashboard.css?v=3.0.4"
    rel="stylesheet" />

<!-- <link rel="stylesheet" href="https://www.ethicfin.com/bizactdemo2/asset/build/toastr.min.css"> -->

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
    .payment-info {
    font-size: 16px; /* Adjust the font size as needed */
    margin-bottom: 20px; /* Add spacing between payment entries */
    /* Add any other styles you want */
}
With these changes, you can easily control the styling of your payment details to match your desired look and feel.






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


    . {
        line-height: 2.25;
        font-size: .75rem !important;
    }

    .font-weight-bold {
        font-weight: 600 !important;
    }

    .dark-version .card-footer {
        padding: 0.5rem 1rem;
        background-color: #344767;
        border-top: 0 solid rgba(0, 0, 0, .125);
    }

    .list-group-item {
        padding: 2.5rem 4rem;
    }

    h5.text-sm {
        text-align: center;
        color: red;
    }

    .profile-image {
        display: flex;
        justify-content: flex-end;
        /* Align to the right side */
        margin: -40px 10px auto;
        /* Adjust margin as needed */
    }

    .profile-image img {
        width: 138px;
        /* Adjust the size of the image */
        height: 140px;
        /* padding: 30px 30px 30px 30px; */
        border-radius: 50%;
        /* This will make the image circular */
        object-fit: cover;
        /* Preserve aspect ratio and cover the container */
    }
    .date{
        font-weight: bold;
        font-size: 15px;
    }
</style>

<?php include("header.php") ?>
<div class="container-fluid py-4">
    <div class="container-fluid px-2 px-md-4">
        <div class="card card-body ">
            <div class="row gx-4 mb-2">
                <div class="col-12">
                    <div class="d-flex flex-column border-0 d-flex  mb-2 bg-gray-100 border-radius-lg">
                        <h5 class=" text-sm" id="zname">TICKET RAISING DETAILS </h5>
                        <div class="containers" style="height:400px;">
                            <div class="item">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><span class=" text">Date</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :</span><span class=" text-dark font-weight-bold
                                                    id=" zn1">
                                                    
                                                    <?= $tickets['date_time'] ?></span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Title</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> :</span><span class=" text-dark font-weight-bold 
                                                    id=" zn2">
                                                    <?= $tickets['title'] ?>
                                                </span></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class=" ">Description</span></td>
                                            <td><span class=" text-dark font-weight-bold ms-sm-2"> : </span><span class=" text-dark font-weight-bold 
                                                    id=" zn3">
                                                    <?= $tickets['description'] ?>
                                                </span></span></td>
                                        </tr>
                                        

                                                                        
                                                                            
                                    </tbody>
                                </table>
                            </div>
                            <div class="divider"></div>
                            <div class="item">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td><span class="">File</span></td>
                                        <td>
                                            <span class="text-dark font-weight-bold ms-sm-2"> : </span>
                                            <span class="text-dark font-weight-bold" id="zn3">
                                                <?php
                                                $fileUrl = $tickets['file_path'];
                                            // echo $fileUrl;
                                                $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                                                
                                                if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                                                    echo '<img src="'.base_url().'assets/img/tickets/' . $fileUrl . '" alt="Uploaded Image" style="max-width: 300px;">';
                                                } else {
                                                    echo 'This is not an image file.';
                                                }
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                                                   
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<br>
</div>

<?php include("footer.php") ?>

</html>