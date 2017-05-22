<table class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($messages as $message): ?>
    <tr>
        <td><?= $usernames[$message->from_user_id] ?></td>
        <td><?= $usernames[$message->to_user_id] ?></td>
        <td><?= $message->subject ?></td>
        <td class="strectify"><?= $message->message ?></td>
        <td><?= $message->time ?></td>
    </tr>
    <?php endforeach; ?>
</table>