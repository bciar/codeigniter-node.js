<div class="row">
    <div class="col-md-6">Start Time :</div>
    <div class="col-md-6"><?= $chat->start_time ?></div>
</div>

<div class="row">
    <div class="col-md-6">End Time :</div>
    <div class="col-md-6"><?= $chat->end_time ?></div>
</div>

<div class="row">
    <div class="col-md-6">Total Chat Length :</div>
    <div class="col-md-6"><?= number_format($chat->spent_time, 1) ?> minutes at rate $<?= $chat->expert_rate ?> / min</div>
</div>

<div class="row payment_row">
    <?php if ($user_type == 'expert') { ?>
        <div class="col-md-4">Earnings :</div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">Total Revenue :</div>
                <div class="col-md-6">$ <?= $chat->total_price ?></div>
            </div>
            <div class="row">
                <div class="col-md-6">Your Earnings :</div>
                <div class="col-md-6">$ <?= $chat->expert_earning ?></div>
            </div>
        </div>
    <?php } else if ($user_type == 'client') { ?>
        <div class="col-md-6">Payment :</div>
        <div class="col-md-6">$ <?= $chat->total_price ?></div>
    <?php } ?>
</div>
