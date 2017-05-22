<?php $this->load->view('admin/admin-layouts/header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="glob-admin-content">



            <h1>Experts Activation page</h1>
            <div class="col-md-12">
            <h2 class="text-center exp-title">Experts Waiting Activation</h2>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        <?php foreach($result as $expert):  ?>

                            <tr>
                                <td><?=$i ?></td>
                                <td><?=$expert -> screen_name;?></td>
                                <td><?=$expert -> email;?></td>
                                <td><?=$expert -> expert_type;?></td>
                                <td><?=$expert -> created_day;?></td>
                                <td><a href="<?=base_url('admin/experts/edit/'.$expert->expert_id)?>">Edit</a> <button class="delete_expert"><input type="hidden" value="<?=$expert->expert_id?>"><i class="fa fa-remove"></i></button></td>
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



