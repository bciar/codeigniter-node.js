<div class="content-cols experts-list clearfix">
    <?php if (!empty($experts_list)): ?>
        <?php foreach ($experts_list as $expert): ?>

            <div class="col-md-4 col-sm-6 no-padding">
                <div class="all-borders">
                    <div class="thumb-name">
                        <div class="thumb expert">
                                 <span class="<?= $expert->onClass ?>">
                                    <a href="<?= base_url('expert/' . $expert->expert_id); ?>"> <img
                                            src="<?= base_url('assets/site/site-images/thumbimages/' . $expert->image) ?>"></a>
                                 </span>
                        </div>
                        <div class="person-name">
                            <h2> <?= $expert->screen_name ?>

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
                            <a class="specialize" href="specialize/<?=$expert->category_slug?>"> Specializing in: <?= $expert->category_name ?></a>

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
                                <a class="rev-all" href="<?= base_url('expert/' . $expert->expert_id); ?>">(<?= $starsCOUNT ?> Ratings) </a>
                            </div>

                            <div class="clearfix"></div>
                            <p class="desc-text">
                                <?= mb_substr($expert->bried_description, 0, 100);
                                ?>

                                <a href="<?= base_url('expert/' . $expert->expert_id); ?>">... Read
                                    more></a></p>
                        </div>
                    </div>

                    <ul class="chat-email">
                        <h3 class="chat-price">$ <?= $expert->chat_price ?>
                            <del></del>
                        </h3>


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
                                                data-chat-to-id="<?= $expert->expert_id ?>"
                                                data-chat-price="<?=$expert->chat_price?>"
                                                data-available="<?=$expert->available?>"
                                        ><img
                                                src="<?= base_url('assets/site/site-images/images') ?>/chat.png">Chat
                                        </button>
                                    <?php else: ?>
                                        <button><img
                                                src="<?= base_url('assets/site/site-images/images') ?>/chat.png">Chat
                                        </button>
                                    <?php endif; ?>

                                </li>
                                <li>
                                    <button type="button" class="btn btn-lg send_msg_btn" data-toggle="modal"
                                            data-user-id="<?= $expert->expert_id ?>"
                                            data-user-name="<?= $expert->name ?>"
                                            data-target="#messageModal"
                                            data-mail_price="<?= $expert->mail_price ?>">

                                        <div class="expert_shortdescription"><?= $expert->short_description ?></div>
                                        <img src="<?= base_url('assets/site/site-images/images') ?>/mail.png">Mail
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

                    </ul>
                </div>
            </div>

        <?php endforeach; ?>

    <?php else: ?>
        <h2>No Experts Available</h2>
    <?php endif; ?>
    <!--first popup start-->

 </div>