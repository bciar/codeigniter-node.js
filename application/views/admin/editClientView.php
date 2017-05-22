<?php $this->load->view('admin/admin-layouts/header.php'); ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="glob-admin-content">
            <h1>Client Edit page</h1>

            <?php if(sizeof($result)): ?>
                <div class="edit-page clearfix">
                    <div class="row">
                        <div class="col-md-3">
                            <img  src="<?=base_url('assets/admin/images/no_img.png')?>">
                        </div>
                        <div class="col-md-7 ">
                            <table>

                                <tr>
                                    <td>Screen Name : </td>
                                    <td> <h4><?= $result[0] -> screen_name;?></h4></td>
                                </tr>
                                <tr>
                                    <td>Email : </td>
                                    <td> <h4><?= $result[0] -> email;?></h4></td>
                                </tr>

                                <tr>
                                    <td>Created Day : </td>
                                    <td> <h4><?= $result[0] -> created_day;?></h4></td>
                                </tr>

                            </table>

                        </div>
                        <div class="col-md-2">
                            <div class="text-right">
                                <h4>Expert Status</h4>
                                <form action="<?=base_url('Admin/AdminController/editUserStatus')?>"method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="expert_id" value="<?= $result[0] ->user_id?>">
                                        <input type="hidden" name="email" value="<?= $result[0] ->email?>">
                                        <input type="hidden" name="type" value="<?= $result[0] ->type?>">
                                        <select id="select_status_expert" name="status" class="form-control">
                                            <?php if($result[0]->status == 1): ?>
                                                <option selected value="1"  >Active</option>
                                                <option value="2">Disable</option>

                                            <?php elseif ($result[0]->status == 2): ?>

                                                <option  value="1">Active</option>
                                                <option  selected value="2">Disable</option>

                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="for-group">
                                        <button type="submit" id="expert_status" class="btn btn-primary">Change Status</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>