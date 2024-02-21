<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Custom CSS for table styling */
        .table {
            background-color: #FFC0CB;
            /* Full pink shade */
        }

        .table thead {
            background-color: #FFFFFF;
            /* White background for table headers */
            color: #FFC0CB;
            /* Pink text for table headers */
        }

        .table tbody tr {
            background-color: #FFFFFF;
            /* White background for table rows */
            color: black;
            /* Pink text for table rows */
        }

        .btn-pink {
            background-color: black;
            /* Full pink color for buttons */
            color: #FFFFFF;
            /* White text for buttons */
        }
    </style>
    <title>Pink and White Table</title>
</head>

<body>
<div class="container-fluid py-6">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="containers">
                            <div class="item">
                                <div>
                                    <h6 class="text-white text-capitalize ps-3">New Tickets</h6>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="item"></div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <form method="get" autocomplete="off" action="list_ticket">
                            <div class="row">
                                <div class="col-1 col-sm-1"></div>
                                <div class="col-3 col-sm-3"></div>
                                <div class="col-3 col-sm-3"></div>
                                <!-- <div class="col-3 col-sm-3">
                                    <div class="input-group input-group-dynamic">
                                        <input name="search" value="" placeholder="Search" class="multisteps-form__input form-control" type="text"/>
                                    </div>
                                </div> -->
                                <!-- <div class="col-2 col-sm-2">
                                    <button class="btn bg-gradient-primary btn-sm ms-auto mb-0" title="filter" type="submit" style="width: 70px; height: 40px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div> -->
                            </div>
                        </form>
                        <div class="container mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Slno</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Priority</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>                    
                                        <?php 
                                        $sl=1;
                                        foreach ($tickets as $ticket) { ?>
                                            <td><?= $sl++?></td>
                                            <td>
                                                <?= $ticket['customer_name'] ?>
                                            </td>
                                            <td>
                                                <?php $date = new datetime($ticket['date_time']);
                                                echo $date->format('d-M-Y') ?>
                                            </td>
                                            <td>
                                            <span style="text-wrap:balance;"><?= $ticket['title'] ?></span>
                                            </td>

                                            <td>
                                                <?php
                                                $priority = (isset($ticket['priority']) && $ticket['priority'] == 1) ? 'Low' : ((isset($ticket['priority']) && $ticket['priority'] == 2) ? 'Medium' : 'High');
                                                echo $priority;
                                                ?>

                                            </td>
                                            <td class="d-flex">
                                                <button type="button" class="btn btn-primary view-button" data-toggle="modal"
                                                    data-target="#myModal" data-title="<?= $ticket['title'] ?>" data-id="<?= $ticket['id'] ?>"
                                                    data-description="<?= $ticket['description'] ?>" data-priority="<?= $priority ?>"
                                                    data-images="<? //= $ticket['file_path'] ?>">
                                                    <i class="fa fa-eye"></i> Quick View

                                                </button>
                                                <form method="post">
                                                    <input type="hidden" value="<?= $ticket['id'] ?>" name="id">
                                                    <button class=" btn btn-pink ml-2" type="submit">Take Up</button>
                                                </form>
                                            </td>
                                    </tr>
                                        <?php } ?>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal" style="z-index: 1050;">
        <div class="modal-dialog" style="max-width: 50vw;">
            <div class="modal-content">
                <!-- Modal Header with close icon -->
                <div class="modal-header">
                    <!-- <h5 class="modal-title">View Content</h5> -->
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body (Your content) -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <!-- <h5 style="float: left;">Title:</h5> -->
                            <h5 id="modal-title"></h5>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label style="float: left; color: #b26937;">Description:</label>
                            <p id="modal-description"></p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label style="float: left; color: #b26937;">Priority:</label>
                                <?php
                                $priority = (isset($ticket['priority']) && $ticket['priority'] == 1) ? 'Low' : ((isset($ticket['priority']) && $ticket['priority'] == 2) ? 'Medium' : 'High');
                                echo $priority;
                                ?>
                            <p id="modal-priority"></p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label style="float: left; color: #b26937;">Images:</label>
                                
                            <p id="modal-images"></p>
                        </div>
                    </div>
                    

                

                    

                </div>
            </div>
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
    $(".view-button").click(function () {
        var ticketId = $(this).data("id");
        var postData = {
            id: ticketId,
        };
        
        var that = this; // Store reference to 'this' for later use inside the ajax success callback

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>new-ticket",
                    data: postData,
                    success: function (response) {
                        var ticketData = response.data.tickets;

                        // Find the ticket with matching id
                        var selectedTicket = ticketData.find(function(ticket) {
                            return ticket.id == ticketId;
                        });

                        $("#modal-title").text(selectedTicket.title);
                        $("#modal-description").html(selectedTicket.description);
                        if(selectedTicket.priority == 1){
                            priority = 'Low';
                        }else if(selectedTicket.priority == 2){
                            priority = 'Medium';
                        }else{
                            priority = 'High'; 
                        }
                        $("#modal-priority").html(priority);

                        var imagesContainer = $("#modal-images");
                        imagesContainer.empty();

                        $.each(response.data.ticket_images, function (index, image) {
                            var imageElement = $("<img>");
                            imageElement.attr("src", image.image);
                            imageElement.attr("style", "width: 150px; height: 150px;");
                            imagesContainer.append(imageElement);
                        });

                        // Show the modal
                        $("#myModal").modal("show");
                    },
                    error: function () {
                        // Handle errors
                    },
                });
            });
        });

    </script>


</body>

</html>