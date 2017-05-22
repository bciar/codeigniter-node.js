<?php $this->load->view('admin/admin-layouts/header.php'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">

        <h1>Create Categories page</h1>
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

            <form action="<?=base_url('Admin/Expert/ExpertController/createExpertCategories')?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="usr">Category Name:</label>
                    <input type="text"  name="category_name" class="form-control" id="usr">
                </div>
                <div class="form-group">
                <label for="usra">Category Slug:</label>
                    <input type="text" name="category_slug" class="form-control" id="usra">
                </div>

                <div class="form-group">
                    <label for="usra">Status:</label>
                    <select id="select_status_expert" name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="2">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="usra">Select Image:</label>
                    <input type="file" name="img">
                </div>
                <hr />
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
