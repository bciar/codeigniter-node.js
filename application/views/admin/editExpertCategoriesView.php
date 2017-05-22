<?php $this->load->view('admin/admin-layouts/header.php'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">

        <h1>Edit Categories page</h1>
        <div class="col-md-12">
            <?php $error = $this->session->flashdata('errors') ?>
            <?php if(!empty($error)): ?>
                <div class="alert alert-danger">
                    <strong><h4><?=  $error; ?></h4></strong>
                </div>
            <?php endif; ?>


            <?php $success = $this->session->flashdata('success') ?>
            <?php if(!empty($success)): ?>
                <div class="alert alert-success">
                    <strong><h4><?=  $success; ?></h4></strong>
                </div>
            <?php endif; ?>


            <div class="col-md-6 col-md-offset-3">
            <form action="<?=base_url('Admin/Expert/ExpertController/editExpertCategories')?>" method="post" enctype="multipart/form-data">

                <input type="hidden" value="<?=$result->id?>" name="cat_id">
                <div class="form-group">
                    <label for="usr">Category Name:</label>
                    <input type="text" value="<?=$result->category_name?>"  name="category_name" class="form-control" id="usr">
                </div>

                <div class="form-group">
                    <label for="usra">Category Slug:</label>
                    <input type="text" value="<?=$result->category_slug?>"  name="category_slug" class="form-control" id="usra">
                </div>

                <div class="form-group">
                    <label for="usra">Status:</label>
                    <select id="select_status_expert" name="status" class="form-control">
                        <?php if($result->status == 1): ?>
                            <option value="1" selected>Active</option>
                            <option value="2">Disable</option>

                        <?php elseif ($result->status == 2): ?>

                            <option value="1">Active</option>
                            <option selected value="2">Disable</option>

                        <?php endif; ?>
                    </select>
                </div>

                <img src="<?=base_url('assets/site/categories-images/'.$result->cat_image)?>">
                <div class="form-group">
                    <label for="usra">Select Image:</label>
                    <input type="file" name="img">
                </div>

                <hr />
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
                
            </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
