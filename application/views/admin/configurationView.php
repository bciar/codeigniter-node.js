<?php $this->load->view('admin/admin-layouts/header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="glob-admin-content">
            <h1>Site Configuration</h1>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6">
                        <form method="post" action="">
<!--                            <div class="form-group">-->
<!--                                <label>Auto Pay</label>-->
<!--                                <label class="radio-inline">-->
<!--                                    <input type="radio" name="auto_pay" value="1" checked> Yes-->
<!--                                </label>-->
<!--                                <label class="radio-inline">-->
<!--                                    <input type="radio" name="auto_pay" value="0"> No-->
<!--                                </label>-->
<!--                                <p class="help-block">Check whether you want to enable payments without admin approval.</p>-->
<!--                            </div>-->

                            <div class="form-group">
                                <label>Paypal Email</label>
                                <input class="form-control" name="pp_email" placeholder="Enter Business Paypal Email Here." value="<?php echo $config->pp_email; ?>">
                                <p class="help-block">This email will be used to receive all on-site payments and transactions.</p>
                            </div>

                            <div class="form-group">
                                <label>Paypal Sandbox</label>
                                <select class="form-control" name="pp_sandbox">
                                    <option value="yes"<?php if ($config->pp_sandbox == 'yes') {echo ' selected';} ?>>Yes</option>
                                    <option value="no"<?php if ($config->pp_sandbox == 'no') {echo ' selected';} ?>>No</option>
                                </select>
                                <p class="help-block">Choose whether you will use paypal as a sandbox mode.</p>
                            </div>

                            <hr />

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>

            </div>
            <?= $this->pagination->create_links();?>
        </div>
    </div>
<?php $this->load->view('admin/admin-layouts/footer.php'); ?>