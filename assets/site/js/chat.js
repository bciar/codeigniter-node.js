var audio = new Audio(baseURL+"assets/site/media/ringin.wav");
var audio_message = new Audio(baseURL+"assets/site/media/ringin-message.mp3");
var start_time;
var end_time;
var expert_rate = 0;
var payment_amount ;
var free_min = 1;
var expire_min = 0.5;
var clock = {};
var spent_time,chat_time;
var freeTime = 30;
var chat_amount = $('.pay_info_spent span');
var socket = io.connect(server_url);

// create new user in node server

socket.emit('new user', chat_from.id);

var chat_to = {};

$(document).ready(function() {
    // message box scroll to bottom
    if ($(".chat-message-section").length) {
        $(".chat-message-section").scrollTop($(".chat-message-section").children('ul').length * 500);
    }

    $('.pie_progress--countdown').asPieProgress({
        namespace: 'pie_progress',
        easing: 'linear',
        first: 60,
        max: 60,
        goal: 0,
        speed: 600, // 120 s * 1000 ms per s / 100
        numberCallback: function(n) {
            var minutes = Math.floor(this.now / 60);
            var seconds = this.now % 60;
            if (seconds < 10) {
                seconds = '0' + seconds;
            }
            return minutes + ': ' + seconds;
        }
    });
    /////////// START  Socket emit EXPERT  ///////////


    $(document).on('click', '#declinenotification',function(){
        refresh();
        chat_to.name  = $(this).closest('.ns-content').attr('data-chat-to-name');
        chat_to.id  = ($(this).closest('.ns-content').attr('data-chat-to-id')).trim();
        expert_rate =  $(this).closest('.ns-content').attr('data-chat-price')
        console.log(expert_rate)
        // console.log(chat_to);
        // console.log(chat_from);
        socket.emit('notification decline', chat_to, chat_from );
    });

    $(document).on('click', '#acceptnotification',function(){
        refresh();
        chat_to.name  = $(this).closest('.ns-content').attr('data-chat-to-name');
        chat_to.id  = ($(this).closest('.ns-content').attr('data-chat-to-id')).trim();
        expert_rate =  $(this).closest('.ns-content').attr('data-chat-price')
        console.log(expert_rate)
        $.ajax({
            type:"post",
            url: baseURL+ "get-expert-chat-price",
            data: {expert_id:chat_from.id},
            success: function (res) {
                window.expert_rate = res

            }
        });

        var upData = {
            expert_id:chat_from.id,
            client_id:chat_to.id,
            type:'chat'
        };


        $.ajax({
            type:"post",
            dataType:'JSON',
            url: baseURL+ "update-client",
            data: upData,
            success: function (res) {
                window.expert_rate = res

            }
        });

        // console.log(expert_rate)



        // console.log(chat_to);
        // console.log(chat_from);
        socket.emit('notification accept', chat_to, chat_from );
        $('.ns-close').trigger('click');

        getMessages(chat_to.id);

        $('#chatModal .modal-title').text(chat_to.name);
        $('#chatModal .modal-title').attr('data-chat-to-name',chat_to.name);
        $('#chatModal .modal-title').attr('data-chat-to-id',chat_to.id);


        console.log('expert');

        $('#chatModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        clock = $('.clock').FlipClock({
            clockFace: 'HourlyCounter',
            callbacks: {
                interval: function() {
                    var time = this.factory.getTime().time;

                    if(time) {
                        // console.log('interval', time);
                        if(time== free_min*60){
                            clock.stop(function() {
                                window.onbeforeunload = null

                                // console.log('this (optional) callback will fire after the clock stops');
                                /* $('#paypalModal').modal();*/
                                $("#freeTimeEnd").modal('show');
                                $('#chatModal').modal('hide');

                            });
                        }
                    }
                }
            }
        });
    });

    /////////// END  Socket emit EXPERT ///////////



    /////////// START  Socket emit CLIENT ///////////

    // open notification modal

    $('.chat-start').click(function() {
        if ($(this).data('available') != 1) {
            // don't allow chat with offline experts
            return;
        }

        chat_to.name = $(this).data('chat-to-name');
        chat_to.id = $(this).data('chat-to-id');
        chat_to.price = $(this).data('chat-price');
        expert_rate = $(this).data('chat-price');
        $('#notificationModal').modal();
    });
    $('.chat-close').click(function(){
        $('.chat-cont').slideUp();
    });

    // send notification to expert

    $('#sendnotification').click(function(){
        $('.send-not-txt').text('notification send...');
        audio.play();
        console.log(chat_to, chat_from);
        setTimeout(function() {

            socket.emit('notification', chat_to, chat_from);


            $('#notificationModal').modal('hide');
            $('.send-not-txt').text('');
        }, 60000);



    });
    $('.pay_answ button').click(function(){

        $('.flip-clock-wrapper .flip  .inn').removeClass('timer-warning');

        if($(this).val()=='yes'){

            clock.setTime(payment_amount/expert_rate*60);
            clock.setCountdown(true);
            clock.start();
            socket.emit('pay_answ', chat_to, chat_from, payment_amount/expert_rate*60);

            $('#payModal').modal('hide');
            $('#chatModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            socket.emit('chat continue', chat_to, chat_from);

        }else if($(this).val()=='no'){
            window.onbeforeunload = null;

            clock.stop();

            socket.emit('client chat end', chat_to, chat_from);

            chat_amount.text(0)

            $('#endChatModal-ex').modal();

            $('#payModal').modal('hide');
        }

    });
    $('.pay_fc button').click(function(){

        if ($(this).val()=='continue') {
            // continue chat

            socket.emit('chat continue', chat_to, chat_from);

            $('#chatModal').modal(
                {
                    backdrop: 'static',
                    keyboard: false

                });

            $('#stopChatModal').modal('hide');
            clock.start();

        } else {
            // finish chat

            window.onbeforeunload = null
            $('#stopChatModal').modal('hide');
            $('#endChatModal-ex').modal();
            // console.info( {amount: (spent_time*expert_rate).toFixed(3),chat_to:chat_to, chat_from:chat_from});

            chat_time = clock.getTime().time;

            // log end_time
            end_time = new Date().toISOString();

            if (chat_time > freeTime) {
                setPayment()
            } else {
                socket.emit('chat end', chat_to, chat_from, 0);
            }
        }
    });


    /////////// END  Socket emit CLIENT ///////////



    /////////// START  Socket emit COMMON ///////////

    // send message

    $('#msgsend').keypress(function(e){
        var msg = ($('#msgsend').val()).trim();
        if(e.keyCode==13 && msg.length>0){
            e.preventDefault();
            var date = new Date();
            var msgDate = {};
            msgDate.year = date.getFullYear();
            msgDate.day = date.getDay();
            msgDate.month = date.getMonth()+1;
            msgDate.hours = date.getHours()>9 ? date.getHours(): "0"+date.getHours();
            msgDate.minutes = date.getMinutes()>9 ? date.getMinutes(): "0"+date.getMinutes();
            msgDate.seconds = date.getSeconds()>9 ? date.getSeconds(): "0"+date.getSeconds();

            chat_to.name = $('#chatModal .modal-title').attr('data-chat-to-name');
            chat_to.id = $('#chatModal .modal-title').attr('data-chat-to-id');
            socket.emit('chat message', msg ,msgDate, chat_to, chat_from , date);
            
            $('.msg-wrap').append(
                '<div class="block-msg">\
                    <div class="block-msg-left">\
                     <p>'+msg+'</p>\
                        </div>\
                        <span class="msg-time pull-right">'+msgDate.hours+':'+msgDate.minutes+':'+msgDate.seconds+'</span>\
                    </div>');
            $('#msgsend').val('');
            
            
            $(".chat-msg-txt").animate({ scrollTop: $('.msg-wrap').height() }, 1000);


            var data = {
                to:chat_to.id,
                from:chat_from.id,
                message:msg
            };


            saveChat(data);
        }
    });



    // emit chat typing event

    $('#msgsend').keyup(function(e) {
        // console.log(chat_to, chat_from);
        if ($(this).val()) {
            socket.emit('chat typing', chat_to, chat_from);
        } else {
            socket.emit('end chat typing', chat_to, chat_from);
        }
    });

    $('.chat-stop').click(function(){

        chat_time = clock.getTime().time;


        socket.emit('chat stop', chat_to, chat_from);


        if(user_type == "expert" ){
            clock.stop(function() {

                $('#stopChatModalExpert').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#chatModal').modal('hide');
            });
        }else if(user_type == "client"){

            if(chat_time > freeTime){
                spent_time = (payment_amount/expert_rate*60 - chat_time)/60;
                spent_time = spent_time.toFixed(3);


            }else{
                spent_time = 0;
            }

            chat_amount.text((spent_time*expert_rate).toFixed(3));
            $('.pay_info_talk span').text(spent_time);


            // console.info('stop' ,  chat_to, chat_from);

            clock.stop(function() {
                $('#stopChatModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#chatModal').modal('hide');
            });
        }


    });
    
    $('.expert_finish button').click(function () {

        $('#stopChatModalExpert').modal('hide');

        if($(this).val() == 'continue'){

            socket.emit('chat continue', chat_to, chat_from);

            $('#chatModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            clock.start();

        }else{
            window.onbeforeunload = null

            spent_time = (payment_amount/expert_rate*60 - chat_time)/60;
            spent_time = spent_time.toFixed(3);

            $('#endChatModal-ex').modal();


            socket.emit('expert chat end',chat_to,chat_from );

        }
    });


    $('.chat-block-client').click(function () {

        var conf = confirm("Block Client ?");
        chat_time = clock.getTime().time;
        if(conf){

            window.onbeforeunload = null;

            clock.stop(function() {

            socket.emit('expert block', chat_to, chat_from);

            $.ajax({
                url:baseURL + 'block-client',
                method: "POST",
                data:{client_id:chat_to.id},
                success:function(response) {}
            });

            $('#stopChatModal-ex').modal();

            if(chat_time < 30){
               setTimeout(function () {
                   chat_amount.text(0)
                   $('#endChatModal-ex').modal()

                   setTimeout(function () {
                       location.reload()
                   },2000);
               },2000);
            }

            $('#chatModal').modal('hide');

        });

        }

    });

    /////////// END  Socket emit COMMON ///////////

});

socket.on('expert block', function(data){
    chat_time = clock.getTime().time;

    clock.stop(function() {

        window.onbeforeunload = null

        if(chat_time > freeTime){

            spent_time = (payment_amount/expert_rate*60 - chat_time)/60;
            spent_time = spent_time.toFixed(3);

            setPayment('block');
        }

        $('#block-client').modal();

        $('#chatModal').modal('hide');

        setTimeout(function () {
            location.reload()
        },6000)

    })

});

socket.on('expert chat end', function(data){

    chat_time = clock.getTime().time;

    if(chat_time > freeTime){

        chat_from = data.to;
        chat_to = data.from;

        setPayment()
    }else{
        chat_amount.text(0)
    }
    $('#stopChatModal-ex').modal('hide')
    $('#endChatModal-ex').modal();

    window.onbeforeunload = null



});




$('#btn-chat').click(function(){
    var msg = $('#msgsend').val();
    // console.log(msg);
    // console.log(chat_to);
    var chat_to = $('.chat-to').attr('data-chat-to');

    socket.emit('chat message', msg , chat_to, chat_from);
});


/*
   START Socket listener  EXPERT
*/

socket.on('notification', function(data){
    audio.play();
    $('#pie_progress_cont').fadeIn();
    $('.pie_progress').asPieProgress('start');

    // create the notification
    var notification = new NotificationFx({
        message : '<div class="ns-thumb"><img src="'+baseURL+'assets/site/site-images/thumbimages/no_img.png"/ width="64px" height="64px"></div><div class="ns-content" data-chat-to-name="'+data.from.name+' " data-chat-to-id="'+data.from.id+'  " data-chat-price=""><p><a href="#">'+data.from.name+'</a> accept my chat request.</p><button type="button" id="acceptnotification" class="btn btn-primary">Accept</button><button type="button" id="declinenotification" class="btn btn-danger  pull-right">Decline</button></div>',
        layout : 'other',
        ttl : 60000,
        effect : 'thumbslider',
        type : 'notice', // notice, warning, error or success
        onClose : function() {
            $('#pie_progress_cont').fadeOut();
            $('.pie_progress').asPieProgress('reset');
        }
    });

    // show the notification
    notification.show();

})
socket.on('pay_answ',function(data){
    $('.flip-clock-wrapper .flip  .inn').removeClass('timer-warning');
    // console.info(data.amount);
    clock.setTime(data.amount);
    clock.setCountdown(true);
    clock.start();
})

/*
    END Socket listener  EXPERT
*/


/*
    START  Socket listener CLIENT
*/


socket.on('notification decline', function(data){
    audio.play();
    var notification = new NotificationFx({
        message : '<div class="ns-thumb"><img src="'+baseURL+'assets/site/site-images/thumbimages/no_img.png"/ width="64px" height="64px"></div><div class="ns-content" data-chat-to="'+data.from+'"><p><a href="#">'+data.from+'</a> decline.</p></div>',
        layout : 'other',
        ttl : 6000,
        effect : 'thumbslider',
        type : 'notice', // notice, warning, error or success
        onClose : function() {
            //  bttn.disabled = false;
        }
    });

    // show the notification
    notification.show();

});

socket.on('notification accept', function(data){
    refresh()
    audio.play();
    chat_to = data.from;
    // console.log(chat_to, "chat_tochat_tochat_tochat_to");
    var notification = new NotificationFx({
        message : '<div class="ns-thumb"><img src="'+baseURL+'assets/site/site-images/thumbimages/no_img.png"/ width="64px" height="64px"></div><div class="ns-content" data-chat-to="'+data.from+'"><p><a href="#">'+data.from+'</a> accept.</p></div>',
        layout : 'other',
        ttl : 1200,
        effect : 'thumbslider',
        type : 'notice', // notice, warning, error or success
        onClose : function() {
            getMessages(data.from.id)

            $('#chatModal .modal-title').text(data.from.name);
            $('#chatModal .modal-title').attr('data-chat-to-name',data.from.name);
            $('#chatModal .modal-title').attr('data-chat-to-id',data.from.id);

            console.log('client');

            $('#chatModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    });

    // show the notification
    notification.show();

    // show timer

    clock = $('.clock').FlipClock({
        clockFace: 'HourlyCounter',
        callbacks: {
            interval: function() {
                var time = this.factory.getTime().time;

                if(time) {
                    if(time == (free_min-expire_min)*60){
                        $('#payModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        $('#chatModal').modal('hide');
                        $('.flip-clock-wrapper .flip  .inn').addClass('timer-warning');


                        $('.pay_info_balance span').text(payment_amount);
                        $('.pay_info_expert span').text(expert_rate);
                        $('.pay_info_time span').text((payment_amount/expert_rate).toFixed(3))


                        socket.emit('free time end', chat_to, chat_from);
                    }
                    else  if(time == free_min*60){
                        clock.stop(function() {
                            // console.log('this (optional) callback will fire after the clock stops');
                           /* $('#paypalModal').modal();*/
                            window.onbeforeunload = null
                            $('#freeTimeEnd').modal('show');
                            $('#chatModal').modal('hide');
                            $('#payModal').modal('hide');


                        });
                    }
                }
            }
        }
    });

    // log start_time
    start_time = new Date().toISOString();

})




/*
    END  Socket listener CLIENT
*/

/*
    START  Socket listener COMMON
*/

socket.on('free time end',function(data){

    $('#stopChatModal-ex').modal();

    $('#chatModal').modal('hide');

});

socket.on('chat continue',function(data){
    $('#chatModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#stopChatModal-ex').modal('hide');

    clock.start();
});

socket.on('chat end',function(data){
    $('#endChatModal-ex').modal({
        backdrop: 'static',
        keyboard: false
    });

    window.onbeforeunload = null

    $('#stopChatModal-ex').modal('hide');
    chat_amount.text(data.amount);
});

socket.on('chat stop',function(data) {
    chat_time = clock.getTime().time;
    spent_time = (payment_amount/expert_rate*60 - chat_time)/60;
    spent_time = spent_time.toFixed(3);

        if(user_type == "expert" ) {

            clock.stop(function() {
                $('#stopChatModal-ex').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#chatModal').modal('hide');
            });

        }else if(user_type == "client"){


            $('.pay_info_talk span').text(spent_time);
            chat_amount.text((spent_time*expert_rate).toFixed(3));


            clock.stop(function() {
                $('#stopChatModal-ex').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                // $('#stopChatModal').modal();
                $('#chatModal').modal('hide');
            });
        }




});

socket.on('chat typing',function(data) {
    console.log('chat typing');
    $('.msg-typing').fadeIn().html("<img src='http://makeitok.org/wp-content/themes/makeitok/images/animatingDots.gif'>");
});

socket.on('end chat typing',function(data) {
    console.log('end chat typing');
    $('.msg-typing').fadeOut();
});

socket.on('client chat end',function(data){
    clock.stop(function() {
        window.onbeforeunload = null

        chat_amount.text(0)

        clock.stop();

        $('#endChatModal-ex').modal();

        $('#chatModal').modal('hide');

        $('#payModal').modal('hide');

        $('#stopChatModal-ex').modal('hide');
    })

});

socket.on('chat message', function(data){

    $('.msg-wrap').append(
        '<div class="block-msg">\
            <div class="block-msg-right">\
             <p>'+data.msg+'</p>\
                    </div>\
                    <span class="msg-time pull-right">'+data.msgDate.hours+':'+data.msgDate.minutes+':'+data.msgDate.seconds+'</span>\
                </div>');
    $(".chat-msg-txt").animate({ scrollTop: $('.msg-wrap').height() }, 1000);
});

// message listener
socket.on('send message', function(data) {
    audio_message.play();

    loadMessages();

    if ($('.chat-message-section').length && $('input[name=subject]').val() == data.subject) {
        // we're on the messages page with same subject
        $('.chat-message-section').append(
            '<ul class="highlight">\
                <li class="right-message">\
                    <div class="message-img-section">\
                        <img src="' + $('#other_image').val() + '">\
                </div>\
                <div class="message-text-section">\
                    <p>'+data.msg+'</p>\
                    <span class="message-time">'+data.msgDate.hours+':'+data.msgDate.minutes+':'+data.msgDate.seconds+'</span>\
                </div>\
            </li>\
        </ul>'
        );

        $(".chat-message-section").animate({ scrollTop: $(".chat-message-section").children('ul').length * 500 }, 1000);
    } else {
        $('#message_bubble').html(parseInt($('#message_bubble').html()) + 1).fadeIn();

        if ($('.messages-container').length) {
            // we're on message list page

            var bubble = $('.message-block[data-to='+ data.from.id +'][data-subject="' + data.subject + '"] .bubble');
            bubble.html(parseInt(bubble.html()) + 1).fadeIn();
        }
    }

});

/*
  END  Socket listener COMMON
*/


// socket.emit('disconnect',chat_to, chat_from);

socket.on('disconnect', function(){
    console.log('disconnected')
});

//
function getMessages(to) {

    $.ajax({
        type: 'post',
        dataType:'JSON',
        url: baseURL+ "get-chat",
        data: {to:to},
        success: function(result) {
            if(result.status == 'success'){
                var res = result.response;
                var type = '';
                res.forEach(function (item) {
                    if(to == item.to){
                        type = 'block-msg-left'
                    }else{
                        type = 'block-msg-right'
                    }

                    $('.msg-wrap').append('<div class="block-msg"><div class="'+type+'"><p>'+item.message+'</p></div></div>')

                })

                $(".chat-msg-txt").animate({ scrollTop: $('.msg-wrap').height() }, 1000);

            }
        }

    })

}
//
function saveChat(data) {

    $.ajax({
        type: 'post',
        url: baseURL+ "save-chat",
        data: data,
        success: function(res){

        }

    })
}
//
function setPayment(block) {

    $.ajax({
        url: baseURL+ "set-payment",
        type: 'post',
        data: {
            spent_time: spent_time,
            expert_rate: expert_rate,
            start_time: start_time,
            end_time: end_time,
            amount: (spent_time*expert_rate).toFixed(3),
            chat_to:chat_to,
            chat_from:chat_from,
        },
        success: function(res) {
            socket.emit('chat end', chat_to, chat_from,  (spent_time*expert_rate).toFixed(3));

            payment_amount = payment_amount - res;
            // console.info(payment_amount);
            $("#feedback_expert_id").val(chat_to.id);

            if(block == undefined){
                window.onbeforeunload = null
                setTimeout(function () {
                    $('#endChatModal-ex').modal('hide');
                    $('#stopChatModal-ex').modal('hide');
                    $('#starsModal').modal('show');
                },2000)
            }

        }

    })
}
//
function refresh() {
    window.onbeforeunload = function(){
        return 'Are you sure you want to leave?';
    };
}

//

/* MESSAGE FIX */

var sendMessage = function(url, msg, msgDate) {
    $('.chat-message-section').append(
        '<ul>\
            <li class="left-message">\
                <div class="message-text-section">\
                    <p>'+msg+'</p>\
                    <span class="message-time">'+msgDate.hours+':'+msgDate.minutes+':'+msgDate.seconds+'</span>\
                </div>\
                <div class="message-img-section">\
                    <img src="' + $('#my_image').val() + '">\
                </div>\
            </li>\
        </ul>');

    $('#message').val('');
    $.ajax({
        url: url,
        type: 'post',
        data: {
            message: msg,
            subject: $('input[name=subject]').val()
        },
        dataType: 'json',
        success: function(res) {
            if (res.status == 'error') {
                alert(res.message);
            }
        },
        fail: function(res) {
            $('#message').val('Failure');
        }

    });

    $(".chat-message-section").animate({ scrollTop: $(".chat-message-section").children('ul').length * 500 }, 1000);
}

// Client send message
$('#send_mail_form').submit(function(e) {
    e.preventDefault();

    var msg = $('#message').val();
    if (! msg) return;

    var subject = $('input[name=subject]').val();

    var date = new Date();
    var msgDate = {};
    msgDate.year = date.getFullYear();
    msgDate.day = date.getDay();
    msgDate.month = date.getMonth()+1;
    msgDate.hours = date.getHours()>9 ? date.getHours(): "0"+date.getHours();
    msgDate.minutes = date.getMinutes()>9 ? date.getMinutes(): "0"+date.getMinutes();
    msgDate.seconds = date.getSeconds()>9 ? date.getSeconds(): "0"+date.getSeconds();

    chat_to.name = $('#expert_name').val();
    chat_to.id = $('#expert_id').val();
    socket.emit('send message', subject, msg, msgDate, chat_to, chat_from, date);

    url = $(this).attr('action');

    if ($(this).data('modal') == true) {
        url = url + activeUserId
    }

    sendMessage(url, msg, msgDate);

    if ($(this).data('modal') == true){
        $('#clientPay').modal('hide');
    }

    return false;
});

// Expert send message
$('#answer_client').submit(function(e) {
    e.preventDefault();

    var msg = $('#message').val();
    if (! msg) return;

    var subject = $('input[name=subject]').val();

    var date = new Date();
    var msgDate = {};
    msgDate.year = date.getFullYear();
    msgDate.day = date.getDay();
    msgDate.month = date.getMonth()+1;
    msgDate.hours = date.getHours()>9 ? date.getHours(): "0"+date.getHours();
    msgDate.minutes = date.getMinutes()>9 ? date.getMinutes(): "0"+date.getMinutes();
    msgDate.seconds = date.getSeconds()>9 ? date.getSeconds(): "0"+date.getSeconds();

    chat_to.name = $('#client_name').val();
    chat_to.id = $('#client_id').val();
    socket.emit('send message', subject, msg, msgDate, chat_to, chat_from, date);

    sendMessage($(this).attr('action'), msg, msgDate);

    return false;
});
