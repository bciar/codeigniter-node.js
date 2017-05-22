<?php $this->load->view('admin/admin-layouts/header.php'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">
        <div class="container" id="payment_container">
            <input type="hidden" id="from" />
            <input type="hidden" id="to" />

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" id="payment_tabs">
                    <li class="active"><a href="#tab_overview" data-toggle="tab">Overview</a></li>
                    <li><a href="#tab_client" data-toggle="tab">Client</a></li>
                    <li><a href="#tab_expert" data-toggle="tab">Expert</a></li>
                    <li><a href="#tab_withdrawal" data-toggle="tab">Withdrawal</a></li>
                </ul>

                <div class="input-group range_container">
                    <button type="button" class="btn btn-default" id="select_range">
                        <span>
                          <i class="fa fa-calendar"></i> Select Date Range
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </button>

                    <span>
                      <button type="button" id="filter_daterange" class="btn btn-info btn-flat">Go!</button>
                    </span>
                </div>

                <div class="clearfix"></div>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_overview">
                        <h1>Overview</h1>

                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3><sup style="font-size: 20px">$</sup><?= number_format($stats['client_spent'], 2) ?></h3>

                                        <p>Client Spent</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#tab_client" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3><sup style="font-size: 20px">$</sup><?= number_format($stats['expert_earning'], 2) ?></h3>

                                        <p>Expert Earning</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#tab_expert" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3><sup style="font-size: 20px">$</sup><?= number_format($stats['expert_withdraw'], 2) ?></h3>

                                        <p>Expert Withdraw</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#tab_withdrawal" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3><sup style="font-size: 20px">$</sup><?= number_format($stats['commission'], 2) ?></h3>

                                        <p>Commission</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#tab_withdrawal" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_client">
                        <h1>Client</h1>

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Bought</th>
                                    <th>Chat</th>
                                    <th>Message</th>
                                    <th>Invoice</th>
                                    <th>Total</th>
                                    <th>Left</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($clients as $client_id => $client): ?>
                                    <tr>
                                        <td><?= $usernames[$client_id] ?></td>
                                        <td><?= $client['total_buy'] ?></td>
                                        <td>$<?= number_format($client['chat'], 2) ?></td>
                                        <td>$<?= number_format($client['message'], 2) ?></td>
                                        <td>$<?= number_format($client['invoice'], 2) ?></td>
                                        <td style="color: green; font-weight: bold">$<?= number_format($client['total'], 2) ?></td>
                                        <td>$<?= number_format($client['balance'], 2) ?></td>
                                        <td><a href="<?= base_url('admin/payment_details/client/' . $client_id) ?>" class="btn btn-primary">Details</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_expert">
                        <h1>Expert</h1>

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Chat</th>
                                    <th>Message</th>
                                    <th>Invoice</th>
                                    <th>Withdrawn</th>
                                    <th>Left</th>
                                    <th>Commission</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($experts as $expert_id => $expert): ?>
                                    <tr>
                                        <td><?= $usernames[$expert_id] ?></td>
                                        <td>$<?= number_format($expert['chat'], 2) ?></td>
                                        <td>$<?= number_format($expert['message'], 2) ?></td>
                                        <td>$<?= number_format($expert['invoice'], 2) ?></td>
                                        <td>$<?= number_format($expert['withdraw'], 2) ?></td>
                                        <td>$<?= number_format($expert['balance'], 2) ?></td>
                                        <td>$<?= number_format($expert['invoice'], 2) ?></td>
                                        <td style="color: green; font-weight: bold">$<?= number_format($expert['total'], 2) ?></td>
                                        <td><a href="<?= base_url('admin/payment_details/expert/' . $expert_id) ?>" class="btn btn-primary">Details</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_withdrawal">
                        <h1>Withdrawals</h1>

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Expert Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($withdrawals as $withdrawal): ?>
                                    <tr>
                                        <td><?= $usernames[$withdrawal->expert_id] ?></td>
                                        <td style="color: green; font-weight: bold">$<?= number_format($withdrawal->amount, 2) ?></td>
                                        <td><?= $withdrawal->date ?></td>
                                        <td><a href="<?= base_url('admin/payment_details/withdrawal/' . $withdrawal->expert_id) ?>" class="btn btn-primary">Details</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
