<div class="content-admin-part">
    <div class="container payment_container">
        <div class="row">
            <div class="col-md-12">
                <h3>Payments</h3>
                <div class="tab-content-part clearfix">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class='payments-left-side'>
                                <h4>Your balance : <b>$<?= number_format(@$this->session->userdata('balance'), 2) ?></b></h4>
                                <button id="addFundsBtn">Add Funds</button>
                            </div>
                        </div>
<!--                        <div class="col-md-6">-->
<!--                            <div class='payments-right-side'>-->
<!--                                <form action="--><?//= base_url('dashboard/payments/search') ?><!--" method="post"-->
<!--                                      id="check_my_payment">-->
<!--                                    <div class="row">-->
<!--                                    <div class="form-group clearfix">-->
<!--                                        <label for="phoneField" class="col-xs-2">From:</label>-->
<!--                                        <div class="col-xs-10">-->
<!--                                            <input type="date" class="form-control" name="from" id="phoneField"-->
<!--                                                   placeholder="Your Password"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="form-group clearfix">-->
<!--                                        <label for="phoneField" class="col-xs-2">To:</label>-->
<!--                                        <div class="col-xs-10">-->
<!--                                            <input type="date" class="form-control" name="to" id="phoneField"-->
<!--                                                   placeholder="Your Password"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-12  button-part-admin ">-->
<!--                                        <button type="submit" class="btn ">Apply</button>-->
<!--                                    </div>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_transactions" data-toggle="tab">Transactions</a></li>
                            <li><a href="#tab_messages" data-toggle="tab">Message & Invoice</a></li>
                        </ul>
                        <div class="tab-content">
                            <!-- Transactions Tab -->
                            <div class="tab-pane active" id="tab_transactions">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Transactions per Expert</h3>
                                        <br>
                                        <div class="payments-result">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>To</th>
                                                    <th data-orderable="false">Chat</th>
                                                    <th data-orderable="false">Message</th>
                                                    <th data-orderable="false">Invoice</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($expert_payments)): ?>
                                                    <?php foreach ($expert_payments as $expert_id => $payment): ?>
                                                        <tr>
                                                            <td><?= $experts[$expert_id]->screen_name ?></td>
                                                            <td>$<?= $payment['chat'] ?></td>
                                                            <td>$<?= $payment['message'] ?></td>
                                                            <td>$<?= $payment['invoice'] ?></td>
                                                            <td class="amount">$<?= number_format($payment['total'], 2) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Chat History -->
                                    <div class="col-md-6">
                                        <h3>Chat History</h3>
                                        <br>
                                        <div class="payments-result">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Expert</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Duration</th>
                                                    <th>Amount</th>
                                                    <th>View</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($chatHistory)): ?>
                                                    <?php foreach ($chatHistory as $chat): ?>
                                                        <tr>
                                                            <td><?= $experts[$chat->expert_id]->screen_name ?></td>
                                                            <td><?= $chat->start_time ?></td>
                                                            <td><?= $chat->end_time ?></td>
                                                            <td><?= number_format($chat->spent_time, 1) ?> mins</td>
                                                            <td class="amount">$<?= $chat->total_price ?></td>
                                                            <td><button data-url="<?= base_url('load-chatdetails') ?>" data-toggle="modal" data-target="#dlg_chatdetails" data-chat="<?= $chat->id ?>">Details</button></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="10" align="center">There are no chat history to show.</td>
                                                    </tr>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- Message & Invoice Tab -->
                            <div class="tab-pane" id="tab_messages">
                                <div class="row">
                                    <!-- Messages -->
                                    <div class="col-md-6">
                                        <h3>Messages</h3>
                                        <br>
                                        <div class="payments-result">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Expert</th>
                                                    <th>Amount</th>
                                                    <th>Currency</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($invoices)): ?>
                                                    <?php foreach ($messages as $message): ?>
                                                        <tr>
                                                            <td><?= $experts[$message->expert_id]->screen_name ?></td>
                                                            <td  class="amount">$<?= $message->amount ?></td>
                                                            <td><?= $message->currency_code ?></td>
                                                            <td><?= $message->date ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h3>Invoices</h3>
                                        <br>
                                        <div class="payments-result">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>From</th>
                                                    <th>Amount</th>
                                                    <th>Received Time</th>
                                                    <th>Paid Time</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($invoices)): ?>
                                                    <?php foreach ($invoices as $invoice): ?>
                                                        <tr>
                                                            <td><?= $experts[$invoice->expert_id]->screen_name ?></td>
                                                            <td class="amount">$<?= $invoice->amount ?></td>
                                                            <td><?= $invoice->sent_time ?></td>
                                                            <td><?= $invoice->is_paid ? $invoice->paid_time : 'Not Paid' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
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
        </div>
    </div>
</div>