<div class="content-admin-part">
    <div class="container">
        <h3 class="pysc-title">All messages</h3>

        <!-- tabs left -->
        <div class="tabbable tabs-left message-part clearfix">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#a" data-toggle="tab">Inbox</a></li>
                        <li><a href="#b" data-toggle="tab">New</a></li>
                    </ul>
                </div>
                <div class="col-md-9 messages-part">
                    <div class="tab-content clearfix">

                        <div class="tab-pane active" id="a">
                            <div class="box-body no-padding" id="messages_container" data-url="<?= base_url() ?>"></div>
                        </div>
                        <div class="tab-pane" id="b">
                            <div class="clearfix">
                                <div class="col-md-8 ">
                                    <div class="send-back-message">
                                        <div class="form-group" style="margin-top: 10px">
                                            <form id="send_mail_form" action="<?= base_url('message/reply/') ?>" method="post" data-modal="true">
                                                <input type="hidden" id="expert_name" />
                                                <label>Experts List</label>
                                                <select required class="form-control" name="expert_id" id="expert_id" onChange="updateExpertName(this);">
                                                    <option disabled selected>select</option>
                                                <?php if (!empty($experts)): ?>
                                                    <?php foreach ($experts as $expert): ?>
                                                        <option value="<?=$expert->expert_id?>"><?= $expert->name ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                                </select>
                                                <br/>

                                                <label>Subject</label>
                                                <input required type="text" name="subject" class="form-control">
                                                <br/>

                                                <label>Message</label>
                                                <textarea required class="form-control" name="message" id="message" rows="3"></textarea>
                                                <button style="margin-top:10px" class="btn btn-primary">Send Message
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

