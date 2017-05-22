
<!-- ================================================================
                            Footer Start
================================================================== -->

<div class="footer-part clearfix">
    <div id="pie_progress_cont" class="pie_progress--countdown" role="progressbar">
        <span class="pie_progress__number">1:00</span>
    </div>
    <div class="container">

        <div class="row">

            <div class="col-md-3 col-sm-3 col-xs-4">
                <ul>
                    <li><h1>About Psychics Voice</h1></li>
                    <li> <a href="">About Us</a></li>
                    <li> <a href=""> Top Rated Psychics</a></li>
                    <li> <a href=""> Customer Support</a></li>
                    <li> <a href="">Secured and Confidential Payment</a></li>
                    <li> <a href=""> Site Map</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-4">
                <ul>
                    <li><h1> HOW IT WORKS </h1></li>
                    <li> <a href="">Getting Started</a></li>
                    <li> <a href=""> What To Expect</a></li>
                    <li> <a href=""> Prices</a></li>
                    <li> <a href="">Psychics Voice. Advice On-The-Go</a></li>
                    <li> <a href=""> Articles</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-4">
                <ul>
                    <li><h1>   HOW WE CAN HELP   </h1></li>
                    <li> <a href="">About Us</a></li>
                    <li> <a href=""> Top Rated Psychics</a></li>
                    <li> <a href=""> Customer Support</a></li>
                    <li> <a href="">Secured and Confidential Payment</a></li>
                    <li> <a href=""> Site Map</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="footer-social-icons">
                    <h1>Follow us</h1>
                    <ul>
                        <li><a href=""><i class="fa fa-facebook-official"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter-square"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus-square"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="bootom-footer">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="bootom-footer-left-side">
                    <ul>
                        <li><a href="">Terms of Use |</a></li>
                        <li><a href="">Privacy Policy |</a></li>
                        <li><a href="">Disclaimer </a></li>
                    </ul>

                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="bootom-footer-right-side">
                    <h6>© 2016 Psychics Voice  |  All rights reserved. </h6>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('modals/modals.php');?>

<?php $this->load->view('modals/chat_modals.php');?>
<?php $this->load->view('modals/payments_modal.php');?>



<!-- Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>

<script>
        window.chat_from = {};
        window.chat_from.name = "<?=$this->session->userdata('UserScreenName');?>";
        window.chat_from.id = "<?=$this->session->userdata('UserLoggedId');?>";
        window.user_type= "<?=$this->session->userdata('UserType');?>";

        window.baseURL = '<?=base_url()?>';

    server_url = '<?= $this->config->item('server_url') ?>';
</script>
<?php if($this->session->userdata('isLoggedIn') == true && $this->session->userdata('UserType') == 'client'): ?>
<script>
    window.payment_amount ="<?=$this->session->userdata('balance');?>"
</script>
<?php elseif($this->session->userdata('UserType') == 'expert'): ?>

<?php endif; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<?php Attach_assets::attach_js($js); ?>

<script src="<?=base_url('assets/site/telephone-master/build/js/intlTelInput.js')?>"></script>
<script src="<?=base_url('assets/site/telephone-master/build/js/utils.js')?>"></script>

<script src="<?=base_url('assets/site/js/jquery-asPieProgress.js')?>"></script>
<script src="<?=base_url('assets/site/js/jquery.timeago.js')?>"></script>

<script src="<?=base_url('assets/site/js/bootbox.min.js')?>"></script>
<script src="<?=base_url('assets/site/js/flipclock.js')?>"></script>
<script src="<?=base_url('assets/site/js/classie.js')?>"></script>
<script src="<?=base_url('assets/site/js/modernizr.custom.js')?>"></script>
<script src="<?=base_url('assets/site/js/notificationFx.js')?>"></script>
<script src="<?=base_url('assets/site/js/chat.js')?>"></script>
<script src="<?=base_url('assets/site/js/payment.js')?>"></script>

<script src="<?=base_url('assets/site/plugins/iCheck/icheck.min.js')?>"></script>

<script src="<?=base_url('assets/site/js/myJS.js')?>"></script>



<!-- ================================================================
                            Footer End
================================================================== -->

</body>
</html>

