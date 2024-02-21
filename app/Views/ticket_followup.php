<?php include("header.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"><script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script
        src="https://cdn.tiny.cloud/1/qe618yfcvfoymzvle2y7kn4x6jxhg8xo0apyoeo35ar4nf0w/tinymce/5/tinymce.min.js"></script>
    <style>
                

        body{
            font-family: 'Roboto', sans-serif;
            margin-top: 0px;
        }
        .container {
            display: flex;
            margin-top: 15px;
        }

        .left {
    flex: 0.6;
    /* background-color: #ADD8E6; */
    background-color: #dce7eb;
    padding: 20px;
    border-radius: 0px;
    top: 0;
    bottom: 0;
    height: 100vh;
    position: fixed;
    /* margin-top: 88px; */
    padding-top: 7%;
}

        .left h2 {
            margin-top: 0px;
        }

        .right {
            flex: 3;
            background-color: #fff;
            /* padding: 20px; */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-left: 20%;
            /* Start after the left div */
        }

        .left-info {
            margin-bottom: 10px;
        }

        .reply-button {
            display: flex;
            align-items: center;
        }

        .reply-icon {
            margin-right: 5px;
        }

        .name-and-datetime {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
/* 
        .issue {
            margin-bottom: 2rem;
        }

        .attachments {
            margin-top: 2rem;
        } */

        /* Style for the thumbnail image */
        /* .thumbnail-image {
            width: 250px;
            height: 100px;
            cursor: pointer;
            margin-top: 12px;
            margin-right: 4px;
        } */

        /* Style for the image pop-up */
        .image-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 5;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            text-align: center;
            z-index: 999;
        }

        .image-popup img {
            max-width: 70%;
            max-height: 70%;
            margin: 10% auto;
        }

        /* Add this CSS style to make the close button visible */
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #ffffff;
            cursor: pointer;
        }

        .answer {
            max-width: 800px;
            /* Adjust the container width to your preference */
            margin: 0 auto;
            padding-left: 20px;
            margin-top: 20px;
            /* Create space on the left */
        }

        .form-container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
}

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .file-input {
            display: inline-block;
            margin-top: 10px;

        }

        .submit-button {
            background-color: #FF1493;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #FF69B4;
        }

        /* Centered form styles */
        .centered-form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /* Use the full height of the viewport */
        }


        /* Style for the close button */
    </style>

    <head>
        <style>
            /* Your existing CSS styles here */

            /* Centered form styles */


            /* Additional styling for the "Raise an Issue" form */
            .raise-issue-form {
                max-width: 400px;
                background-color: #FFC0CB;
                padding: 20px;
                border-radius: 5px;
            }

            .raise-issue-form .form-group {
                margin-bottom: 15px;
            }

            .raise-issue-form label {
                font-weight: bold;
            }

            .raise-issue-form .form-control {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .raise-issue-form .file-input {
                display: inline-block;
                margin-top: 10px;
            }

            .raise-issue-form .submit-button {
                background-color: #FF1493;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                cursor: pointer;
            }

            .raise-issue-form .submit-button:hover {
                background-color: #FF69B4;
            }

            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                z-index: 999;
                align-items: center;
                justify-content: center;
                margin-left: 20px;
            }

            .modal-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            max-width: 900px;
            text-align: center;
            position: relative;
            margin-left: 350px;
            margin-top: 100px;
        }

            /* Close button */
            .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #000;
            cursor: pointer;
        }
        
            .file-input .input-group {
                display: flex;
                align-items: center;
                border: white;
            }

            .file-input label {
                flex: 1;
                /* To take up remaining width */
            }

            .file-input input[type="file"] {
                flex: 4;
                /* Adjust the value for width as needed */
            }

            .file-input input[type="text"] {
                flex: 3;
                /* Adjust the value for width as needed */
            }

            .add-button {
                width: 30px;
                /* Set the width and height to make it square */
                height: 30px;
                background-color: #337ab7;
                /* Add a background color */
                color: #fff;
                /* Text color */
                border: none;
                cursor: pointer;
                border-radius: 3px;
                margin-left: 2px;
                margin-top: 7px;
            }

            /* Add some hover effect to make it more visually appealing */
            .add-button:hover {
                background-color: #286090;
            }
            section.main-div {
    width: 100%;
    padding: 0px 100px 0px 0px;
}
.left-info.para {
    /* padding-top: 20px; */
    padding: 6px 15px 0px;
}
.para p{
    font-size: 15px;
}
h5#ticketid {
    margin-bottom: 45px;
}
.btn-replay {
    background-color: #9c9cc1;
    border-radius: 0px;
    color: #ffff;
    font-size: 14px;
    font-weight: 400;
    padding-left: 15px;
    margin-left: 15px;
}
h5 {
    text-transform: capitalize;
    padding-left: 15px;
}
h2{
    font-family: 'Roboto', sans-serif;
}
.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
    height: 100px;
}
.name-and-datetime p {
    font-size: 13px;
    margin-bottom: 10px;
}
p{
    font-size: 18px;
}
.close-tckt-btn-sbmt{
    background-color: #ff0000;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin: 50px 10px;
}
.form-container h2{
    font-size: 25px;
}
        </style>

    </head>



