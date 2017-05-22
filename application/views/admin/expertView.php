<?php $this->load->view('admin/admin-layouts/header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="glob-admin-content">
            <h1>Experts Page</h1>
            <div class="text-right">
                <a class="admin-a1" href="<?=base_url('admin/experts/activation')?>">Experts Waiting Activation</a>
            </div>
            <hr />
            <div class="col-md-12">
                <h2 class="text-center exp-title">Active Experts</h2>
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
                                <th>CRUD</th>
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
                                    <td style="text-align: right">
                                        <a class="btn btn-primary btn-xs" href="<?=base_url('admin/experts/show/'.$expert->expert_id )?>">View</a>
                                        <a class="btn btn-info btn-xs" href="<?=base_url('admin/experts/edit/'.$expert->expert_id)?>">Edit</a>
                                        <button class="delete_expert btn-danger btn-xs"><input type="hidden" value="<?=$expert->expert_id?>"><i class="fa fa-remove"></i></button></td>
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
    </div>
<?php $this->load->view('admin/admin-layouts/footer.php'); ?>