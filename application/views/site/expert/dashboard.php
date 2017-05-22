<div class="content-admin-part user-dashboard-all-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 dashboard-index-part">
                <?php if (!empty($user_info)): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <h3>My Dashboard</h3>
                        </div>
                        <div class="col-md-8 ">
                            <div class="thumb-name">
                                <div class="thumb">
                                     <span>
                                          <img
                                              src="<?= base_url('assets/site/site-images/thumbimages/' . $user_info->image) ?>">
                                     </span>
                                    <?php if ($this->session->userdata('UserScreenName') != ""): ?>
                                        <figure>Welcome: <b><?= $this->session->userdata('UserScreenName') ?></b>
                                        </figure>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 ">
                            <div class="expert_dashboard_price">

                                <form action="">
                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                    <input type="checkbox" name="vehicle" value="Bike"><span
                                        class="enable">Enable Chats</span>
                                </form>
                                <?= form_open('chat-price') ?>
                                <div class="expert_dashboard_enable">
                                    <p>Price per minute</p>
                                    <input type="text" name="chat_price" value="<?= $user_info->chat_price ?>">

                                    <div class="clearfix">
                                        <button class="price_button">Save</button>
                                    </div>
                                </div>

                                <?= form_close(); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class=" expert_dashboard_status">
                                <p class="status">Your account status is</p>
                                <i class="fa fa-circle-thin" aria-hidden="true"></i><i class="fa fa-circle"
                                                                                       aria-hidden="true"></i><label>On
                                    Review</label>
                                <div class="available_select">
                                    <?= form_open('expert-status') ?>
                                    <select name="expert-status" class="selectpicker">
                                        <option <?= $user_info->expert_status == 1 ? 'selected' : '' ?> value="1">My status:
                                            Available for chat
                                        </option>
                                        <option <?= $user_info->expert_status == 2 ? 'selected' : '' ?> value="2">Not
                                            available for chat
                                        </option>
                                        <option <?= $user_info->expert_status == 3 ? 'selected' : '' ?> value="3">Busy for
                                            chat
                                        </option>
                                    </select>
                                    <ul class="status_info">
                                        <li><i class="fa fa-comment comment_first" aria-hidden="true"></i> Available for
                                            chat
                                        </li>
                                        <li><i class="fa fa-comment comment_second" aria-hidden="true"></i> not available for chat
                                        </li>
                                        <li><i class="fa fa-comment comment_third" aria-hidden="true"></i> <span
                                                style="color: red"> Busy </span> for chat
                                        </li>
                                    </ul>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="expert_dashboard_balance">
								<p>My Current Balance </p>
                                <div class="withdraw">
                                    <button class="withdraw_button">Withdraw funds</button>
                                    <h2>$ <?= @$this->session->userdata('balance') ?> </h2>
                                    <h4><span>Payments details</span></h4>
									
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 expert_dashboard_phone">
                            <p><i class="fa fa-phone" aria-hidden="true"></i> Add Your Phone</p>
                            <h6 class="phone_number"><?=@$user_address->phone_number?></h6>
                            <div class="clearfix tel-part hide">
                                <input type="tel" id="phone">
                                <input id="hidden" type="hidden" name="phone-full">
                                <span id="valid-msg" class="hide">✓ Valid</span>
                                <span id="error-msg" class="hide">Invalid number</span>
                            </div>

                            <a href="<?= base_url('dashboard/settings') ?>">
                                <button type="button" class="add_phone_number">Edit</button>
                            </a>
                        </div>

                    </div>
                <?php endif; ?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="all-clients">
                            <h1 class="title-dash">My Clients</h1>
                            <?php if(count($myClients) > 0): ?>
                                <div class="row">
                                    <?php foreach ($myClients as $client): ?>
                                        <div class="col-md-3">
                                            <div class="my-clients">
                                                <h2><?=$client->screen_name?></h2>
                                                <?php

                                                if($client->type == 'message'){
                                                    $url = 'expert/messages/show/'.$client->client_id;
                                                }else{
                                                    $url = 'expert/chat/show/'.$client->client_id;
                                                }

                                                ?>

                                                <div class="client-info">
                                                    <div class="message-img-section">
                                                        <img
                                                            src="<?=base_url('assets/site/site-images/thumbimages/'.$client->image)?>">
                                                    </div>
                                                    <div class="client-last-contact">
                                                        <h4>Last Contact</h4>
                                                        <span><?= date('F j, Y',strtotime($client->date));?></span>
                                                    </div>
                                                </div>
                                                <a class="view-session" href="<?=$url?>"><i class="fa fa-comment comment_first"
                                                                                            aria-hidden="true"></i> View Session</a>
                                                <div class="text-center">


                                                    <form action="<?= base_url('block-client') ?>" method="post" id="blockExpert">
                                                        <input type="hidden" value="<?= $client->client_id ?>" name="client_id">
                                                        <?php if (in_array($client->client_id,$block_clients)): ?>
                                                            <input type="hidden" value="1" name="unblock">
                                                            <button class="block"><i class="fa fa-stop" aria-hidden="true"></i>Unblock
                                                            </button>
                                                        <?php else: ?>

                                                            <button class="block"><i class="fa fa-stop" aria-hidden="true"></i>Block
                                                            </button>
                                                        <?php endif; ?>
                                                    </form>


                                                    <br>
                                                    <?php if($client->type == 'message'): ?>
                                                        <button class="send-mail"><i class="fa fa-envelope" aria-hidden="true"></i>Mail
                                                        </button>
                                                    <?php  else: ?>
                                                        <a href="<?=$url?>"><button class="send-mail">View Chat
                                                            </button></a>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </div>
                            <?php else:?>
                                <h4> don't Have Clients yet </h4>
                            <?php endif;?>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="last-readings">

                            <div class="top-last-readings clearfix">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h1>Last Readings</h1>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="nav nav-tabs history-tab">
                                            <li><a data-toggle="tab" href="#menu2">Messages</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Chats</a></li>
                                            <li class="active"><a data-toggle="tab" href="#home">All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">

                                    <div class="chat-row clearfix">
                                        <div class="col-md-1">
                                            <div class="message-img-section">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/29e55de55aca563b3ab8d2cb73b9c56d.jpg')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="messages-name">
                                                <a href="http://g-projects.net/aleem/history/27"><p>2 hours ago chat with, <span class="name">Gevor</span></p></a>
                                                <p>Last message: <span class="message-text">All I do is for Your benefit. Answers to all your questions</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="message-time">
                                                <p><span class="time">00:03:00 / </span> free </p><i
                                                    class="fa fa-comment"
                                                    aria-hidden="true"></i>
                                                <button class="chat-ended">Chat Ended!</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-row clearfix">
                                        <div class="col-md-1">
                                            <div class="message-img-section">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/29e55de55aca563b3ab8d2cb73b9c56d.jpg')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="messages-name">
                                                <a href="http://g-projects.net/aleem/history/27"><p>2 hours ago chat with, <span class="name">Gevor</span></p></a>
                                                <p>Last message: <span class="message-text">All I do is for Your benefit. Answers to all your questions</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="message-time">
                                                <p><span class="time">00:03:00 / </span> $11.96 </p><i
                                                    class="fa fa-comment"
                                                    aria-hidden="true"></i>
                                                <button class="chat-ended">Chat Ended!</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-row clearfix">
                                        <div class="col-md-1">
                                            <div class="message-img-section">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/29e55de55aca563b3ab8d2cb73b9c56d.jpg')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="messages-name">
                                                <a href="http://g-projects.net/aleem/history/27"><p>2 hours ago chat with, <span class="name">Gevor</span></p></a>
                                                <p>Last message: <span class="message-text">All I do is for Your benefit. Answers to all your questions</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="message-time">
                                                <p><span class="time">00:03:00 / </span> $11.96 </p><i
                                                    class="fa fa-comment"
                                                    aria-hidden="true"></i>
                                                <button class="chat-ended">Chat Ended!</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="load_more_content" class="okAndGood"></div>

                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="message-img-section history-img">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/29e55de55aca563b3ab8d2cb73b9c56d.jpg')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="messages-name">
                                                <p>2 hours ago chat with <span class="name">Tom</span></p>
                                                <p>Last message: <span class="message-text">Well, its Ok I thing all is great</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="message-time">
                                                <p><span class="time">00:03:00 /</span> free </p><i
                                                    class="fa fa-comment"
                                                    aria-hidden="true"></i>
                                                <button class="chat-ended">Chat Ended!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="message-img-section history-img">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/29e55de55aca563b3ab8d2cb73b9c56d.jpg')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="messages-name">
                                                <a href="http://g-projects.net/aleem/history/27"><p>2016-11-07 05:05:51, <span
                                                            class="name">gevor</span></p></a>
                                                <p>Last message: <span class="message-text">All I do is for Your benefit. Answers to all your questions. 30 yrs of exp.. Be one step ahead of Your future, Your futu (...)

                                    </span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="message-time">
                                                <p><span class="time"></span> free </p><i class="fa fa-comment"
                                                                                          aria-hidden="true"></i>
                                                <button class="chat-ended">Message Ended!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 load_more">
                                <a class="view_more">view more <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="recent_feedback">
                            <h3 class="title-border">Recent Feedback</h3>

                            <?php $this->load->view('site/expert/partials/feedback') ?>
                        </div>
                    </div>
                    <div class="col-md-12 load_more">
                        <a href="javascript:;"  class="view_more more_feedback">view more <i class="fa fa-chevron-down" aria-hidden="true" ></i></a>
                    </div>
                </div>

                <!--Last feedback-->

            </div>

        </div>
    </div>
</div>
