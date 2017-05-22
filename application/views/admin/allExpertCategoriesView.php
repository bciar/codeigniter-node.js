<?php $this->load->view('admin/admin-layouts/header.php'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">

        <h1>All Expert Categories page</h1>


            <div class="col-md-12">
                <h2 class="text-center exp-title">Expert Categories List</h2>
                <?php if(sizeof($result)): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Categories Name</th>
                                <th>Categories image</th>
                                <th>Categories Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            <?php foreach($result as $categories):  ?>
                                <tr>
                                    <td><?=$i ?></td>
                                    <td><?=$categories->category_name;?></td>
                                    <td><img width="25px" height="25px" src="<?=base_url('assets/site/categories-images/'.$categories->cat_image)?>"></td>
                                    <td><?= ($categories->status == '1')? 'active': 'disable' ?></td>
                                    <td style="text-align: right"><a href="<?=base_url('admin/categories/edit/'.$categories->id)?>">Edit</a>
                                    <button class="delete_categories"><input type="hidden" value="<?=$categories->id?>"><i class="fa fa-remove"></i></button></td>
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

    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
