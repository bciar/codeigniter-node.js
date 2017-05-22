<?php $this->load->view('admin/admin-layouts/header.php'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">
        <div class="container" id="payment_container">
            <input type="hidden" id="from" />
            <input type="hidden" id="to" />

            <div class="pull-left">
                <a href="<?= base_url('admin/payments') ?>" class="btn btn-primary">Back</a>
            </div>

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

            <h1><?= $title ?></h1>

            <div class="row" style="padding: 0 20px">
                <table class="table">
                    <thead>
                    <tr>
                    <?php foreach ($headers as $header): ?>
                        <th><?= $header ?></th>
                    <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment): ?>
                        <tr>
                        <?php foreach ($payment as $field): ?>
                            <td><?= $field ?></td>
                        <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
