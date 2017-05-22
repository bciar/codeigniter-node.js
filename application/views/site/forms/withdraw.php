<form class="form-horizontal" id="frm_withdraw">
    <div class="box-body">
        <div class="form-group">
            <label class="col-sm-4 control-label">Current Balance :</label>

            <div class="col-sm-5">
                <label class="control-label" style="font-weight: bold">$ <?= $balance ?></label>
            </div>
        </div>
        <div class="form-group">
            <label for="withdraw_amount" class="col-sm-4 control-label">Withdraw Amount :</label>

            <div class="col-sm-6">
                <input type="text" class="form-control" id="withdraw_amount" placeholder="Enter amount to withdraw">
            </div>
        </div>
        <div class="form-group">
            <label for="withdraw_email" class="col-sm-4 control-label">Paypal Address :</label>

            <div class="col-sm-6">
                <input type="text" class="form-control" id="withdraw_email" placeholder="Enter paypal email to receive funds">
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</form>