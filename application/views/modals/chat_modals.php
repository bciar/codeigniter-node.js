<div class="modal fade" id="notificationModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                     Connecting to  Voice HR , please wait... 
.</h4>
            </div>
            <div class="modal-body">
                <button type="button" id='sendnotification' class="btn btn-primary">Start chat </button>
                <span class='send-not-txt'></span>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="acceptreq" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chat Request form .....</h4>
            </div>
            <div class="modal-body">
                <button type="button" id='acceptnotification' class="btn btn-primary">Accept</button>
                <button type="button" id='declinenotification' class="btn btn-danger">Decline</button>
            </div>

        </div>
    </div>
</div>
<div id="notification">
    <img src='<?=base_url('assets/site/media') ?>/notification.png'/>
</div>





<div class="modal fade" id="chatModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><i class=" fa fa-circle"></i>Anna88</h3>
        </div>
        <div class="modal-body clearfix ">
          <div class="col-md-9 chat-msg no-padding">
             <div class="chat-msg-txt">
             	<div class='msg-wrap'>
             	</div>
                 <div class="msg-typing">
                 </div>
             </div>

             <div class="chat-msg-area col-md-11">

              <label for="msgsend" class="msg-label">Your Message:</label>
            <textarea class="form-control" rows="3" id="msgsend"></textarea>
            </div>
          </div>
          <div class="col-md-3 chat-info no-padding">
          <div class="block-info-img">


              <div class="chat-connect">
                    <i title="connect" class="connect fa fa-circle"></i>
                    <span>Connected</span>
              </div>
              <div class="thumb-name">
                    <div class="thumb">
                        <span class="offImg">
                            <a href="http://127.0.0.1/pv-cod/expert/15"> <img src="<?=base_url('assets/site/site-images') ?>/thumbimages/afe86b5cdcf15b5713733dc07ad3b6f0.jpg"></a>
                        </span>
                    </div>
                    <div >
                         <h3 class="modal-title"><i class=" fa fa-circle"></i>Anna88</h3>
                    </div>
                </div>
             </div>
             <div class="block-info-timer">
                <h4>Free Minutes </h4>
                <p>Session time</p>
                 <!-- <div class="timer-btn timer" data-seconds-left=18></div> -->
                 <div class="clock" ></div>
             </div>
             <div class="block-info-stop">
                 <button class="chat-btn chat-stop"><i class="fa fa-stop"></i> Stop</button>
             </div>
             <?php if($this->session->userdata('UserType') == 'expert'): ?>
             <div class="block-info-block">
                 <button class="chat-btn chat-block-client"><i class="fa fa-stop"></i> Block</button>
             </div>
              <?php endif; ?>
             <div class="block-info-block">

             </div>
          </div>
        </div>

      </div>
    </div>
  </div>
 <!-- Modal paypal cont -->
  <div class="modal fade" id="payModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
        </div>
        <div class="modal-body clearfix ">
          <div class="paypal-cont text-center">
            <h3>Chat Stoped in 3 second!</h3>
            <br>
            <br>
              <div class="pay-info pay_info_balance"><p>Your account balance <span></span>$</p></div>
              <div class="pay-info pay_info_expert"><p>Expert rate <span></span>$</p></div>
              <div class="pay-info pay_info_time"><p>You are in conversation max <span></span>min</p></div>
              <div class="pay-info pay_answ">
                <p>You want to continue?
                  <button type="button" class="btn btn-success" value='yes'>Yes</button>
                  <button type="button" class="btn btn-danger" value='no'>No</button>
                </p>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade" id="stopChatModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body clearfix ">
          <div class="paypal-cont text-center">
            <h3>Chat Stopped!</h3>
            <br>
            <br>
              <div class="pay-info pay_info_talk"><p>You chat  <span></span>minutes</p></div>
              <div class="pay-info pay_info_spent"><p>You spent <span></span>$</p></div>
              <div class="pay-info pay_fc">
                  <button type="button" class="btn btn-success" value='continue'>Continue Chat</button>
                  <button type="button" class="btn btn-danger" value='finish'>End Chat</button>

                </p>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>



<div class="modal fade" id="stopChatModalExpert" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body clearfix ">
                <div class="paypal-cont text-center">
                    <h3>Chat Stoped!</h3>
          
                    <div class="pay-info expert_finish">
                        <button type="button" class="btn btn-success" value='continue'>Continue Chat</button>
                        <button type="button" class="btn btn-danger" value='finish'>End Chat</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



   <div class="modal fade" id="stopChatModal-ex" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
     
        <div class="modal-body clearfix ">
          <div class="paypal-cont text-center">
            <h3>Chat Stopped!</h3>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="endChatModal-ex" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
        </div>
        <div class="modal-body clearfix ">
          <div class="paypal-cont text-center">
            <h3>Chat Ended!</h3>
            <br>
            <br>
              <div class="pay-info pay_info_spent"><p>Amount <span></span>$</p></div>
          </div>
        </div>

      </div>
    </div>
  </div>

<div class="modal fade" id="endChatModal-ex" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body clearfix ">
                <div class="paypal-cont text-center">
                    <h3>Chat Ended!</h3>
                    <br>
                    <br>
                    <div class="pay-info pay_info_spent"><p>Amount <span>1.99</span>$</p></div>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="block-client" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body clearfix ">
                <div class="text-center">
                    <h3>Reader Blocked You <br /> Chat Ended</h3>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="freeTimeEnd" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body clearfix ">
                <div class="text-center">
                    <h3>Free 3 minutes now ended!</h3>
                </div>
            </div>

        </div>
    </div>
</div>