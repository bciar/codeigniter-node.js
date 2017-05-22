
<div class="content-admin-part">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3>Settings</h3>
                <div class="tab-content-part clearfix">
                    <!-- tabs left -->
                    <div class="tabbable left-setting-part tabs-left">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#a" data-toggle="tab">Personal Information<i class="fa fa-caret-right"></i></a></li>
                            <li class=""><a href="#b" data-toggle="tab">Contact Information<i class="fa fa-caret-right"></i></a></li>
                            <li class=""><a href="#c" data-toggle="tab">Email Settings<i class="fa fa-caret-right"></i></a></li>
                            <?php if($this->session->userdata('UserType') == 'expert'): ?>
                                <li class=""><a href="#c1" data-toggle="tab">Mail Price<i class="fa fa-caret-right"></i></a></li>
                            <?php endif ?>
                            <li class=""><a href="#d" data-toggle="tab">Payment Settings<i class="fa fa-caret-right"></i></a></li>
                        </ul>

                        <form enctype="multipart/form-data" method="post" action="<?=base_url('edit-settings')?>">
                        <div class="tab-content clearfix">
                            <div class="tab-pane active"  id="a">
                                <h2>Personal Information</h2>
                                <div class="col-md-9 ">
                                    <div class="change-part-content clearfix">

                                            <?php $error = $this->session->flashdata('errors') ?>
                                                <?php if(!empty($error)): ?>
                                                <div class="alert alert-danger">
                                                   <strong><h4><?=  $error; ?></h4></strong>
                                                </div>
                                             <?php endif; ?>

                                            <?php $success = $this->session->flashdata('success') ?>
                                            <?php if(!empty($success)): ?>
                                                <div class="alert alert-success">
                                                    <strong><h4><?=  $success; ?></h4></strong>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(!empty($user_info)): ?>
                                            <input type="hidden" name="userType" value="<?=$this->session->userdata('UserType') ?>">
                                            <input type="hidden" name="userId" value="<?=$this->session->userdata('UserLoggedId') ?>">

                                        <div class="col-md-4  col-xs-12 thumb-images">
                                            <div class="thumb-name">
                                                <figure>My Image</figure>
                                                <div class="thumb">
                                                     <span>
                                                          <img src="<?=base_url('assets/site/site-images/thumbimages/'.$user_info->image)?>">
                                                     </span>
                                                </div>
                                            </div>

                                            <hr>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group clearfix">
                                                <label for="nameField" class="col-xs-12  col-md-6 ">Name</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text"  value="<?=$user_info->name?>" class="form-control"  name="name" placeholder="" />
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label for="emailField" class="col-xs-12  col-md-6 ">Surname:</label>
                                                <div class="col-md-6 col-xs-12">
                                                     <input type="text" value="<?=$user_info->surname?>"  class="form-control" name="surname"  placeholder="" />
                                                 </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label for="phoneField"  class="col-xs-12  col-md-6 ">Birthday</label>
                                                <div class="col-md-6 col-xs-12">
                                                   <input type="date" value="<?=$user_info->birthday?>"  class="form-control" name="birthday"  id="phoneField" placeholder="" />
                                                 </div>
                                            </div>

                                            <div class="col-md-12 rad-part">
                                                <label class="radio-inline"><input type="radio" <?php if($user_info->usex == 'male'): ?>  checked  <?php  endif;?>   value="male"   name="usex">Male</label>
                                                <label class="radio-inline"><input type="radio" <?php if($user_info->usex == 'female'): ?>  checked  <?php  endif;?>   value="female" name="usex">Female</label>
                                            </div>


                                            <div class="form-group clearfix ">
                                                <label for="descField" name="image"  class="col-xs-12  col-md-6 ">Image</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="hidden" name="myimg" value="<?=$user_info->image?>">
<!--                                                    <input type="file" name="img" class="form-control" />-->
                                                 </div>


                                                <!-- --->
                                                <div class="col-md-12">
                                                    <div class="widget">
                                                        <div class="controls controls-width span12">
                                                            <div class="imageupload">
                                                                <div id="photo">
                                                                    <img width="200px;" id="ImagePreview" src="<?=base_url('assets/site/site-images/thumbimages/'.$user_info->image)?>" alt="your image"/>
                                                                </div>
                                                                <br>
