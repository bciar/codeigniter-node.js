$(document).ready(function() {
    $('.read-send-message').click(function () {
        alert('Ok');
    });
    $('.btn-box-tool').click(function () {
        $('.direct-chat-warning').toggleClass('direct-chat-contacts-open');
    });

    $(".selectableExpert").on('click',function (event) {
        event.preventDefault();
        $('.direct-chat-warning').removeClass('direct-chat-contacts-open');
        var expertId = $(this).attr('data-expert-id');
        Chat.instance().withExpert(expertId,function (response) {
            $('#message_content').html(response.response.content);
        })
    })
    
    function scroll()
    {
        $("#message_content").animate({ scrollTop: $(document).height() }, "slow");
        return false;
    }
    scroll();
});

var Chat = (function () {
    function Chat() {
    }

    Chat.instance = function () {
        return new Chat();
    };

    Chat.prototype.withExpert = function (expertID,successCallback) {
        $.ajax(window.baseURL+'chat/with-expert/'+expertID,{
            dataType:"JSON",
            method:"GET",
            success:function (response) {
                successCallback(response);
            }
        })
    };
    return Chat;
})();
