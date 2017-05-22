<div class="content-admin-part user-dashboard-all-content">
    <div class="container">
        <div class="row">
        <form method="post" action="<?=base_url('Site/Expert/ExpertDashboardController/expertSkill')?>">
            <input type="hidden" name="userId" value="<?=$this->session->userdata('UserLoggedId') ?>">
         
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

            <div class="col-md-12 skills-page">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="skills">Category list:</label>
                            <select name="expert_type" class="form-control" id="skills">

                                <?php foreach ($expert_category as $category): ?>

                                <option <?php if($expert_info->expert_type == $category->id){echo 'selected';} ?> value="<?=$category->id?>"><?=$category->category_name?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6 col-md-offset-2">
                         <h6>My SKill/Experience</h6>

                         <span><?=$expert_info->category_name?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 experts-desc-dashboard">
                <div class="form-group">
                    <label for="short">Pay per message Description</label>
                    <textarea class="form-control" rows="5" name="short_description" id="short"><?=$expert_info->short_description?></textarea>
                </div>

                <div class="form-group">
                    <label for="bred">Brief Description</label>
                    <textarea class="form-control" rows="5" name="bried_description" id="bred"><?=$expert_info->bried_description?></textarea>
                </div>

                <div class="form-group">
                    <label for="exp">Services</label>
                    <textarea class="form-control" rows="5" name="services" id="exp"><?=$expert_info->services?></textarea>
                </div>

                <div class="form-group">
                    <label for="deg">Degrees</label>
                    <textarea class="form-control" rows="5" name="degrees" id="deg"><?=$expert_info->degrees?></textarea>
                </div>

                <div class="form-group">
                    <label for="exps">Experience & Qualifications</label>
                    <textarea class="form-control" rows="5" name="expert_qualifications" id="exps"><?=$expert_info->expert_qualifications?></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="">Submit</button>
        </form>
    </div>
</div>