<!--                                                                <label class="control-label"><b>Upload your image:</b></label>-->
                                                                <div class="col-md-6 col-md-offset-4">
                                                                <input type="file" name="img" id="Image">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn btn-primary black-add-button" id="editImagePreview"> Edit!
                                                                    </button>
                                                                </div>


<!--                                                                <hr />-->
<!--                                                                <button type="submit" class="btn">Upload</button>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- -->


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="b">
                                <h2>Contact Settings</h2>
                                <div class="change-part-content">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
<!--                                                    <label for="usr">Contact Number</label>-->
                                                <div class="form-group clearfix">
                                                    <label for="sel1" class="col-xs-12 col-md-4">Country list:</label>
                                                    <div class="col-xs-12 col-md-8">
                                                    <select class="form-control" name="country" id="sel1">
                                                        <option>Armenia</option>
                                                        <option>Arcax</option>
                                                        <option>Pakistan</option>

                                                    </select>
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group clearfix">
                                                     <label for="usr" class="col-xs-12 col-md-4">City</label>
                                                    <div class="col-xs-12 col-md-8">
                                                       <input type="text" name="city" value="<?=@$user_address->city?>" class="form-control" id="usr">
                                                      </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="strn"  class="col-xs-12 col-md-4">Phone number</label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="phone_number" value="<?=@$user_address->phone_number?>" class="form-control" id="phone">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group clearfix">
                                                    <label for="usrs"  class="col-xs-12 col-md-4">State/Province</label>
                                                    <div class="col-xs-12 col-md-8">
                                                         <input type="text" name="state" value="<?=@$user_address->state?>" class="form-control" id="usrs">
                                                     </div>
                                                </div>

                                                <div class="form-group clearfix">
                                                    <label for="str"  class="col-xs-12 col-md-4">Street</label>
                                                    <div class="col-xs-12 col-md-8">
                                                         <input type="text" name="street" value="<?=@$user_address->street?>" class="form-control" id="str">
                                                    </div>
                                                </div>

                                                <div class="form-group clearfix">
                                                    <label for="strn"  class="col-xs-12 col-md-4">Zip code</label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="number" name="zip" value="<?=@$user_address->zip?>" class="form-control" id="strn">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="c">
                                <h2>Email Settings</h2>

                                <div class="change-part-content">
                                    <div class="col-md-9 ">
                                        <div class="form-group clearfix">
                                            <label for="usr" class="col-xs-12  col-md-2 col-md-offset-4">Email</label>
                                            <div class="col-md-6 col-xs-12">
                                                 <input type="email" name="email" value="<?=$user_email->email?>" class="form-control" id="usr">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if($this->session->userdata('UserType') == 'expert'): ?>
                            <div class="tab-pane" id="c1">
                                <h2>Email Settings</h2>

                                <div class="change-part-content">
                                    <div class="col-md-9 ">
                                        <div class="form-group clearfix">
                                            <label for="usr1"  class="col-xs-12  col-md-2 col-md-offset-4">Mail Price $</label>
                                            <div class="col-md-6 col-xs-12">
                                                 <input type="number" name="mail_price" value="<?=$user_info->mail_price?>" class="form-control" id="usr1">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="tab-pane" id="d">
                                <h2>Payment Settings</h2>
                                <div class="change-part-content">
                                    <div class="col-md-9 ">
                                        <div class="form-group clearfix">
                                            <label for="usr" class="col-xs-12  col-md-2 col-md-offset-4">paymen Email</label>
                                            <div class="col-md-6 col-xs-12">
                                                    <input type="email" value="<?=$user_info->paym_email?>" name="paym_email" class="form-control" id="usr">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                            <div class=" button-part-admin no-padding">
                                <button type="submit" class="btn ">Save Changes</button>
                            </div>

                        </form>
                    </div>
                    <!-- /tabs -->


                </div>
            </div>
        </div>
    </div>
</div>

