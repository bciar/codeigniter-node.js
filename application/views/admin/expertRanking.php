<?php $this->load->view('admin/admin-layouts/header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <form id="frm_expert_order">
            <div class="glob-admin-content">
                <h1>Expert Ranking</h1>
                <div class="text-right">
                    <button id="save_order" class="admin-a1" href="javascript:void(0);">Save Order</button>
                </div>
                <hr />
                <div class="col-md-12">
                    <?php if(sizeof($result)): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Screen Name</th>
                                    <th>Email</th>
                                    <th>Expert Type</th>
                                    <th>Created Day</th>
                                    <th>Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                <?php foreach($result as $expert):  ?>
                                    <tr>
                                        <td><?=$i ?></td>
                                        <td><?=$expert->screen_name;?></td>
                                        <td><?=$expert->email;?></td>
                                        <td><?=$expert->expert_type;?></td>
                                        <td><?=$expert->created_day;?></td>
                                        <td><input type="number" min="0" style="width: 50px; text-align: right" name="order[<?= $expert->id ?>]" value="<?=$expert->expert_order;?>" /></td>
                                    </tr>

                                <?php  $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <h2  class="text-center clearfix">No Information</h2>
                    <?php endif; ?>
                </div>
              <?= $this->pagination->create_links();?>
            </div>
        </form>
    </div>
<?php $this->load->view('admin/admin-layouts/footer.php'); ?>