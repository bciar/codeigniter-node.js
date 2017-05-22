<div class="content-admin-part">
    <div class="container">
        <div class="row">

                <h3 class="pysc-title">Message</h3>
            <div class="mess-content clearfix">
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
                            <!--<p>
                            <span>Date: </span> <? /*=$message->time*/ ?>
                        </p>-->
                        </div>
                        <!-- End Form Subject Section -->
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="chat-message-section">
                        <?php if (!empty($messages)): ?>
                            <?php foreach ($messages as $message): ?>
                                <!-- Chat Message Section -->
                                <ul>
                                    <?php if ($message->from_user_id === $clients[0]->user_id && $message->to_user_id === $expert[0]->expert_id && $message->subject === $subject): ?>
                                        <li class="left-message">
                                            <div class="message-text-section">
                                                <p style="    padding: 15px 0 0 0;
    text-align: justify;">
                                                    <?= $message->message ?>
                                                </p>
                                                <span class="message-time"><?= $message->time ?></span>
                                            </div>
                                            <div class="message-img-section">
                                                <img
                                                    src="<?= base_url('assets/site/site-images/thumbimages/' . $clients[0]->image) ?>">
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($message->from_user_id === $expert[0]->expert_id && $message->to_user_id === $clients[0]->user_id && $message->subject === $subject): ?>
                                        <li class="right-message">
                                            <div class="message-img-section">
                                                <img
                                                    src="<?= base_url('assets/site/site-images/thumbimages/' . $expert[0]->image) ?>">
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
                    <div class="chat-send-section clearfix">

                        <div class="col-md-4 invoice_container">
                            <div class="bg-warning">
                                <h2>Pay the invoice</h2>
                                <p>Your current balance is <b>$<?= number_format(@$this->session->userdata('balance'), 1) ?></b></p>
                            </div>

                            <div class="bg-info">
                                <p>Pending Invoice : <?= implode(' + ', $invoice_prices) ?></p>
                                <p>Total : <b>$<?= $invoice_total ?></b></p>

                                <?php if ($invoice_total && $invoice_total <= $this->session->userdata('balance')): ?>
                                <div style="margin-top: 10px">
                                    <p><button class="btn" data-toggle="modal" data-target="#dlg_payinvoice" data-expert="<?= $expert[0]->expert_id ?>" data-expert_name="<?= $expert[0]->name ?>" data-amount="<?= $invoice_total ?>">Pay Invoice</button></p>
                                </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($invoice_total > $this->session->userdata('balance')): ?>
                                <div class="bg-danger">
                                    <p>You don't have enough funds to pay for this invoice.</p>

                                    <p><button class="btn" data-toggle="modal" data-target="#addFundsModal">Add funds</button></p>

                                    <p><button class="btn">Add funds</button></p>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-8 ">
                            <?php  if (!$block): ?>

                            <?php if (!empty($free)): ?>
                                <h3 style="margin-bottom: 10px">per paying email is now off you can send every each message free... </h3    >
                            <?php else: ?>
                                <h2 style="margin-bottom: 10px">per paying email is now on for each message you have to pay... <span style="color:#84bf3e">$<?=$expert[0]->mail_price?> !!!</span> </h2>
                            <?php endif; ?>
                            <form id="send_mail_form" class="clearfix" action="<?= base_url('message/expert/'.$expert[0]->expert_id ) ?>" method="post" >
                                <input type="hidden" id="expert_name" value="<?= $expert[0]->name ?>" />
                                <input type="hidden" id="expert_id" value="<?= $expert[0]->expert_id ?>" />
                                <input type="hidden" id="my_image" value="<?= base_url('assets/site/site-images/thumbimages/'.$clients[0]->image) ?>" />
                                <input type="hidden" id="other_image" value="<?= base_url('assets/site/site-images/thumbimages/'.$expert[0]->image) ?>" />

                                <div class="send-section-right">
                                    <div class="row">
                                    <div class="col-md-9">
                                        <input type="hidden" name="subject" value="<?= $subject ?>">
                                <textarea rows="6" name="message" id="message" placeholder="Type Message ..."
                                          class="form-control"></textarea>
                                    </div>
                                    <div class="chat-send-section-full-width clearfix">
                                        <div class="col-md-12 no-padding">
                                            <p>Decline if an advisor offers you to pay outside the PsychicsVoice website.The
                                                offer may be fraudulent
                                                in result the swift account Suspension.
                                            </p>


                                                <button type="submit" class="btn" id="send"><i class="fa fa-paper-plane"
                                                                                               aria-hidden="true"></i> Send
                                                </button>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                            <?php else: ?>
                                <div style="color: #ff0000"><h2>You are blocked!. You cant send message to this
                                        Reader...</h2></div>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

