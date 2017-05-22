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
                <?php endif; ?>
                <div class="tab-content-part clearfix">
                    <div class="row">
                        <div class="col-md-8">
                            <div class='dashboard-left-side'>
                                <div class="col-md-6">
                                    <label><i class="fa fa-phone"></i>Add Your Phone </label>
                                    <?php if (!empty($user_info)): ?>
                                        <label><i class="fa fa-credit-card"></i> $ 0 <span
                                                style="color: #000000; font-size: 12px"> (3 free minutes) </span>
                                        </label>
                                    <?php endif; ?>
                                    <label><i class="fa fa-check"></i>Auto Recharge: Off</label>
                                </div>
                                <div class="col-md-6 dashboard-info">
                                    <?php if (!empty($user_info)): ?>
                                        <?php if ($account >= 0): ?>
                                            <p style="margin-left: 50px;
    padding: 25px 15px;"><span style="color: #000000; font-size: 18px; color: #929194"> $ <?= @$this->session->userdata('balance') ?></span></p>
                                   
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class='dashboard-left-side'>
                                <ul class="dashboard_button">
                                    <li>
                                        <a href="<?= base_url('settings')?>"><button>Edit</button></a>
                                    </li>
                                    <li>
                                        <button id="addFundsBtn">Add Fund</button>
                                    </li>
                                    <li>
                                        <button>On</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
					
					
					<div class="row">
                    <div class="col-md-12">
                        <div class="all-Psychic Readers">
                            <h1 class="title-dash">My Psychic Readers</h1>
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
                                <h4> don't Have Psychic Readers yet </h4>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

					

                    <div class="row">
						
                      
                        <div class="col-md-12">
							
							
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

                        <br/> <br/><br/>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



