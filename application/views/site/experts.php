<div class="content-search-part clearfix">
    <div class="container">
        <div class="row">
            <label>Sort By :
                <select>
                    <option>Top Rated Readers</option>
					<option> New Readers</option>
                </select>
            </label>
        </div>
    </div>
</div>

<div class="content-persons">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><span>89</span>Psychics available now. Choose yours!</h1>
                <h2 class="border-with-lines"><span><img src="<?= base_url('assets/site/site-images/images') ?>/x.png"></span></h2>

                <!-- Expert List  -->
                <?php $this->load->view('site/expert-list.php') ?>

            </div>
            <h2 class="border-with-lines"><span><img class="expert-more-loader" src="<?= base_url('assets/site/site-images/images') ?>/x.png"></span></h2>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="border-image">
                <a href="javascript:;" class="more_psychics"><h3> View more psychics <i class="fa fa-caret-down"></i></h3></a>
            </div>
        </div>
    </div>
</div>