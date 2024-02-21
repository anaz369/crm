<?php include("header.php"); ?>
<div class="container-fluid py-6">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="containers">
                            <div class="item">
                                <div>
                                    <h6 class="text-white text-capitalize ps-3">Closed Tickets</h6>
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
                        <!-- <h5 class="text-center" style="padding-top:22px; margin-bottom:14px;">Closed Tickets</h5> -->
                            <table class="table  ">
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
                                        <?php $i = 1; foreach ($closed as $ticket) { ?>
                                        <td><?= $i ?></td>
                                        <td>
                                            <?php foreach ($customer as $customers) {
                                                    if ($customers['id'] == $ticket['customer_id']) {   
                                                        echo $customers['username'];
                                                    }
                                                } ?>
                                        </td>
                                        <td>
                                            <?php $date = new datetime($ticket['date_time']);
                                                echo $date->format('d-M-Y') ?>
                                        </td>
                                        <td>
                                            <span style="text-wrap: balance;"><?= $ticket['title']?></span>
                                        </td>

                                        <td>
                                            <?php
                                                $priority = ($ticket['priority'] == 1) ? 'Low' : (($ticket['priority'] == 2) ? 'Medium' : 'High');
                                                echo $priority;
                                                ?>

                                        </td>
                                        <td class="d-flex">
                                        <a href="<?= base_url('ticket-details/' . $ticket['unique_id'] . '/' . $ticket['customer_id']) ?>" title="view">
                                            <span style="cursor: pointer;">
                                                <i class="fa fa-eye" title="view" style="color: red; font-size: 20px;"></i>
                                            </span>
                                        </a>

                                        </td>
                                    </tr>
                                    <?php $i = $i + 1; } ?>
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