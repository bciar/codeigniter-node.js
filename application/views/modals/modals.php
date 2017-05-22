



<link rel="stylesheet" href="<?=base_url('assets/site/css/rating.min.css')?>">
<!-- ================================================================
                            Modal Start
================================================================== -->

<!-- Modal Expert -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="sign-up-modal">
                <div class="sign-up-part">
                    <h1>SIGN UP TO Psychics Voice</h1>
                    <h5>TO GET 3 FREE MINUTES AND 60% OFF</h5>
                    <?php $attributes_form_expert = array('id' => 'register_expert') ?>
                    <?=form_open('register/expert',$attributes_form_expert)?>
                    <div id="message_expert"></div>
                    <div class="sign-up-content">
                        <div class="form-group">
                            <br />
                            <label for="password">Email</label>
                            <input type="email" placeholder="Type your email" name="expert_email" class="" id="email">
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="password">Password</label>
                            <input type="password" placeholder="Type your password" name="expert_password" class="" id="password">
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="scr">Screen Name <span>(Optional)</span></label>
                            <input type="text" placeholder="Type your screen name" name="expert_screen_name"  class="" id="scr">
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="h-sign"> <span>(Optional)</span></label>
                            <select class="form-control" id="h-sign" name="expert_type">
                                <option>Expert Type</option>
                                <?php if(count($categories)): ?>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?=$category->category_name?>"><?=$category->category_name?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="desc">Bried Description <span>(Max 175 characters. No HTML! No All Caps!)</span></label>
                            <textarea class="form-control" name="expert_bried_desctiption"  rows="4" id="comment"></textarea>
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="services">About My Services</label>
                            <textarea class="form-control" name="expert_services" rows="4" id="services"></textarea>
                        </div>


                        <div class="form-group">
                            <br />
                            <label for="degrees">Degrees</label>
                            <textarea class="form-control" rows="4" name="expert_degrees" id="degrees"></textarea>
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="exper">Experience & Qualifications</label>
                            <textarea class="form-control" name="expert_qualifications" rows="4" id="exper"></textarea>
                        </div>



                        <div class="sign-up-bottom">
                            <h2>Fees</h2>
                            <p>How much will you charge for a minut of LIVE session (chat) ?</p>

                            <ul>
                                <li><p>U.S $</p></li>
                                <li>

                                    <input type="text" class="" value="4.99" disabled id="scr">

                                </li>
                                <li><p>per minut (299.4 per hour)</p></li>
                            </ul>

                            <p>How much will you charge for service rendered by email ?</p>
                            <div class="form-group">
                                <br />
                                <input type="number" name="expert_email_price"   rows="4" id="exper">
                            </div>


                            <div class="checkbox">
                                <label><input checked type="checkbox" value="">I want to receive special offers, horoscopes and coupons by email.</label>
                            </div>

                            <div class="checkbox">
                                <label><input checked type="checkbox" value="">I have read and agree to the  Psychics Voice terms and conditions.
                                    Your information will be kept completely confidential *</label>
                            </div>
                            <br>
                            <div class="checkbox sign-up-button" >
                                <label> <button type="submit" class="">Sign Up</button></label>

                            </div>
                        </div>
                    </div>
                    <?=form_close(); ?>
                </div>
                <div class="sign-up-footer">
                    <label>Already have an account?  <button class="sign_in">Sign In</button></label>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal User -->
