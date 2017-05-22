<table class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Chat</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($chats as $chat):
        if (!isset($start) || (strtotime($chat['date']) >= strtotime($start) && strtotime($chat['date']) <= strtotime($end))):
    ?>
    <tr>
        <td><?= $usernames[$chat['from']] ?></td>
        <td><?= $usernames[$chat['to']] ?></td>
        <td class="strectify"><?= $chat['message'] ?></td>
        <td><?= $chat['date'] ?></td>
    </tr>
    <?php
        endif;
    endforeach;
    ?>
</table>