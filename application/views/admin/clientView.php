<?php $this->load->view('admin/admin-layouts/header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="glob-admin-content">
            <h1>Client Page</h1>
            <div class="text-right">
                <a class="admin-a1" href="<?=base_url('admin/clients/notActive')?>">Not Active Clients</a>
            </div>
            <div class="col-md-12">
                <h2 class="text-center exp-title">Active Clinets</h2>
                <?php if(sizeof($result)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Screen Name</th>
                                <th>Email</th>
                                <th>Created Day</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i=1; ?>
                            <?php foreach($result as $client):  ?>
                                <tr>
                                    <td><?=$i ?></td>
                                    <td><?=$client -> screen_name;?></td>
                                    <td><?=$client -> email;?></td>
                                    <td><?=$client -> created_day;?></td>
                                    <td  style="text-align: right">
                                        <a class="btn btn-primary btn-xs" href="<?=base_url('admin/clients/show/'.$client->id )?>">View</a>
                                        <a class="btn btn-info btn-xs" href="<?=base_url('admin/clients/edit/'.$client->id )?>">Edit</a>
                                        <button class="delete_expert"><input type="hidden" value="<?=$client->id ?>"><i class="fa fa-remove"></i></button></td>
                                </tr>
                                <?php  $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <h2 class="text-center">No Information</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>