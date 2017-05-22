$(function() {
    var offset = 5;
    var getMoreFeedback = true;

    $('.more_feedback').click(function (e) {

        e.preventDefault();

        var $this = $(this);

        if (getMoreFeedback) {

        $this.find('i').addClass('loading');

        $.ajax({
            url:baseURL+'feedback-more',
            type:'POST',
            data:{offset:offset},
            dataType:'json',
            success:function(response){
                if(response.status == 'success') {

                    $('.recent_feedback').append(response.response.feedback)

                    offset += offset
                }

                if(response.response.count == 0){
                    getMoreFeedback = false
                }

                $this.find('i').removeClass('loading')
            }
        });

        }
    });


    var telInput = $("#phone"),
        errorMsg = $("#error-msg"),
        validMsg = $("#valid-msg");

    // initialise plugin
    telInput.intlTelInput({
        nationalMode:false,
        initialCountry: "auto",
        utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/utils.js",
        geoIpLookup: function(callback) {
            $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        }
    });

    var reset = function() {
        telInput.removeClass("error");
        errorMsg.addClass("hide");
        validMsg.addClass("hide");
    };

    // on blur: validate
    telInput.blur(function() {
        reset();
        if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {

                validMsg.removeClass("hide");

                var number = $("#phone").intlTelInput("getNumber");

                $.ajax({
                    url:baseURL+'tel-number',
                    type:'POST',
                    data:{number:number},
                    dataType:'json',
                    success:function(response){
                        if(response.status == 'success') {

                            $('.phone_number').removeClass('hide').text(number);
                            $('.tel-part').addClass('hide');
                            $('#valid-msg').addClass('hide');

                        }
                    }
                });

            } else {
                telInput.addClass("error");
                errorMsg.removeClass("hide");
            }
        }
    });


    // on keyup / change flag: reset
    telInput.on("keyup change", reset)
    
    $('.add_phone_number').on('click',function (e) {

        e.preventDefault();

        var number = $('.phone_number').text();

        $('.phone_number').addClass('hide');

        $('.tel-part').removeClass('hide');

        // $("#phone").intlTelInput("setCountry", "gb");

        $("#phone").intlTelInput("setNumber",number);
    });



    $(document).on('submit','#answer_client',function () {

        $('.error_mgs_chat').html('');
        event.preventDefault();
        var self = $('#answer_client');

        $.ajax(self.attr('action'),{
            method: "POST",
            data: self.serialize(),
            dataType: 'JSON',
            success: function(respons) {
                if(respons.status == 'error'){
                    $('.error_mgs_chat').html(respons.message);
                }else if(respons.status == 'success'){
                    var audio = new Audio(window.baseURL+'assets/site/mp3/good.mp3');
                    audio.play();
                    setTimeout('location.reload()',400);
                }else if(respons.status == 'length'){
                    $('.error_mgs_chat').html('<p>You are write wrong text</p>');
                }
            }
        })
    });

    $('.payment_container table').dataTable({
        'pagingType': 'full_numbers',
        responsive: true,
        "oLanguage":
        {
            "oPaginate":
            {
                "sNext": '&gt;',
                "sLast": '&gt;&gt;',
                "sFirst": '&lt;&lt;',
                "sPrevious": '&lt;'
            }
        }
    });
});
