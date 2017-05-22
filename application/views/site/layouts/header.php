<html>
<head>
    <title>Psychic</title>
    <meta name="viewport" content="width=device-width">

    <!-- Style Css-->
    <?php Attach_assets::attach_css($css); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/site/css/modalsStyle.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/site/css/ns-default.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/site/css/ns-style-other.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/site/css/LTE.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/site/css/flipclock.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/site/telephone-master/build/css/intlTelInput.css')?>">

    <link rel="stylesheet" href="<?=base_url('assets/site/plugins/iCheck/flat/pink.css')?>">

</head>

<body>
<!-- ================================================================
                            Header Start
================================================================== -->


<?php if($this->session->userdata('isLoggedIn') == true): ?>

    <?php $this->load->view('site/layouts/dashboard-header'); ?>

<?php else: ?>

<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><button data-toggle="modal" data-target="#signModal"><i class="fa fa-sign-in"></i>Sign in</button></li>
                    <li><span>or</span></li>
                    <li><button data-toggle="modal" data-target="#myModaluser"><i class="fa fa-user-plus"></i>Sign up</button></li>
                </ul>

            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<h1 class="marquee text center">Get your free 3 minutes stress solution!</h1>

<div class="container">
    <div class="logo-menu-part">
        <div class="row">
            <div class="col-md-3 ">
                <div class="logo">
                    <a href="<?=base_url();?>"><img src="<?=base_url('assets/site/site-images/images') ?>/official-logo.png"></a>
                </div>
            </div>
            <div class="col-md-9 ">
                <div class="right-menu">


                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- links Start-->
                        <div class=".bottom_menu navbar-collapse no-padding collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav links navbar-nav">
                                <li class="active stars-modal"><a href="<?=base_url('')?>">Home</a></li>
                                <li><a href="<?=base_url('about')?>">About us</a></li>
                                <li><a href="<?=base_url('overview')?>">Overview</a></li>
                                <li><a href="<?=base_url('how-it-works')?>">How It Works</a></li>
                                <li><a href="<?=base_url('need-help')?>">Need Help?</a></li>
                                <li><a href="<?=base_url('questions')?>">Questions&Answers </a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- ================================================================
                            Header End
================================================================== -->





