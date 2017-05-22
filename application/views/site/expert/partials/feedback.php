<?php if (count($feedback) > 0): ?>
    <?php foreach ($feedback as $value): ?>
        <div class="feedback clearfix">
            <div class="row">

                <div class="col-md-7">
                    <h5><?= $value->screen_name ?></h5>
                    <p class="feedback_message"><?= $value->message ?></p>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <div class="time-star clearfix">
                            <div class="col-md-8">
                                <h4 class="text-right"><?= $value->time ?></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="feedback_stars">
                                    <ul class="all_stars">
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i>
                                        </li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i>
                                        </li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i>
                                        </li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i>
                                        </li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i>
                                        </li>
                                    </ul>
                                    <ul class="rating_stars">
                                        <?php for ($i = 0; $i < $value->star; $i++): ?>
                                            <li><i class="fa fa-star"
                                                   aria-hidden="true"></i>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <h5 class="no-feedback">No Feedback</h5>
<?php endif; ?>