<div class="content-expert-part">
    <?php if (!empty($expert)): ?>

        <div class="expert-page-back">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="expert-page clearfix">
                            <div class="col-md-2 col-sm-3 col-xs-3">
                                <div class="expert-image">
                                    <span class="<?= $expert->onClass ?>"><img
                                            src="<?= base_url('assets/site/site-images/thumbimages/' . $expert->image) ?>"></span>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-9 col-xs-9">
                                <div class="expert-all-desc">
                                    <input type="hidden" name="expert_id" id="expert_id"
                                           value="<?= $expert->expert_id; ?>">
                                    <h2><?= $expert->screen_name; ?>

                                        <?php

                                        if ($expert->available == 1) {
                                            echo '<span class="onlineExp"><i title="online" class=" fa fa-circle"></i>Available</span>';
                                        } else if ($expert->available == 2){
                                            echo '<span class="offlineExp"><i title="offline" class=" fa fa-circle"></i>Offline</span>';
                                        }else if ($expert->available == 3){
                                            echo '<span class="busyExp"><i title="busy" class=" fa fa-circle"></i>Busy</span>';
                                        }

                                        ?>

                                    </h2>
                                    <h1><span
                                            class="expert-category">Specializing in: <?= $expert->category_name; ?></span>
                                        <span>$ 1.2/min  <del>$ 2.99</del></span></h1>
                                 
                                        <div class="feedback_stars clearfix">
                                            <div class="stars-content">
                                                <ul class="all_stars">
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                </ul>
                                                <?php
                                                $starsSUM = $expert->starRate->star;
                                                $starsCOUNT = $expert->starRate->count;
                                                ?>
                                                <ul class="rating_stars">

                                                    <?php if ($starsCOUNT != 0): for ($i = 0; $i < round($starsSUM / $starsCOUNT); $i++): ?>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <?php endfor;endif; ?>
                                                </ul>
                                            </div>
                                            <span class="rev-all">Reviews (<?= $reviews ?>)</span>
                                        </div>


                                        <ul class="button-expert ">

                                                <?php  if($this->session->userdata('UserType') == 'client' && $this->session->userdata('isLoggedIn') && in_array($this->session->userdata('UserLoggedId'),$expert->block_users)):  ?>

                                                    <li>
                                                        <span class="  blocked" >You Blocked</span>
                                                    </li>

                                                <?php else: ?>


                                                    <?php if($this->session->userdata('isLoggedIn') == true && $this->session->userdata('UserType') == 'client' && $this->session->userdata('UserStatus') == 1 ): ?>

                                                        <li>
                                                            <!--                                $expert->available == 1 &&-->
                                                            <?php if ( $this->session->userdata('UserType') == 'client'): ?>
                                                                <button class="chat-start" data-chat-to-name="<?= $expert->screen_name ?>"
                                                                        data-chat-to-id="<?= $expert->expert_id ?>"><img
                                                                        src="<?= base_url('assets/site/site-images/images') ?>/chat.png">Chat
                                                                </button>
                                                            <?php else: ?>
                                                                <button><img
                                                                        src="<?= base_url('assets/site/site-images/images') ?>/chat.png">Chat
                                                                </button>
                                                            <?php endif; ?>

                                                        </li>
                                                        <li>
                                                            <button type="button" class="send_msg_btn" data-toggle="modal"
                                                                    data-user-id="<?= $expert->expert_id ?>"
                                                                    data-user-name="<?= $expert->name ?>"
                                                                    data-target="#messageModal"
                                                                    data-mail_price="<?= $expert->mail_price ?>">

                                                                <div class="expert_shortdescription"><?= $expert->short_description ?></div>
                                                                <img src="<?= base_url('assets/site/site-images/images') ?>/mail.png">Message
                                                            </button>
                                                        </li>

                                                    <?php elseif($this->session->userdata('isLoggedIn') == true && $this->session->userdata('UserType') == 'expert' && $this->session->userdata('UserStatus') == 1 ): ?>

                                                        <li>
                                                            <button><img
                                                                    src="<?= base_url('assets/site/site-images/images') ?>/chat.png">Chat
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button><img
                                                                    src="<?= base_url('assets/site/site-images/images') ?>/mail.png">Mail
                                                            </button>
                                                        </li>

                                                    <?php else: ?>

                                                        <li>
                                                            <button data-toggle="modal" data-target="#signModal" ><img
                                                                    src="<?= base_url('assets/site/site-images/images') ?>/chat.png">Chat
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button data-toggle="modal" data-target="#signModal"><img
                                                                    src="<?= base_url('assets/site/site-images/images') ?>/mail.png">Mail
                                                            </button>
                                                        </li>

                                                    <?php endif; ?>

                                                <?php endif; ?>

                                            <?php if ($this->session->userdata('UserType') == 'client'): ?>
                                                <li>
                                                    <?php if (!empty($expert_favorite_client)): ?>
                                                        <button type="button" title="Delete From Favorite List?"
                                                                id="del_favorite" class="add">Also in Favorite List
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" id="add_favorite"><i
                                                                class="fa fa-star"></i>Add to Favorite
                                                        </button>
                                                    <?php endif; ?>
                                                </li>
                                                <?php endif; ?>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    <div class="acardion-expert-page">
                        <div class="acardion-expert-page-content">
                            <h1>Description<span><i class="fa fa-plus"></i></span></h1>
                            <div class="acardion-text">
                                <p>
                                    <?= $expert->bried_description; ?>
                                </p>
                            </div>
                        </div>

                        <div class="acardion-expert-page-content">
                            <h1>Degree <span><i class="fa fa-plus"></i></span></h1>
                            <div class="acardion-text">
                                <p>
                                    <?= $expert->degrees; ?>
                                </p>
                            </div>
                        </div>

                        <div class="acardion-expert-page-content">
                            <h1>Qualifications<span><i class="fa fa-plus"></i></span></h1>
                            <div class="acardion-text">
                                <p>
                                    <?= $expert->expert_qualifications; ?>
                                </p>
                            </div>
                        </div>


                        <div class="acardion-expert-page-content">
                            <h1>Service<span><i class="fa fa-plus"></i></span></h1>
                            <div class="acardion-text">
                                <p>
                                    <?= $expert->services; ?>
                                </p>
                            </div>
                        </div>

                        <div class="expert-reviews">
                            <h1>Reviews</h1>
                            <?php if (count($feedback)): ?>
                                <?php foreach ($feedback as $item): ?>
                                    <div class="reviews-content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="rev-dates-text clearfix">
                                                    <h2><?= $item->screen_name ?></h2>
                                                    <p><?= $item->message ?></p>
                                                    <div class="feedback_stars clearfix">
                                                        <div class="stars-content">
                                                            <ul class="all_stars">
                                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                            </ul>
                                                            <ul class="rating_stars">

                                                                <?php for ($i = 0; $i < $item->star; $i++): ?>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i>
                                                                    </li>
                                                                <?php endfor ?>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                    <h3><?= $item->time ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-md-8">

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="no-rev"><i>No Reviews</i></h2>
                            <?php endif; ?>


                        </div>
                        <div class="experts-specialist">
                            <h1>All Specialties</h1>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><?= $expert->category_name ?></p>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>


