
<!-- Payments Modal-->
<?php if($this->session->userdata('isLoggedIn') == true && $this->session->userdata('UserType') == 'client' && $this->session->userdata('UserStatus') == 1 ): ?>

    <div class="modal fade" id="addFundsModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Funds</h4>
                </div>
                <div class="modal-body" style="height:200px; text-align:center">
                    <div class="col-md-12">
                        <form action="<?=base_url('paypal')?>" method="post">
                            
                            <!-- Provide a drop-down menu option field. -->
                            <select id="am_sel" name="price" class="form-control">
                                <option value="Select Type">-- Select Amount --</option>
                                <option value="1.00">10$</option>
                                <option value="25.00">25$</option>
                                <option value="50.00">50$</option>
                                <option value="75.00">75$</option>
                                <option value="100.00">100$</option>
                                <option value="500.00">500$</option>
								<option value=" Custom">Custom</option>
                            </select> <br />
							
							
							</div>

                            <button class="btn btn-primary">submit</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

   
<?php endif; ?>