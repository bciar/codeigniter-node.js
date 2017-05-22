<?php $this->load->view('admin/admin-layouts/header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <?php if (sizeof($result)): ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Client Report</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <!-- end of image cropping -->
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view"
                                             src="<?= base_url('assets/site/site-images/thumbimages/' . $clients->image) ?>"
                                             alt="Avatar" title="Change the avatar">

                                        <!-- Cropping modal -->
                                        <div class="modal fade" id="avatar-modal" aria-hidden="true"
                                             aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form class="avatar-form" action="crop.php"
                                                          enctype="multipart/form-data" method="post">
                                                        <div class="modal-header">
                                                            <button class="close" data-dismiss="modal" type="button">×
                                                            </button>
                                                            <h4 class="modal-title" id="avatar-modal-label">Change
                                                                Avatar</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="avatar-body">

                                                                <!-- Upload image and data -->
                                                                <div class="avatar-upload">
                                                                    <input class="avatar-src" name="avatar_src"
                                                                           type="hidden">
                                                                    <input class="avatar-data" name="avatar_data"
                                                                           type="hidden">
                                                                    <label for="avatarInput">Local upload</label>
                                                                    <input class="avatar-input" id="avatarInput"
                                                                           name="avatar_file" type="file">
                                                                </div>

                                                                <!-- Crop and preview -->
                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <div class="avatar-wrapper"></div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="avatar-preview preview-lg"></div>
                                                                        <div class="avatar-preview preview-md"></div>
                                                                        <div class="avatar-preview preview-sm"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="row avatar-btns">
                                                                    <div class="col-md-9">
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="-90"
                                                                                    type="button"
                                                                                    title="Rotate -90 degrees">Rotate
                                                                                Left
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="-15"
                                                                                    type="button">-15deg
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="-30"
                                                                                    type="button">-30deg
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="-45"
                                                                                    type="button">-45deg
                                                                            </button>
                                                                        </div>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="90"
                                                                                    type="button"
                                                                                    title="Rotate 90 degrees">
                                                                                Rotate Right
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="15"
                                                                                    type="button">15deg
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="30"
                                                                                    type="button">30deg
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                    data-method="rotate"
                                                                                    data-option="45"
                                                                                    type="button">45deg
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <button
                                                                            class="btn btn-primary btn-block avatar-save"
                                                                            type="submit">Done
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal -->

                                        <!-- Loading state -->
                                        <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                                    </div>
                                    <!-- end of image cropping -->

                                </div>
                                <h4><i class="text-blue">Screen name:</i> <?= $result[0]->screen_name; ?></h4>
                                <h5><i class="text-blue">Name:</i> <?= $result[0]->name; ?></h5>
                                <h5><i class="text-blue">Surname:</i> <?= $result[0]->surname; ?></h5>

                                <ul class="list-unstyled user_data">
                                    <li><i class="text-blue">Country:</i> <?= $clients->country ?></li>
                                    <li><i class="text-blue">State:</i> <?= $clients->state ?></li>
                                    <li><i class="text-blue">Street:</i> <?= $clients->street ?></li>
                                    <li><i class="text-blue">Zip:</i> <?= $clients->zip ?></li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class=""><a href="#tab_content1" id="home-tab"
                                                                            role="tab"
                                                                            data-toggle="tab" aria-expanded="false">Conversation</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab"
                                                                            id="profile-tab"
                                                                            data-toggle="tab" aria-expanded="false">Payments history</a>
                                        </li>
                                        <li role="presentation" class="active"><a href="#tab_content3" role="tab"
                                                                                  id="profile-tab2" data-toggle="tab"
                                                                                  aria-expanded="true">about</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content1"
                                             aria-labelledby="home-tab">

                                            <!-- start recent activity -->
                                            <ul class="messages" style="list-style-type: none;">
                                                <?php if (!empty($messages)): ?>
                                                    <?php foreach ($messages as $message): ?>
                                                        <?php if ($message->from_user_id === $clients->user_id): ?>
                                                            <li>
                                                                <div class="message_date">
                                                                    <p class="month"><?= $message->time ?></p>
                                                                </div>
                                                                <div class="message_wrapper">
                                                                    <h4 class="heading"><?= $result[0]->screen_name ?></h4>
                                                                    <blockquote class="message"><?= $message->message ?>
                                                                    </blockquote>
                                                                </div>

                                                            </li>
                                                        <?php else: ?>
                                                            <li class="right-mgs" style="list-style-type: none;">
                                                                <div class="message_date">
                                                                    <?php foreach ($users as $item): ?>
                                                                        <?php if ($message->from_user_id === $item->id): ?>
                                                                            <h4 class="heading"
                                                                                style="ont-weight: bold; color: grey">
                                                                                <?= $item->screen_name ?>
                                                                            </h4>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    <blockquote class="message" style="    border-left: none !important;
    border-right: 5px solid;"><?= $message->message ?>
                                                                    </blockquote>
                                                                </div>
                                                                <div class="message_wrapper">
                                                                    <p class="month"><?= $message->time ?></p>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                            <!-- end recent activity -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                             aria-labelledby="profile-tab">

                                            <!-- start user projects -->
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Top up</th>
                                                    <th>Pay</th>
                                                    <th>Data</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1;
                                                if (!empty($total)): ?>
                                                    <?php foreach ($total as $item): ?>
                                                        <tr>
                                                            <td><?= $i ?></td>
                                                            <?php if ($item->type === 'top_up'): ?>
                                                                <td><?= $item->amount ?></td>
                                                                <td> ---</td>
                                                            <?php endif; ?>
                                                            <?php if ($item->type === 'pay'): ?>
                                                                <td> ---</td>
                                                                <td><?= $item->amount ?></td>
                                                            <?php endif; ?>
                                                            <td><?= $item->date ?></td>
                                                        </tr>
                                                        <?php $i++ ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <!-- end user projects -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content3"
                                             aria-labelledby="profile-tab">
                                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla
                                                single-origin
                                                coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings
                                                next
                                                level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                                photo booth letterpress, commodo enim craft beer mlkshk </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $this->load->view('admin/admin-layouts/footer.php'); ?>