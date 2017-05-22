<?php $this->load->view('admin/admin-layouts/header.php'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Client Info</h3>
                    <hr/>

                    <h4><?= $client_info->name;
                        $client_info->surname ?></h4>
                    <h4>Payment Email: <?= $client_info->paym_email ?></h4>
                </div>
                <div class="col-md-6">
                    <h3>Expert Info</h3>
                    <hr/>
                    <h4><a target="_blank" style="text-decoration: underline" href="<?=base_url('expert/'.$expert_info->expert_id)?>"><?= $expert_info->name;
                        $expert_info->surname ?></a></h4>
                    <h4> Payment Email: <?= $expert_info->paym_email ?></h4>
                    <h4>Mail Price: <?= $expert_info->mail_price ?> $</h4>
                    <h4>Chat Price: <?= $expert_info->chat_price ?> $</h4>
                </div>

                <div class="col-md-12">
                    <hr/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="payments-result">
                                <h3>Transaction</h3>
                                <br>
                                <table class="table table-bordered" style="background-color: #fff;padding: 15px">
                                    <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="amount">$<?= $payments->amount ?></td>
                                        <td><?= $payments->currency_code ?></td>
                                        <td><?= ($payments->type == 'top_up') ? 'In Process' : 'Send\'ed' ?></td>
                                        <td><?= $payments->date ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button style="margin-right: 15px" class="btn btn-danger">Cancel Request</button>
                            <form style="display: inline;" method="post" action="<?=base_url('admin/payments/send')?>">
                                <input type="hidden" name="expert_id" value="<?=$expert_info->expert_id?>">
                                <input type="hidden" name="payment_id" value="<?=$payments->id?>">
                                <input type="hidden" name="amount" value="<?=$payments->amount?>">
                                <button style="margin-right: 15px" class="btn btn-success">Confirm Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
