<div class="mailbox-controls">
    <!-- Check all button -->
    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm btn-delete"><i class="fa fa-trash-o"></i></button>
        <button type="button" class="btn btn-default btn-sm btn-refresh"><i class="fa fa-refresh"></i></button>
    </div>
    <!-- /.btn-group -->
    <div class="pull-right">
        <?= $from ?>-<?= $to ?>/<?= $message_cnt ?>
        <div class="btn-group" data-page="<?= $page ?>">
            <button type="button" class="btn btn-default btn-sm view-previous"<?php if ($from < 2): ?> disabled<?php endif; ?>><i class="fa fa-chevron-left"></i></button>
            <button type="button" class="btn btn-default btn-sm view-next"<?php if ($to == $message_cnt): ?> disabled<?php endif; ?>><i class="fa fa-chevron-right"></i></button>
        </div>
        <!-- /.btn-group -->
    </div>
    <!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
    <form id="mails_form" action="#" method="post">
    <table class="table">
        <tbody>
        <?php
        if (count($messages)):
            foreach ($messages as $message):
                $other_user_id = $message->from_user_id == $my_id ? $message->to_user_id : $message->from_user_id;
            ?>
            <tr<?php if (!$message->read): ?> class="unread"<?php endif; ?>>
                <td width="1%"><input type="checkbox" name="mails[]" value="<?= $message->id ?>" /></td>
<!--                <td class="mailbox-star"><a href="javascript:void(0);"><i class="fa fa-star text-yellow"></i></a></td><!-- fa-star-o -->
                <td class="mailbox-name" width="10%"><a href="<?= base_url($user_type . '/messages/show/' . $other_user_id . '/' . urlencode(base64_encode($message->subject))) ?>"><?= $users[$other_user_id]->name ?></a></td>
                <td class="mailbox-subject" width="20%"><a href="<?= base_url($user_type . '/messages/show/' . $other_user_id . '/' . urlencode(base64_encode($message->subject))) ?>"><?= $message->subject ?></a></td>
                <td class="mailbox-content">
                    <a href="<?= base_url($user_type . '/messages/show/' . $other_user_id . '/' . urlencode(base64_encode($message->subject))) ?>">
                        <?= strlen($message->message) > 100 ? substr($message->message, 0, 100) . '...' : $message->message ?>
                    </a></td>
<!--                <td class="mailbox-attachment"></td>-->
                <td class="mailbox-date" width="15%" align="right"><time class="timeago" datetime="<?= date(DATE_ISO8601, strtotime($message->time)) ?>"><?= date('F jS, Y - H:i:s', strtotime($message->time)) ?></time></td>
            </tr>
        <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="10" align="center">There are no messages to show</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <!-- /.table -->
    </form>
</div>
<!-- /.mail-box-messages -->