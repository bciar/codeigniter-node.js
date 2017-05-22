<div class="main_container">
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="<?=base_url('admin')?>" class="site_title"><span>Super Admin</span></a>
            </div>
            <div class="clearfix"></div>
           <!-- <div class="profile">
                <div class="profile_pic">
                    <img src="<?/*=base_url() */?>/assets/admin/images/img.jpg" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <span>Welcome,</span>
                    <h2>Anthony Fernando</h2>
                </div>
            </div>-->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                        <li><a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-home"></i> Home </a>
                        </li>
                        <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li>
                                    <a href="<?=base_url('admin/clients')?>">All Clients</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('admin/experts')?>">All Experts</a>
                                </li>
                            </ul>
                        </li>

                        <li><a><i class="fa fa-align-justify"></i> Experts Categories <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li>
                                    <a href="<?=base_url('admin/categories/create')?>">New Category</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('admin/categories/all')?>">All Categories</a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="<?=base_url('admin/expert_ranking')?>"><i class="fa fa-sort"></i> Expert Ranking </a>
                        </li>

                        <li><a><i class="fa fa-paypal" aria-hidden="true"></i> Payments <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li>
                                    <a href="<?=base_url('admin/payments')?>">Payment Process</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('admin/payments/withdrawals')?>">Withdrawals</a>
                                </li>
                            </ul>
                        </li>

                        <li><a><i class="fa fa-book" aria-hidden="true"></i> Reading History <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li>
                                    <a href="<?=base_url('admin/reading-history/chat')?>">Chat</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('admin/reading-history/message')?>">Message</a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="<?=base_url('admin/configuration')?>"><i class="fa fa-cog"></i> Configuration </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /sidebar menu -->
        </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <nav class="" role="navigation">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?=base_url();?>assets/admin/images/img.jpg" alt="">Super admin
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                            <li><a href="<?= base_url('admin/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>

                    <li role="presentation" class="dropdown">
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                            <li>
                                <a>
                                            <span class="image">
                                        <img src="<?=base_url()?>assets/admin/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->