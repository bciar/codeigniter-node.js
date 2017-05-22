a<div class="container clearfix">
    <div class="col-md-12">
        <h3 class="pysc-title">All <?= $type ?>s</h3>
        <div class="chat-message-section">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <?php if ($type == 'message') { ?>
                        <!-- Chat Message Section -->
                        <ul>
                            <?php if ($item->from_user_id === $clients[0]->user_id && $item->to_user_id === $expert[0]->expert_id): ?>
                                <li class="left-message">
                                    <div class="message-text-section">
                                        <p style="padding: 15px 0 0 0; text-align: justify;">
                                            <?= $item->message ?>
                                        </p>
                                        <span class="message-time"><?= $item->time ?></span>
                                    </div>
                                    <div class="message-img-section">
                                        <img
                                                src="<?= base_url('assets/site/site-images/thumbimages/' . $clients[0]->image) ?>">
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if ($item->from_user_id === $expert[0]->expert_id && $item->to_user_id === $clients[0]->user_id): ?>
                                <li class="right-message">
                                    <div class="message-img-section">
                                        <img
                                                src="<?= base_url('assets/site/site-images/thumbimages/' . $expert[0]->image) ?>">
                                    </div>
                                    <div class="message-text-section">
                                        <p>
                                            <?= $item->message ?>
                                        </p>
                                        <span class="message-time"> <?= $item->time ?></span>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <!-- End Chat Message Section -->
                    <?php } else if ($type == 'chat') { ?>
                        <ul>
                            <?php if ($item['from'] === $clients[0]->user_id && $item['to'] === $expert[0]->expert_id): ?>
                                <li class="left-message">
                                    <div class="message-text-section">
                                        <p style="padding: 15px 0 0 0; text-align: justify;">
                                            <?= $item['message'] ?>
                                        </p>
                                        <span class="message-time"><?= $item['date'] ?></span>
                                    </div>
                                    <div class="message-img-section">
                                        <img src="<?= base_url('assets/site/site-images/thumbimages/' . $clients[0]->image) ?>">
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if ($item['from'] === $expert[0]->expert_id && $item['to'] === $clients[0]->user_id): ?>
                                <li class="right-message">
                                    <div class="message-img-section">
                                        <img
                                                src="<?= base_url('assets/site/site-images/thumbimages/' . $expert[0]->image) ?>">
                                    </div>
                                    <div class="message-text-section">
                                        <p>
                                            <?= $item['message'] ?>
                                        </p>
                                        <span class="message-time"> <?= $item['date'] ?></span>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>

                    <?php } ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>