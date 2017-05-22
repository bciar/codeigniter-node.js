<?php $this->load->view('admin/admin-layouts/header.php'); ?>

<input type="hidden" id="page_type" value="<?= $type ?>" />
<!-- page content -->
<div class="right_col" role="main">
    <div class="glob-admin-content">
        <div class="container" id="readinghistory_container">
            <h1><?= ucwords($type) ?><?= $user_id ? ' - ' . $usernames[$user_id] : '' ?></h1>

            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-1">Select</div>
                <div class="col-md-3">
                    <label class="form-label">Expert : </label>
                    <select class="select_user form-control">
                        <option disabled selected>-- Select Expert --</option>
                    <?php foreach ($usertypes['expert'] as $user) { ?>
                        <option value="<?= $user->id ?>"<?= ($user->id == $user_id) ? ' selected' : '' ?>><?= $user->screen_name ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-md-1">or</div>
                <div class="col-md-3">
                    <label class="form-label">Client : </label>
                    <select class="select_user form-control">
                        <option disabled selected>-- Select Client --</option>
                        <?php foreach ($usertypes['client'] as $user) { ?>
                            <option value="<?= $user->id ?>"<?= ($user->id == $user_id) ? ' selected' : '' ?>><?= $user->screen_name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <?php if ($type == 'chat') { ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Client</th>
                        <th>Expert</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($chats as $chat_history): ?>
                        <tr>
                            <td><?= $usernames[$chat_history['client_id']] ?></td>
                            <td><?= $usernames[$chat_history['expert_id']] ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#dlg_viewchathistory" data-client="<?= $chat_history['client_id'] ?>" data-expert="<?= $chat_history['expert_id'] ?>">View</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php } else if ($type == 'message') { ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?= $usernames[$message->from_user_id] ?></td>
                                <td><?= $usernames[$message->to_user_id] ?></td>
                                <td><?= $message->subject ?></td>
                                <td><?= strlen($message->message) > 100 ? substr($message->message, 0, 100) . '...' : $message->message ?></td>
                                <td><?= $message->time ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#dlg_viewmessagehistory" data-from="<?= $message->from_user_id ?>" data-to="<?= $message->to_user_id ?>" data-subject="<?= $message->subject ?>">View</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Admin: Chat View -->
<div class="modal fade" id="dlg_viewchathistory" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Chat History</h3>
            </div>
            <div class="modal-body">
                <!-- Date range -->
                <div class="form-group">
                    <label>Date range:</label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="chat-daterange" data-client="" data-expert="">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div id="chathistory_container"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Admin: Message View -->
<div class="modal fade" id="dlg_viewmessagehistory" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Message History</h3>
            </div>
            <div class="modal-body">
                <div id="messagehistory_container"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('admin/admin-layouts/footer.php'); ?>
