$(function() {
    //
    var base_url = location.origin+'/';

    // Register User Part With Ajax
    $('#register_user').submit(function(){

        $.ajax({
            url:this.action,
            type:this.method,
            data:$(this).serialize(),
            dataType:'json',
            success:function(response){
                console.log(response);
                if(response.status == 'error') {
                    $('#message_client').text("");
                    $('#message_client').html(response.message);

                }else if(response.status == 'success'){

                    ////// Reset Login Form
                    $('#message_login').text("");
                    document.getElementById("login_user").reset();

                    ////// Reset User Registration Form
                    $('#message_client').text("");
                    $('#message_client').html(response.message);
                    document.getElementById("register_user").reset();


                    setTimeout(function(){
                        $('#myModaluser').modal('hide');

                        $('#signModal').modal('show');
                    }, 3000);

                }else if(response.status == 'success_auto'){
                    $('#message_client').text("");
                    $('#message_client').html(response.message);

                    setTimeout(function(){
                        $('#message_expert').text("");
                        location = baseURL+'dashboard';
                    },1500);
                }

            }
        });
        return false;
    });

    // Register Expert Part With Ajax

    $('#register_expert').submit(function(){

        $.ajax({
            url:this.action,
            type:this.method,
            data:$(this).serialize(),
            dataType:'json',
            success:function(response){
                if(response.status == 'error_e') {
                    $('#message_expert').text("");
                    $('#message_expert').html(response.message);

                }else {

                    $('#message_expert').text("");
                    $('#message_expert').html(response.message);


                    $('#message_login').text("");
                    document.getElementById("login_user").reset();

                    setTimeout(function(){
                        document.getElementById("register_expert").reset();

                        $('#myModal').modal('hide');
                        $('#message_expert').text("");
                    },4000);

                }
            }
        });
        return false;
    });


    // Login Part User And Expert

    $('#login_user').submit(function () {
        $.ajax({
            url:this.action,
            type:this.method,
            data:$(this).serialize(),
            dataType:'json',
            success:function(response){

                if(response.status == 'error') {
                    $('#message_login').text("");
                    $('#message_login').html(response.message);

                }else if(response.status == 'success'){

                    $('#message_login').html(response.message);

                    setTimeout(function(){
                        $('#signModal').modal('hide');
                    },1000);

                    setTimeout(function(){
                        $('#message_login').text("");

                         location = baseURL+'dashboard';
                    },1000);
                }
            }
        });

        return false;
    });

    $(document).on('click','#add_favorite',function () {

        $(this).html('Added Favorite List');
        $(this).addClass('add');

        var expert_id = $('#expert_id').val();
        $.post(base_url+'expert/favorite',{expert_id:expert_id},function (response) {

        },'json')
    });

    $(document).on('click','#del_favorite',function () {
        $(this).html('<i class="fa fa-star"></i>Add to Favorite');
        $(this).removeClass('add');
    
        var expert_id = $('#expert_id').val();
        $.post(base_url+'/expert/favorite/del',{expert_id:expert_id},function (response) {

        },'json')
    })


    var ExpertsOffset = 6;
    var getMoreExperts = true;

    $('.more_psychics').click(function (e) {

        if(getMoreExperts){
            e.preventDefault();

            var loader =  $('.expert-more-loader');

            loader.addClass('loading');

            $.ajax({
                url:baseURL+'expert-more',
                type:'POST',
                data:{offset:ExpertsOffset},
                dataType:'json',
                success:function(response){
                    if(response.status == 'success') {

                        $('.experts-list').append(response.response.experts);

                        ExpertsOffset += ExpertsOffset;

                        if(response.response.count == 0){
                            getMoreExperts = false
                        }

                        loader.removeClass('loading')
                    }
                }
            });
        }

    })



    $('.sign_up').click(function(){

        $('#signModal').modal('hide');

        $('#myModal').modal('hide');

        $('#myModaluser').modal('show');

    });

    $('.sign_in').click(function(){

        $('#myModal').modal('hide');

        $('#myModaluser').modal('hide');

        $('#signModal').modal('show')

    });

    $('.stars-modal').click(function(){

        $('#starsModal').modal('show')

    });

    $('#close_feedback').click(function () {
        $('#starsModal').modal('hide')
    });


//
//     $("#owl-demo").owlCarousel({
// //                autoPlay : 10000,
//         navigation : true, // Show next and prev buttons
//         slideSpeed : 900,
//         paginationSpeed : 900,
//         singleItem:true
//     });
//
//     $("#owl-demo1").owlCarousel({
//         navigation : true,
//         slideSpeed : 900,
//         paginationSpeed : 900,
//         singleItem:true
//     });
    menuToggle();

    $(window).resize(function(){
        menuToggle();
    });

    if($(window).width() <= 768){
        $('.has-dropdown').toggleClass('menu_show');

    }else{

    }

    function menuToggle(){
        if($(window).width() <= 768){
            $('.has-dropdown').addClass('menu_show');

        }else{
            $('.has-dropdown').removeClass('menu_show');

        }
    }

    $(document).on('click','.has-dropdown.menu_show',function(){
        $(this).find('ul').slideToggle();
    })


    if (!$("body").hasClass("alert-success")) {
        setTimeout(function(){
            $('.alert-success').slideUp('600');
        },4000);
    }

    $('.acardion-expert-page-content h1 span').click(function(){
        $(this).find('i').toggleClass('fa-minus fa-plus')
        $(this).parent().next().slideToggle();
    })

    /* edit Images using aviray */
    /*var featherEditor = new Aviary.Feather({
     apiKey: '', // your api key , you can get one from http://developers.aviary.com/
     apiVersion: 3, // the api version . 3 is the last one so far
     theme: 'dark', // there are 'light' and 'dark' themes
     tools: 'all', // you can specify the tools from here, you can include/exclude what ever you want
     appendTo: '',
     onSave: function(imageID, newURL) {
     var img = document.getElementById(imageID);
     img.src = newURL; // after save, replacs the image with the new one from aviary.com
     featherEditor.close();

     },
     onError: function(errorObj) {
     alert(errorObj.message);
     }
     });*/
    /* after upload call read image function*/
    $(document).on('change', '#Image', function() {
        // readImage(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                launchEditor('ImagePreview', e.target.result);
                $('#ImagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    function launchEditor(id, src) {
        featherEditor.launch({
            image: id,
            url: src
        });
        return false;
    }
    $(document).on('click', '#editImagePreview', function() {
        var url =$('#ImagePreview').attr("src");
        return launchEditor('ImagePreview', url);
    });

    $('button.send_msg_btn').on('click',function (event) {
        var mailPrice = $(this).data('mail_price');

        $('#mail_price').text(mailPrice)
        $('#exp_short_desc').html($(this).children('.expert_shortdescription').html())

        $('#expert_name').val($(this).data('user-name'))
        $('#expert_id').val($(this).data('user-id'))

        activeUserId = $(this).data('user-id');

    });
    //
    // $('#clientPay').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget) // Button that triggered the modal
    //     var invoice = button.data('invoice') // Extract info from data-* attributes
    //     var expert = button.data('expert')
    //
    //     var self = $('#send_mail_form');
    //
    //     var url = self.attr('action');
    //
    //     if($(this).data('modal') == true){
    //         url = self.attr('action') +activeUserId
    //     }
    //
    //     var modal = $(this);
    //     modal.find('#invoice_expert').html(button.data('expert_name'));
    //     modal.find('#invoice_amount').html('$' + button.data('amount'));
    //     modal.find('#invoice_id').val(invoice);
    //     modal.find('#expert_id').val(expert);
    // });
    //
    // $(document).on('submit','#send_mail_form',function (event) {
    //     event.preventDefault();
    //     var self = $('#send_mail_form');
    //
    //     var url = self.attr('action');
    //
    //     if($(this).data('modal') == true){
    //         url = self.attr('action') +activeUserId
    //     }
    //
    //     $.ajax(url, {
    //         method: "POST",
    //         data: self.serialize(),
    //
    //         success: function (respons) {
    //
    //             var resObj = JSON.parse(respons)
    //             if(resObj.status == 'error'){
    //                 $('.error_mgs_chat').html(resObj.message);
    //             }else if(resObj.status == 'success'){
    //                 self.find('textarea').val('');
    //                 $('.answer-modal').hide();
    //
    //                 location.reload();
    //             }else if(resObj.status == 'length'){
    //                 $('.error_mgs_chat').html('<p>You are write wrong text</p>');
    //             } else if(resObj.status == 'poor'){
    //                 $('#addFundsModal').modal('show');
    //             }
    //
    //         }
    //
    //     })

    // Dyanmic Load Chat Details Dialog Content
    $('#dlg_chatdetails').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var chat_id = button.data('chat'); // Extract info from data-* attributes
        var url = button.data('url');

        var modal = $(this);
        var container = modal.find('#chat_details');

        container.html('Loading Chat Details ...');
        $.ajax(url, {
            method: "POST",
            data: {
                chat_id: chat_id
            },
            success: function (response) {
                container.html(response);
            }
        });

    });

    if ($('#readinghistory_container').length) {
        // reading history
        var loadReadinghistory = function (from) {
            var $list = $('#readinghistory_container .tab-pane.active');

            $.post(
                window.baseURL + 'reading-history/ajax',
                {
                    type: $list.attr('id'),
                    from: from
                },
                function (response) {
                    $list.append(response);

                    if ($('.no_more[value="1"]').length) {
                        $('#view_more').fadeOut();
                    }
                }
            );
        }

        $('#view_more').on('click', function() {
            loadReadinghistory($('#from').val());
            $('#from').remove();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href").substr(1); // activated tab
            var $list = $('#readinghistory_container .tab-pane.active');

            if (!$list.html()) {
                loadReadinghistory(0);
            }
            $('#view_more').fadeIn();
        });

        loadReadinghistory(0);
    }

});