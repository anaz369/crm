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

    .error {
        font-size: 20px;
        color: red;
        margin-top: 70px;
        font-weight: bold;
    }
    span.repld-by {
    font-size: 12px;
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
                                            <h6 class="text-white text-capitalize ps-3">All Tickets</h6>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="item"></div>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <form method="get" autocomplete="off" action="list_ticket">
                                    <div class="row">
                                        <div class="col-1 col-sm-1"> </div>
                                        <div class="col-3 col-sm-3"></div>
                                        <div class="col-3 col-sm-3"></div>
                                        <div class="col-3 col-sm-3">
                                            <!-- <div class="input-group input-group-dynamic">
                                                <input name="search" value="" placeholder="Search" class="multisteps-form__input form-control" type="text"/>
                                            </div> -->
                                        </div>
                                        <!-- <div class="col-2 col-sm-2">
                                            <button class="btn bg-gradient-primary btn-sm ms-auto mb-0" title="filter" type="submit" style="width: 70px; height: 40px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div> -->
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
                                                        Date</th>

                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Title</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Last Replied By</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Priority</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                        Status</th>
                                                    <th class="  text-uppercase text-secondary  font-weight-bolder "
                                                        style="text-align:center;">
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($tickts as $tickt) { ?>


                                                    <tr id="row42" style="font-size:20px;">
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?= $i ?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php $date = new datetime($tickt['date_time']);
                                                            echo $date->format('d-M-Y') ?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">
                                                            <span style="text-wrap: balance;"><?= $tickt['title'] ?></span>
                                                        </td>


                                                        <td style="text-align:center; font-size:16px;">
                                                            <?php
                                                                $lastMatchedUsername = null;

                                                                foreach ($all_tickets as $last_ticket) {
                                                                    if ($last_ticket['unique_id'] == $tickt['unique_id']) {
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
                                                               <span class="repld-by"> <?php $date = new datetime($tickt['date_time']); echo $date->format('d-M-Y H:m:s') ?></span>
                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?php
                                                            if ($tickt['priority'] == 1) {
                                                                echo '<span class="badge badge-sm bg-gradient-success">Low</span>';
                                                            } elseif ($tickt['priority'] == 2) {
                                                                echo '<span class="badge badge-sm bg-gradient-warning">Medium</span>';
                                                            } elseif ($tickt['priority'] == 3) {
                                                                echo '<span class="badge badge-sm bg-gradient-danger">High</span>';
                                                            } else {
                                                                echo 'Unknown Status';
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">

                                                            <?php
                                                            if ($tickt['status'] == 1) {
                                                                echo '<span class="badge badge-sm bg-gradient-danger">Open</span>';
                                                            } elseif ($tickt['status'] == 2) {
                                                                echo '<span class="badge badge-sm bg-gradient-warning">In-progress</span>';
                                                            } elseif ($tickt['status'] == 3) {
                                                                echo '<span class="badge badge-sm bg-gradient-success">Closed</span>';
                                                            } else {
                                                                echo 'Unknown Status';
                                                            }
                                                            ?>

                                                        </td>
                                                        <td style="text-align:center; font-size:16px;">

                                                    <?php if ($tickt['status'] == 1 || $tickt['status'] == 2): ?>
                                                        <!-- If status is 1 or 2, link to ticket_followup page -->
                                                        <a href="ticket_followup/<?= $tickt['unique_id'] ?>/<?= $tickt['customer_id'] ?>" title="view">
                                                            <span style="cursor: pointer;">
                                                                <i class="fa fa-eye" title="view" style="color: red; font-size:20px;"></i>
                                                            </span>
                                                        </a>
                                                    <?php else: ?>
                                                        <!-- If status is not 1 or 2, link to ticket_detail page -->
                                                        <a href="ticket-details/<?= $tickt['unique_id'] ?>/<?= $tickt['customer_id'] ?>" title="view">
                                                            <span style="cursor: pointer;">
                                                                <i class="fa fa-eye" title="view" style="color: red; font-size:20px;"></i>
                                                            </span>
                                                        </a>
                                                    <?php endif; ?>

                                                    </td>

                                                    </tr>
                                                    <?php $i = $i + 1;

                                                }
                                } ?>

                                        </tbody>
                                    </table>
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



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>