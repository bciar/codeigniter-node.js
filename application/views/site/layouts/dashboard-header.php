<div class="user-header-top clearfix">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li class="active"><a href="<?=base_url('dashboard')?>"><i class="fa fa-table"></i>Dashboard</a></li>
                    <li><a href="<?=base_url('reading-history')?>"><i class="fa fa-envelope"></i>Reading History</a></li>
                    
                    <?php if($this->session->userdata('isLoggedIn') == true && $this->session->userdata('UserType') == 'client' ): ?>
                        <li><a href="<?=base_url('favorite-list')?>"><i class="fa fa-star"></i>My Psychics </a></li>
                        <li><a href="<?=base_url('payments')?>"><i class="fa fa-credit-card"></i>Payments </a></li>
                        <li><a href="<?=base_url('client/messages')?>"><i class="fa fa-comment"></i>Messages <span id="message_bubble" class="bubble pink">0</span></a></li>
                    <?php elseif($this->session->userdata('isLoggedIn') == true && $this->session->userdata('UserType') == 'expert'): ?>
                        <li><a href="<?=base_url('skills-experience')?>"><i class="fa fa-briefcase"></i>Skills/experience</a></li>
                        <li><a href="<?=base_url('payments')?>"><i class="fa fa-credit-card"></i>Payments </a></li>
                        <li><a href="<?=base_url('expert/messages')?>"><i class="fa fa-comment"></i>Messages <span id="message_bubble" class="bubble pink">0</span></a></li>
                    <?php endif; ?>
                    
                    <li><a href="<?=base_url('settings')?>"><i class="fa fa-cog"></i>Settings  </a></li>
                    <li><a href="<?=base_url('logout')?>"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>