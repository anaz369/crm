<?php include("header.php"); ?>
<!DOCTYPE html>
<html>

<head>
<style>
    span.repld-by {
        font-size: 12px;
    }
</style>
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
                                    <h6 class="text-white text-capitalize ps-3">Active Tickets</h6>
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
                        <div class="container mt-5">
                            <!-- <h5 class="text-center" style="margin-top:22px; margin-bottom:10px;">Active Tickets</h5> -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Priority</th>
                                        <th>Last Replied By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;foreach ($active_tickets as $ticket) { ?>
                                        <tr onclick="redirectToTicketPage('<?= $ticket['unique_id'] ?>', '<?= $ticket['customer_id'] ?>')">
                                            <th scope="row"><?= $i ?></th>
                                            <td>
                                                <?php $date = new datetime($ticket['date_time']);
                                                echo $date->format('d-M-Y') ?>
                                            </td>
                                            <td>
                                                <?php foreach ($customers as $customer) {
                                                    if ($customer['id'] == $ticket['customer_id']) {
                                                        echo $customer['username'];
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                            <span style="text-wrap: balance;"><?= $ticket['title'] ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                $priority = ($ticket['priority'] == 1) ? 'Low' : (($ticket['priority'] == 2) ? 'Medium' : 'High');
                                                echo $priority;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $lastMatchedUsername = null;

                                                foreach ($all_tickets as $last_ticket) {
                                                    if ($last_ticket['unique_id'] == $ticket['unique_id']) {
                                                foreach ($users as $user) {
                                                    if ($last_ticket['customer_id'] == $user['id']) {
                                                        $lastMatchedUsername = $user['username'];
                                                        }
                                                    }
                                                    }
                                                    }
                                                if ($lastMatchedUsername !== null) {
                                                    echo $lastMatchedUsername;
                                                    }
                                                    ?>
                                                <br>
                                                <span class="repld-by"> <?php $date = new datetime($ticket['date_time']);
                                                    echo $date->format('d-M-Y H:m:s') ?></span>
                                            </td>
                                        </tr>
                                    <?php $i = $i + 1; } ?>
                                    <!-- Add more rows for additional data -->
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<script>
    function redirectToTicketPage(ticketID, customerID) {
        // Encode the ticketID and then redirect to the new page

        window.location.href = "<?= base_url('ticket_followup/') ?>" + ticketID + "/" + customerID;
    }
</script>