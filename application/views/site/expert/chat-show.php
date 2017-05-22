<div class="content-admin-part">
    <div class="container">
        <div class="row">
            <h3 class="pysc-title">Chat Messages</h3>
            <hr />
            <h4>Client Name: <b><?=$clientInfo->screen_name?></b></h4>
            <br />
            <div class="chat-message-section">
                <ul>
                <?php  if (!empty($chat_messages)): ?>
                    <?php foreach ($chat_messages as $message): ?>
                        <!-- Chat Message Section -->


                            <?php if ($message['from'] === $clientInfo->id): ?>
                                <li class="right-message">
                                    <div class="message-text-section">
                                        <p>
                                            <?= $message['message'] ?>
                                        </p>
                                        <span class="message-time"><?= $message['date'] ?></span>
                                    </div>
                                    <div class="message-img-section">
                                        <img
                                            src="<?=base_url('assets/site/site-images/thumbimages/'.$clientInfo->image)?>">
                                    </div>
                                </li>
                            <?php else: ?>
                                <li class="left-message">
                                    <div class="message-img-section">
                                        <img
                                            src="<?=base_url('assets/site/site-images/thumbimages/'.$clientInfo->image)?>">
                                    </div>
                                    <div class="message-text-section">
                                        <p>
                                            <?= $message['message'] ?>
                                        </p>
                                        <span class="message-time"> <?= $message['date'] ?></span>
                                    </div>
                                </li>
                            <?php endif; ?>


                        <!-- End Chat Message Section -->
                    <?php endforeach; ?>
                <?php endif; ?>
                </ul>
            </div>

        </div>
    </div>
</div>    