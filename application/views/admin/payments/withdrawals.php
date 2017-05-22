<?php $this->load->view('admin/admin-layouts/header.php'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">
        <div class="container" id="payment_container">
            <input type="hidden" id="from" />
            <input type="hidden" id="to" />

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" id="payment_tabs">
                    <li class="active"><a href="#tab_pending" data-toggle="tab">Pending</a></li>
                    <li><a href="#tab_approved" data-toggle="tab">Approved</a></li>
                    <li><a href="#tab_rejected" data-toggle="tab">Rejected</a></li>
                </ul>

                <div class="clearfix"></div>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_pending">
                        <h1>Pending</h1>

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Expert</th>
                                    <th>Amount</th>
                                    <th>Email</th>
                                    <th>Request Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($withdrawals['pending'] as $withdrawal): ?>
                                    <tr>
                                        <td><?= $usernames[$withdrawal->user_id] ?></td>
                                        <td class="amount">$<?= $withdrawal->amount ?></td>
                                        <td><?= $withdrawal->email ?></td>
                                        <td><?= $withdrawal->request_date ?></td>
                                        <td>
                                            <a class="approve_withdrawal" href="<?= base_url('admin/payments/withdrawal/approve/' . $withdrawal->id) ?>">Approve</a>&nbsp;
                                            <a class="reject_withdrawal" href="<?= base_url('admin/payments/withdrawal/reject/' . $withdrawal->id) ?>">Reject</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_approved">
                        <h1>Approved</h1>

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Expert</th>
                                    <th>Amount</th>
                                    <th>Email</th>
                                    <th>Request Date</th>
                                    <th>Transaction ID</th>
                                    <th>Process Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($withdrawals['approved'] as $withdrawal): ?>
                                    <tr>
                                        <td><?= $usernames[$withdrawal->user_id] ?></td>
                                        <td class="amount">$<?= $withdrawal->amount ?></td>
                                        <td><?= $withdrawal->email ?></td>
                                        <td><?= $withdrawal->request_date ?></td>
                                        <td><?= $withdrawal->trx_id ?></td>
                                        <td><?= $withdrawal->process_date ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_rejected">
                        <h1>Rejected</h1>

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Expert</th>
                                    <th>Amount</th>
                                    <th>Email</th>
                                    <th>Request Date</th>
                                    <th>Reason</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($withdrawals['rejected'] as $withdrawal): ?>
                                    <tr>
                                        <td><?= $usernames[$withdrawal->user_id] ?></td>
                                        <td class="amount">$<?= $withdrawal->amount ?></td>
                                        <td><?= $withdrawal->email ?></td>
                                        <td><?= $withdrawal->request_date ?></td>
                                        <td><?= $withdrawal->comment ?></td>
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
