<!-- ================================================================
                            Content Start
================================================================== -->

<div class="slider">
    <div class="container-fluid">
        <div class="row">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="<?= base_url('assets/site/site-images/images') ?>/slider1.png" alt="...">
                        <div class="carousel-caption hidden-xs col-md-6">
                            <div class="col-md-4 text-center" style="max-width:415px;">
                                <h2>
                                    Psychic Reading - No Risk
                                </h2>
                                <h4 class="slide-text">Never see Psychics Readers  before? </h4>
                                <h4 class="slide-text slite-title-2">Answers to the most commonly asked questions.</h4>

                                <h4 class="">Finding hope, clarity , Get answers you need chat with our Readers ……</h4>

                                <button class="trial-btn">Start My reading </button>

                                <h4 class="">3 FREE Chat Minutes with EVERY Psychic Readers</h4>
                            </div>
                        </div>
                        <div class="carousel-caption-right hidden-xs">
                            <!-- <h3>Get your free 3 minutes stress solution!!!</h3>-->
                            <!--                            <img src="<? /*=base_url('assets/site/site-images/images') */ ?>/sale.png" class="img-responsive" alt="...">
-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-input">
        <div class="butt-part">
            <input placeholder="Search..." type="text" class="search-place">
            <i class="fa fa-search"></i>
        </div>
    </div>
</div>

<div class="phys-specialize">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Psychic Readers <span>Specialize in</span></h1>
                <?php if(!empty($expert_categories)): ?>
                    <?php foreach($expert_categories as $cat): ?>
                        <div class="col-md-3 col-xs-6">
                            <div class="specialize-content">
                                <a href="specialize/<?=$cat->category_slug ?>"><img src="<?= base_url('assets/site/categories-images/'.$cat->cat_image) ?>"> <?=$cat->category_name?></a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2>No Categories</h2>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- Expert List  -->
<?php $this->load->view('site/experts.php') ?>

<div class="container-fluid">
    <div class="row">
        <div class="choose-slider">
            <div class="choose-slider-content">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <div class="item">
                        <h1>Why Choose <span>P sychics Voice</span></h1>
                        <img src="<?= base_url('assets/site/site-images/images') ?>/new.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h2 class="read-more-title">Psychic Readers rating & reviews |  Chat and mail | Private and anonymous | Verified psychic Readers</span></h2>
<div class="read-more-phis">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 psy-content-block">
                <span>
                 <img src="<?= base_url('assets/site/site-images/images') ?>/1.svg" alt="">
                    Amazing Readers
                </span>
                <div class="col-md-12 steps-container">
                    <div class="col-md-6 text-center step-block">
                        <img src="<?= base_url('assets/site/site-images/images') ?>/like.svg" alt="">
                        <p>
                            The quality of our psychic Readers is unmatched
                        </p>
                    </div>
                    <div class="col-md-6 text-center step-block">
                        <img src="<?= base_url('assets/site/site-images/images') ?>/star.svg" alt="">
                        <p>
                            Add Psychic Readers to your favourite list.
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-md-4 col-sm-6 psy-content-block">
                <span>
                    <img src="<?= base_url('assets/site/site-images/images') ?>/2.svg" alt="">
                   How it works ?
                </span>
                <div class="col-md-12 step-how-it-works">
                    <div class="how-it-works-blocks">
                        <span>
                           <img src="<?= base_url('assets/site/site-images/images') ?>/users.svg" alt="">
                        </span>
                        CHOOSE AN READER
                    </div>
                    <div class="how-it-works-blocks">
                        <span>
                           <img src="<?= base_url('assets/site/site-images/images') ?>/chat.svg" alt="">
                        </span>
                        CLICK CHAT OR MAIL
                    </div>
                    <div class="how-it-works-blocks">
                        <span>
                           <img src="<?= base_url('assets/site/site-images/images') ?>/success.svg" alt="">
                        </span>
                        COMPLETE REGISTRATION
                    </div>
                    <div class="how-it-works-blocks">
                        <span>
                           <img src="<?= base_url('assets/site/site-images/images') ?>/convers.svg" alt="">
                        </span>
                        ENJOY CONVERSATION
                    </div>

                </div>

            </div>

            <div class="col-md-4 col-sm-6 psy-content-block">
                <span>
                    <img src="<?= base_url('assets/site/site-images/images') ?>/3.svg" alt="">
                    New Users enjoy
                </span>
                <div class="col-md-12 new-user-add">
                    <p class="free-offer-text">
                        3 FREE MIN + 60% OFF
                    </p>
                    <div class="free-offer-block text-center">
                        <p>FOR THE BEST OF YOUR SESSION</p>
                        <button>
                            Start FREE reading now
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--<div class="container-fluid">-->
<!--    <div class="row">-->
<!--        <div class="how-works text-center">-->
<!--            <h1>How it works ? <span>Easy as 1-2-3 </span></h1>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="content-bottom-side">
    <div class="container">
        <div class="row">
            <!--            <div class="col-md-6 col-sm-6">-->
            <!--                <div class="content-bottom-side-left">-->
            <!--                    <img src="--><?//= base_url('assets/site/site-images/images') ?><!--/howit.png">-->
            <!--                    <!--                    <h6>Lorem Ispum Text About Lorem</h6>-->
            <!--                </div>-->
            <!--            </div>-->

            <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                <div class="content-bottom-side-right">
                    <h1>Are you a Psychic?</h1>
                    <p>
                        Join with Psychics Voice today to engage with thousands of new
                        clients via online chat, email.
                    </p>
                    <a data-toggle="modal" data-target="#myModal" href="javascript:void(0)">Join as a Psychics Voice</a>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- ================================================================
                            Content End
================================================================== -->


