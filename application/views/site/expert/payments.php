<div class="content-admin-part">
    <div class="container payment_container">
        <div class="row">
            <div class="col-md-12">
                <h3>Payments</h3>
                <div class="tab-content-part clearfix">
                    <div class="row">
                        <div class="col-md-12">
<!--                            <div class='payment_last_update'>-->
<!--                                <form action="--><?//= base_url('dashboard/expert/payments/search') ?><!--" method="post"-->
<!--                                      id="check_expert_payment">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="phoneField" class="col-xs-1 from-label">From:</label>-->
<!--                                        <div class="col-xs-4">-->
<!--                                            <input type="date" class="form-control" name="from" id="phoneField"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="form-group">-->
<!--                                        <label for="phoneField" class="col-xs-1">To:</label>-->
<!--                                        <div class="col-xs-4">-->
<!--                                            <input type="date" class="form-control" name="to" id="phoneField"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-1  button-part-admin">-->
<!--                                        <button type="button" class="btn">Clear</button>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-1  button-part-admin ">-->
<!--                                        <button type="submit" class="btn">Apply</button>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
                            <div class="transaction">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Total : $<?= $total['mine'] ?></h5>
                                        <h5>Withdraw : $<?= $total['withdraw'] ?></h5>
                                    </div>
                                    <div class="col-md-2">
<!--                                        <h2>Pay/Payout</h2>-->
<!--                                        <ul class="transaction_price">-->
<!--                                            --><?php //if (!empty($total)): ?>
<!--                                                <li>$ --><?//= $total ?><!--</li>-->
<!--                                            --><?php //endif; ?>
<!--                                            --><?php //if (!empty($total_message)): ?>
<!--                                                <li>$ --><?//= $total_message ?><!--</li>-->
<!--                                            --><?php //endif; ?>
<!--                                            --><?php //if (!empty($total_chat)): ?>
<!--                                                <li>$ --><?//= $total_chat ?><!--</li>-->
<!--                                            --><?php //endif; ?>
<!--                                            --><?php //if (!empty($withdraw)): ?>
<!--                                            <li><i class="fa fa-long-arrow-right" aria-hidden="true"></i> $ --><?//= $withdraw; ?><!--</li>-->
<!--                                            --><?php //endif; ?>
<!--                                        </ul>-->
                                    </div>
                                  
                                </div>
                            </div>

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_transactions" data-toggle="tab">Transactions</a></li>
                                    <li><a href="#tab_messages" data-toggle="tab">Message & Invoice</a></li>
                                    <li><a href="#tab_withdrawal" data-toggle="tab">Withdrawal</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Transactions Tab -->
                                    <div class="tab-pane active" id="tab_transactions">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Transactions per Client</h3>
                                                <br>
                                                <div class="payments-result">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>From</th>
                                                            <th data-orderable="false">Chat</th>
                                                            <th data-orderable="false">Message</th>
                                                            <th data-orderable="false">Invoice</th>
                                                            <th>Total</th>
                                                            <th>Commission</th>
                                                            <th>My Earning</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (!empty($client_payments)): ?>
                                                            <?php foreach ($client_payments as $client_id => $payment): ?>
                                                                <tr>
                                                                    <td><?= $clients[$client_id]->screen_name ?></td>
                                                                    <td>$<?= $payment['chat'] ?></td>
                                                                    <td>$<?= $payment['message'] ?></td>
                                                                    <td>$<?= $payment['invoice'] ?></td>
                                                                    <td>$<?= number_format($payment['total'], 2) ?></td>
                                                                    <td>$<?= number_format($payment['commission'], 2) ?></td>
                                                                    <td class="amount">$<?= number_format($payment['total'] - $payment['commission'], 2) ?></td>
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
                                                            <th>Client</th>
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
                                                                    <td><?= $clients[$chat->client_id]->screen_name ?></td>
                                                                    <td><?= $chat->start_time ?></td>
                                                                    <td><?= $chat->end_time ?></td>
                                                                    <td><?= number_format($chat->spent_time, 1) ?> mins</td>
                                                                    <td class="amount">$<?= $chat->total_price ?></td>
                                                                    <td><button data-url="<?= base_url('load-chatdetails') ?>" data-toggle="modal" data-target="#dlg_chatdetails" data-chat="<?= $chat->id ?>">Details</button></td>
                                                                </tr>
                                                            <?php endforeach; ?>
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
                                                            <th>From</th>
                                                            <th>Amount</th>
                                                            <th>Currency</th>
                                                            <th>Date</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (!empty($invoices)): ?>
                                                            <?php foreach ($messages as $message): ?>
                                                                <tr>
                                                                    <td><?= $clients[$message->client_id]->screen_name ?></td>
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
                                                            <th>To</th>
                                                            <th>Amount</th>
                                                            <th>Sent Time</th>
                                                            <th>Paid Time</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (!empty($invoices)): ?>
                                                            <?php foreach ($invoices as $invoice): ?>
                                                                <tr>
                                                                    <td><?= $clients[$invoice->client_id]->screen_name ?></td>
                                                                    <td  class="amount">$<?= $invoice->amount ?></td>
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

                                    <!-- Withdrawals Tab -->
                                    <div class="tab-pane" id="tab_withdrawal">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Withdrawals</h3>
                                                <br>
                                                <div class="payments-result">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Amount</th>
                                                            <th>Processed</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (!empty($withdrawals)): ?>
                                                            <?php foreach ($withdrawals as $withdrawal): ?>
                                                                <tr>
                                                                    <td><?= $withdrawal->date ?></td>
                                                                    <td class="amount">$<?= number_format($withdrawal->amount, 2) ?></td>
                                                                    <td><?= $withdrawal->trx_id == '0' ? 'No' : 'Yes' ?></td>
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
    </div>
</div>