<div id="myModaluser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="sign-up-modal">

                <div class="sign-up-part">
                    <h1>SIGN UP TO Psychics Voice</h1>
                    <h3>TO GET 3 FREE MINUTES AND 60% OFF</h3>
                    <div id="message_client"> </div>
                    <?php $attributes_form_client = array('id' => 'register_user');?>
                    <?=form_open('register/client',$attributes_form_client); ?>
                    <div class="sign-up-content">
                        <div class="form-group">
                            <br />
                            <label for="password">Email</label>
                            <input type="email" class="form-control"   name="email" value="" required class="user_email" id="email">
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="password">Password</label>
                            <input type="password" class="form-control"  name="password" value="" required class="user_password" id="password">
                        </div>

                        <div class="form-group">
                            <br />
                            <label for="scr">Screen name<span>(Optional)</span></label>
                            <input type="text" class="form-control" name="screen_name"  value="" required class="user_screen_name" id="scr">
                        </div>


                        <div class="sign-up-bottom">

                            <div class="checkbox">
                                <label><input checked type="checkbox"  name="spec_offer" value="">I want to receive special offers, horoscopes and coupons by email.</label>
                            </div>

                            <div class="checkbox">
                                <label><input checked type="checkbox"  name="read_agree" value="">I have read and agree to the  Psychics Voice terms and conditions.
                                    Your information will be kept completely confidential *</label>
                            </div>
                            <br>
                            <div class="checkbox sign-up-button" >
                                <label><input name="auto_login"  type="checkbox" value="auto">Auto login  <button type="submit" class="">Sign Up</button></label>

                            </div>
                        </div>
                        <?= form_close()?>
                    </div>

                </div>

                <div class="sign-up-footer">
                    <span>Already have an account?  <button class="sign_in"  class="">Sign In</button></span>
                </div>



            </div>
        </div>

    </div>
</div>

<!-- Modal Sign In  -->

<div id="signModal" class="modal newModal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="sign-up-modal">
                <div class="new-sign-in-content">
                    <h1>SIGN IN TO Psychics Voice</h1>
                    <h5>TO GET 3 FREE MINUTES AND 60% OFF</h5>
                    <div id="message_login"></div>

                    <?php $attributes_login = array('id' => 'login_user');?>
                    <?=form_open('login',$attributes_login); ?>

                    <div class="sign-up-content-new ">
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input  name="email"  class="form-control" type="email" required  id="email">
                        </div>

                        <div class="form-group password-forg">
                            <label for="password">Password </label>
                            <input type="password" class="form-control" name="password" required id="password">
                            <a href="">Forgot Password</a>

                        </div>

<!--                        <div class="sign-up-bottom">-->
<!--                            <div class="checkbox sign-up-button" >-->
<!--                                <label><input  type="checkbox" value="">Remember <span>password</span></label>-->
<!--                            </div>-->
<!--                        </div>-->

                        <ul class="sign-buttons">
                            <li><button  class=""></button></li></li>
                            <li><button type="submit"  class="">Sign in</button></li>
                        </ul>
                    </div>
                    <?=form_close();?>
                </div>
                <div class="mod-footer-part">
                        <span>Not Registred yet?
                        <button type="submit"  class="">Sign Up</button>
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Stars  -->

<div id="starsModal" class="modal newModal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="up-modal">
                <div class="new-sign-in-content" style="background: #ffffff; margin-top: 0 !important; padding: 0 !important;">
                    <span style="position: absolute;
    font-size: 13px;
    margin-left: 10px;
    margin-top: 19px;
    font-weight: 900;">Chat Ended!</span>
                    <h5 style="color: #941209; font-size: 25px; font-weight: 900; padding: 7px 0;">Please Rate this session</h5>
                    <div style="text-align: center; background-color: #D9EACA; padding: 8px 0;"><p style="color: #FC2412; font-weight: 900">from 1 to 5 stars</p></div>
                    <div> <i id="close_feedback" class="fa fa-times" aria-hidden="true" style="position: absolute;
    top: -15px;
    right: -13px;
    font-size: 24px;
    background-color: #ae2889;
    border-radius: 60px;
    color: #ffffff;
    padding: 5px 6px;"></i></div>
                    <form id="stars" method="post" action="<?=base_url('stars')?>">
                        <div class="sign-up-content-new " style=" margin-top: 0 !important; padding: 0 !important;">
                            <div class="form-group" style="margin-left: 192px; margin-top: 3px">
                                <main class="o-content">
                                    <div class="o-container">
                                        <div class="o-section">
                                            <div id="shop"></div>
                                        </div>
                                        <div class="o-section">
                                            <div id="github-icons"></div>
                                        </div>
                                    </div>
                                </main>
                            </div>

                            <div class="form-group password-forg" style="padding: 0 20px;">
                                <label for="message" style="color: #941209; font-weight: 900">Feedback</label>
                                <textarea rows="3" class="form-control" placeholder="your comments..." name="message"></textarea>
                            </div>
                            <input type="hidden" name="expert_id" id="feedback_expert_id">
                            <ul class="sign-buttons" style="text-align: center; margin-top: 10px; padding-bottom: 10px">
                                <li><button type="submit" style="background: #66B132; color: #ffffff; text-transform: capitalize; border-radius: 10px;" class="" id="feedback">Submit</button></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================================================================
                            Modal End
