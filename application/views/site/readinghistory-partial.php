<input type="hidden" id="from" value="<?= $from ?>" />
<input type="hidden" class="no_more" value="<?= $no_more ?>" />
<?php if (!empty($items)): ?>
    <?php
    foreach ($items as $item):
        if ($type == 'message_list') {
            $other_user_id = $item->from_user_id == $my_id ? $item->to_user_id : $item->from_user_id;
        ?>
            <div class="read-row">
                <div class="row">
                    <div class="col-md-1">
                        <div class="message-img-section history-img">
                            <img src="<?= base_url('assets/site/site-images/thumbimages/' . $users[$other_user_id]->image) ?>">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="messages-name">
                            <a href="<?= base_url('reading-history/message/' . $other_user_id . '/' . urlencode(base64_encode($item->subject))) ?>"><p>Subject: <span class="message-text"><?= $item->subject ?></span>&nbsp;&nbsp;<b><?= $item->time ?></b>&nbsp;&nbsp;<span class="name"><?= $users[$other_user_id]->name ?></span></p></a>
                            <p>Last message: <span class="message-text"><?= strlen($item->message) > 55 ? substr($item->message, 0, 55) . '...' : $item->message ?></span></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="message-time">
                            <p><span class="time"></span> $<?= $item->payment_amount + $item->invoice_amount ?> </p><i class="fa fa-comment" aria-hidden="true"></i>
                            <button class="chat-ended">Message Ended!</button>
                        </div>
                    </div>
                    <div id="load_more_content" class="okAndGood">

                    </div>
                </div>
            </div>
        <?php
        } else if ($type == 'chat_list') {
            $other_user_id = $item->client_id == $my_id ? $item->expert_id : $item->client_id;
        ?>
            <div class="read-row">
                <div class="row">
                    <div class="col-md-2">
                        <div class="message-img-section history-img">
                            <img src="<?= base_url('assets/site/site-images/thumbimages/' . $users[$other_user_id]->image) ?>">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="messages-name">
                            <a href="<?= base_url('reading-history/chat/' . $other_user_id) ?>">
                                <p>Chat with <span class="name"><?= $users[$other_user_id]->name ?></span> from <?= $item->start_time ?> to <?= $item->end_time ?></p>
                            </a>
    <!--                        <p>Last message: <span class="message-text"></span></p>-->
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="message-time">
                            <p><span class="time"><?= $item->spent_time ?> mins /</span> $<?= $item->total_price ?> </p><i class="fa fa-comment" aria-hidden="true"></i>
                            <button class="chat-ended">Chat Ended!</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php endforeach; ?>
<?php endif; ?>