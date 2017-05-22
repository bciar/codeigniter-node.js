<div class="content-admin-part">
    <div class="container">
        <div class="row">
                <h3 class="pysc-title">Message</h3>
            <div class="mess-content clearfix">
                <?php  if ($block): ?>
                    <div style="color: #ff0000"><h4> Blocked Client...</h4></div>

                    <hr />
                <?php endif; ?>

            <?php if (!empty($expert)): ?>
                <div class="col-md-12 no-padding">
                    <div class="col-md-7">
                        <!-- Form Subject Section -->
                        <div class="form-subject-section clearfix">
                            <p>
                                <span>From: </span> <?= $expert[0]->name ?>
                            </p>
                            <p>
                                <span>Subject: </span> <?= $subject ?>
                            </p>
                        </div>
                        <!-- End Form Subject Section -->
                    </div>
                    <div class="col-md-5">
                        <!-- Chat Block -->
                        <div class="chat-block">
                            <form action="<?= base_url('block-client') ?>" method="post" id="blockExpert">
                                <input type="hidden" value="<?= $clients[0]->user_id ?>" name="client_id">
                                <?php if ($block): ?>
                                <input type="hidden" value="1" name="unblock">
                                <button type="submit" class="btn btn-default">
                                    <i style="color: green" class="fa fa-play" aria-hidden="true"></i><span style="color: green">Unblock<span>
                                </button>
                                <?php else: ?>
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-stop" aria-hidden="true"></i>
                                    Block
                                </button>
                                <?php endif; ?>
                            </form>
                        </div>
                        <!-- End Chat Block -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="chat-message-section">
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $message): ?>
                            <!-- Chat Message Section -->

                                <ul>
                                    <?php if ($message->from_user_id === $expert[0]->expert_id && $message->to_user_id === $clients[0]->user_id && $message->subject === $subject): ?>
                                        <li class="left-message">
                                            <div class="message-text-section">
                                                <p>
                                                    <?= $message->message ?>
                                                </p>
                                                <span class="message-time"><?= $message->time ?></span>
                                            </div>
                                            <div class="message-img-section">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/'.$expert[0]->image)?>">
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($message->from_user_id === $clients[0]->user_id && $message->to_user_id === $expert[0]->expert_id && $message->subject === $subject): ?>
                                        <li class="right-message">
                                            <div class="message-img-section">
                                                <img
                                                    src="<?=base_url('assets/site/site-images/thumbimages/'.$clients[0]->image)?>">
                                            </div>
                                            <div class="message-text-section">
                                                <p>
                                                    <?= $message->message ?>
                                                </p>
                                                <span class="message-time"> <?= $message->time ?></span>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                            <!-- End Chat Message Section -->
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <div class="chat-send-section">

                        <div class="col-md-3">
                            <div class="send-section-left">
                                <p>Your charge for this service:</p>
                                <h6>Payment Amount:</h6>
                                <form action="<?= base_url('send-invoice') ?>" redirect="<?= base_url('payments') ?>" method="post" id="frm_invoice">
                                    <div class="send-section-left-input">
                                        <input name="amount"><span>US$</span>
                                    </div>
                                    <input type="hidden" name="subject" value="<?= $subject ?>" />
                                    <input type="hidden" name="client_id" value="<?= $clients[0]->user_id ?>" />
                                    <button type="submit" class="btn">Send</button>
                                </form>
                            </div>
                            <span style="position: absolute;
    font-weight: 900;
    font-size: 11px;
    left: 94px;
    bottom: 18px;">Per paying email:</span>
                            <form style="position: absolute;
    bottom: 7px;
    right: 35px;" action="<?= base_url('freeMessage') ?>" method="post" id="free_message">
                                <input type="hidden" value="<?= $clients[0]->user_id ?>" name="free">
                                <button type="submit" class="btn btn-default">
                                    <?php if (!empty($free)): ?>
                                        <i style="color: red" class="fa fa-pause" aria-hidden="true"></i>
                                        <span style="color: red">Off</span>
                                    <?php else: ?>
                                        <i style="color: green" class="fa fa-play" aria-hidden="true"></i>
                                        <span style="color: green">On<span>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>
                        <div style="color: #ff0000" class="error_mgs_chat"></div>

                        <form class="clearfix" action="<?= base_url('expert/messages/answer/' . $clients[0]->user_id) ?>"
                              method="post" id="answer_client">
                            <input type="hidden" id="client_name" value="<?= $clients[0]->name ?>" />
                            <input type="hidden" id="client_id" value="<?= $clients[0]->user_id ?>" />
                            <input type="hidden" id="other_image" value="<?= base_url('assets/site/site-images/thumbimages/'.$clients[0]->image) ?>" />
                            <input type="hidden" id="my_image" value="<?= base_url('assets/site/site-images/thumbimages/'.$expert[0]->image) ?>" />

                            <div class="send-section-right">
                                <div class="col-md-9">
                                        <input type="hidden" name="subject" value="<?= $subject ?>">
                                    <textarea rows="6" name="message" id="message" placeholder="Type Message ..."
                                           class="form-control"></textarea>
                                </div>
                                <div class="chat-send-section-full-width clearfix">
                                    <div class="col-md-12 no-padding">
                                        <p>Decline if an advisor offers you to pay outside the Psychics Voice website.The
                                            offer may be fraudulent in result the swift account Suspension.
                                        </p>

                                        <?php if (empty($block)): ?>
                                            <button type="submit" class="btn" id="send"><i class="fa fa-paper-plane"
                                                                                           aria-hidden="true"></i> Send
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