================================================================== -->
<style>
    .sign-up-content-new .form-group {
        margin-top: 0 !important;
    }
 
</style>


<!-- Modal -->
<div class="modal fade ok-modal-style" id="messageModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="ok-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="ok-body">
                <h2>You are going to pay <span id="mail_price"></span>$</h2>
                <p id="exp_short_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard</p>
            </div>
            <div class="ok-footer">
                <button type="button" class="btn" id="ok">Ok</button>
            </div>
        </div>
    </div>
</div>

<!--first popup end-->


<!--client pay-->
<div class="modal fade answer-modal" id="clientPay" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="answer-modal-content">
            <div class="answer-modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="answer-modal-footer">
                <form id="send_mail_form" action="<?= base_url('message/expert/') ?>" method="post" data-modal="true">
                    <input type="hidden" id="expert_name" />
                    <input type="hidden" id="expert_id" />

                    <div class="">
                        <input type="text" required name="subject" class="title form-control"
                               placeholder="Subject">
                    </div>
                    <div class=""><textarea required name="message" id="message" rows="4" class="send-msg form-control" placeholder="Message"></textarea>
                    </div>
                    <p class="text">Decline if an advisor offers you to pay outside the
                        Psychics Voice website.The offer may be fraudulent In
                        result the swift account suspension.</p>
                    <div class="btn-class">
                        <button type="submit" class="btn" id="send"><i class="fa fa-paper-plane"
                                                                       aria-hidden="true"></i> Send
                        </button>
                    </div>
                    <p class="error_mgs_chat" style="color: red; padding-top: 7px"></p>
                </form>
            </div>
        </div>

    </div>
</div>


<!-- Client: Pay Invoice -->
<div class="modal fade answer-modal" id="dlg_payinvoice" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="answer-modal-content">
            <div class="answer-modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="answer-modal-footer">
                <form id="pay_invoice_form" action="<?= base_url('payInvoice/') ?>" method="post" data-modal="true">
                    <input type="hidden" name="invoice_id" id="invoice_id" />
                    <input type="hidden" name="expert_id" id="expert_id" />
                    <p class="text">Decline if an advisor offers you to pay outside the
                        Psychics Voice website.The offer may be fraudulent In
                        result the swift account suspension.</p>
                    <div class="">
                        <p>Expert : <h3 id="invoice_expert"></h3></p>
                        <p>Amount : <h3 id="invoice_amount"></h3></p>
                    </div>
                    <div class="btn-class">
                        <button type="submit" class="btn" id="pay"><i class="fa fa-paper-plane" aria-hidden="true"></i> Pay Invoice </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<!-- Client: Chat Details -->
<div class="modal fade" id="dlg_chatdetails" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Chat Summary</h3>
            </div>
            <div class="modal-body">
                <div id="chat_details"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- Expert: Withdraw -->
<div class="modal fade" id="dlg_withdraw" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Withdraw</h3>
            </div>
            <div class="modal-body">
                <div class="withdraw_container"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_submitWithdraw"><i class="fa fa-paper-plane" aria-hidden="true"></i> Withdraw</button>
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script src="<?=base_url('assets/site/js/dist/rating.min.js')?>"></script>

<!-- EXTERNAL SCRIPTS FOR CALLMENICK.COM, PLEASE DO NOT INCLUDE -->
<script>
//    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//    ga('create', 'UA-34160351-1', 'auto');
//    ga('send', 'pageview');
</script>