<body>
    <section class="main-div">
        <div class="title">
            <h5>
                <?= $ticket_details[0]['title'] ?>
            </h5>
        </div>
    <?php
    $reversedTicketDetails = array_reverse($ticket_details);
    $lastTicketDetail = end($reversedTicketDetails);
    $divRepeated = false;
    $title='';
    foreach ($reversedTicketDetails as $ticket_detail) { ?>
        <div id="myModal<?= $ticket_detail['unique_id'] ?>" class="modal" style="font-family: 'Roboto', sans-serif;">
            <div class="modal-content">
                <!-- Close button -->
                <span class="close-button" onclick="closeModal('myModal<?= $ticket_detail['unique_id'] ?>')">&times;</span>

                <!-- "Raise an Issue" form content -->
                <div class="form-container">
                    <h2>Answer this Ticket</h2>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <input type="hidden" name="unique" id="unique" class="form-control bg-white" required
                                value="<?= $ticket_detail['unique_id'] ?>">
                        </div>


                        <div class="form-group">
                            <!-- <label for="description">Description:</label> -->
                            <textarea name="description" id="description" class="form-control bg-white" rows="4"></textarea>
                        </div>
                        <div class="form-group file-input ">
                            <label for="images">Attach Images:</label>
                            <div class="input-group ">
                                <div class="input-row d-flex mt-1">

                                    <input type="file" name="image[]" class="image-file" multiple accept="image/*">
                                    <input type="text" name="image_description[]" class="form-control image-description"
                                        style="border: 1px solid #ccc;" placeholder="Image Description">
                                    <button type="button" class="add-button" onclick="duplicateRow(this)">+</button>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group d-flex">
                            <label>Priority:</label>
                            <div class="form-check">
                                <input type="radio" name="priority" id="low" value="1" class="form-check-input bg-white"
                                  >
                                <label for="low" class="form-check-label">Low</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="priority" id="medium" value="2" class="form-check-input bg-white"
                                  >
                                <label for="medium" class="form-check-label">Medium</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="priority" id="high" value="3" class="form-check-input bg-white"
                                    required>
                                <label for="high" class="form-check-label">High</label>
                            </div>
                        </div> -->
                        <div class="text-center"><button type="submit" class="submit-button ">Submit</button></div>

                    </form>
                </div>
            </div>
        </div>
        <div class="container" style="font-family: 'Roboto', sans-serif;">
            <?php if (!$divRepeated) { ?>
                <div class="left">
                    <!-- Left Div (25%) -->
                    <button class="btn btn-replay" onclick="openModal('myModal<?= $ticket_detail['unique_id'] ?>')">Add New Reply</button>
                    
                    <div class="left-info para">
                        <p><strong>Ticket ID</strong><br>
                            <?= $ticket_detail['unique_id'] ?>
                        </p>
                    </div>
                    <div class="left-info para">
                        <p><strong>Status</strong><br>
                            <?php $status = $ticket_detail['status'];
                            $statusText = ($status == 1) ? 'Open' : (($status == 2) ? 'Answered' : 'Closed');
                            echo $statusText; ?>
                        </p>
                    </div>
                    <div class="left-info para">
                        <p><strong>Date</strong><br>
                            <?php
                            for ($i = 0; $i < 1; $i++) {
                                $date = $ticket_details[$i]['date_time'];
                                $date = new datetime($date);
                                echo $date->format('d-M-Y');
                            } ?>
                        </p>
                    </div>
                    <div class="left-info para">
                        <p><strong>Priority</strong><br>
                            <?php for ($i = 0; $i < 1; $i++) {
                                $priority = $ticket_details[$i]['priority'];
                                $priority = ($priority == 1) ? 'low' : (($priority == 2) ? 'Medium' : 'High');
                                echo $priority;
                            } ?>
                        </p>
                    </div>
                    <div class="left-info para">
                        <p><strong>Submitted By</strong><br>
                            <?php
                            for ($i = 0; $i < 1; $i++) {
                                foreach ($customer as $customers) {
                                    if ($customers['id'] == $ticket_details[$i]['customer_id']) {
                                        echo $customers['username'];
                                    }
                                }
                            } ?>
                        </p>
                    </div>
                    <div class="left-info">
                    <form method="post" action="close-ticket">
                            <input type="hidden" value="<?= $ticket_detail['unique_id'] ?>" name="u_id">
                            <button type="submit" class="close-tckt-btn-sbmt" name="unique_id" value="<?= $ticket_detail['unique_id'] ?>"
                                 onclick="return confirm('Are you sure you want to close this ticket?');">
                                CLOSE TICKET
                            </button>
                        </form>
                    </div>

                </div>
                <?php $divRepeated = true;
            } ?>
            <style>
                    .title {
                        position: fixed;
                        /* width: 100%; */
                        background-color: #fff;
                        text-align: center;
                        padding: 10px;
                        z-index: 999;
                        margin-top: 0px importent;
                    }
                    .right {
                        flex: 2;
                        /* margin-top: -14px; */
                        /* padding: 60px 40px; */
                        background-color: #fff;
                        border-radius: 5px;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .reply-button {
                        display: flex;
                        align-items: center;
                        font-size: 18px;
                        color: #FF1493;
                        cursor: pointer;
                        margin-bottom: 20px; /* Add spacing below the "Reply" button */
                    }

                    .name-and-datetime p {
                        font-size: 16px;
                        margin-bottom: 10px; /* Add spacing between "Name" and "Date Time" */
                    }

                    .issue h2 {
                        font-size: 24px;
                        margin-top: 10px;
                        color: #333;
                        margin-bottom: 10px; /* Add spacing below the issue title */
                    }

                    .issue p {
                        font-size: 15px;
                        line-height: 1.5;
                        margin-bottom: 20px;
                    }

                    .attachments {
                        margin-top: 20px;
                        
                    }
                    .attachments p{
                        font-size: 15px;
                    }

                    .thumbnail-image {
                        width: 200px;
                        height: 150px;
                        cursor: pointer;
                        margin-right: 10px;
                        border: 2px solid #FF1493;
                    }

                    .image-popup {
                        /* Styles for the image popup (if you want to adjust) */
                    }

                    /* Additional CSS for pop-up styling, if needed */
                    .right.right-ticket {
                    padding: 20px 0px 20px 80px;
                    margin-top: 70px;
                    /* margin-bottom: 15px; */
                }
                .thumbnail-pdf {
                    width: 200px;
                    height: 150px;
                }
                .title {
                    margin-left: 230px;
                }
            </style>
          
            
            <div class="right right-ticket">
                <!-- Right Div (75%) -->
                <div class="button-replay">
                    <!-- <span class="reply-icon">&#x2709;</span> -->
                    <!-- You can replace this with an appropriate icon code or an image -->
                    
                </div>
                <div style="margin-top: 1rem;"></div>
                <div class="name-and-datetime row" style="width: 100%;">
                    <div class="col-lg-6">
                        <p style="font-size: 13px;">
                        <span class="material-icons">person</span>
                            <!-- <strong>Name:</strong> -->
                           <strong> <?php foreach ($customer as $customers) {
                                if ($customers['id'] == $ticket_detail['customer_id']) {
                                    echo $customers['username'];
                                }
                            } ?></strong>
                        </p>
                    </div>
                    
                    <div class="col-lg-6 text-end">
                        <p style="font-size: 13px;">
                            <!-- <strong>Date Time:</strong> -->
                            <?php $date = new datetime($ticket_detail['date_time']);
                            echo $date->format('d-M-Y H:m:s') ?>
                        </p>
                    </div>
                </div>
                <div class="issue">
                    <p>
                        <!-- <strong><?//= $ticket_detail['title'] ?></strong> -->
                    </p>
                    <p>
                        <?= $ticket_detail['description'] ?>
                    </p>
                </div>
                <!-- Inside your loop to create a pop-up for each ticket -->
                <div class="attachments" >
                    <p><strong>Attachments</strong></p>
                   
                        <!-- Add the onmouseover and onmouseout events to the thumbnail image -->
                        <?php //$filePathsStr = $ticket_detail['file_path']; // Assuming $row is the database query result
                        
                            //$filePaths = explode(',', $filePathsStr);
                            foreach ($ticket_images as $files) {
                                if ($files->ticket_id == $ticket_detail['id']) {
                                    $fileExtension = pathinfo($files->image, PATHINFO_EXTENSION);
                                    
                                    if (strtolower($fileExtension) === 'pdf') {
                                        // Display a PDF icon
                                    
                                        echo '<img src="' . base_url('assets/img/icons/pdf_icon.png') . '" alt="PDF Icon" onclick="openPDF(\'' . base_url() . $files->image . '\')" class="thumbnail-pdf">';
                                        echo $files->description ;

                                    } else { ?>
                                    <div class="attach-img-descptn" style="float: left;">
                                        <img src="<?= base_url(), $files->image ?>" class="thumbnail-image"  alt="Attachment"
                                            onmouseover="showPopup('imagePopup<?= $files->id ?>')"
                                            onmouseout="hidePopup('imagePopup<?= $files->id ?>')">

                                        <div class="image-popup" id="imagePopup<?= $files->id ?>">
                                            <img src="<?= base_url(), $files->image ?>" alt="Large Image">
                                            <span class="close-button" onclick="closePopup('imagePopup<?= $files->id ?>')">&times;</span>
                                            
                                        </div>
                                        <div class="descrip">
                                            <?= $files->description ?>
                                        </div>
                                    </div>
                                <?php }
                                }
                            } ?>
                    

                </div>

            </div>
            
        </div>
    <?php } ?>
    </section>
</body>

</html>

<script>
    // JavaScript to handle pop-up opening and closing
    // JavaScript functions to handle pop-up opening and closing
    function showPopup(popupId) {
        document.getElementById(popupId).style.display = "block";
    }

    function hidePopup(popupId) {
        document.getElementById(popupId).style.display = "none";
    }

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = "none";
    }


    // JavaScript functions to toggle the reply form
    function toggleReplyForm(formId) {
        var form = document.getElementById('answerform');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    // JavaScript function to close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
    document.querySelector('form').addEventListener('submit', function (e) {
        console.log('Form submitted');
        // Check for any custom logic or issues related to TinyMCE
    });

    function openPDF(pdfUrl) {
        // Open the PDF in a new window
        window.open(pdfUrl, '_blank');
    }

    function duplicateRow(button) {
        var inputRow = button.parentElement; // Get the parent div
        var clone = inputRow.cloneNode(true); // Clone the input row
        inputRow.parentNode.appendChild(clone); // Append the cloned row to the parent
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
