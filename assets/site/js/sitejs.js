var activeUserId = null;

/**
 * Stars in action!
 */
(function() {

    'use strict';

    // SHOP ELEMENT
    var shop = document.querySelector('#shop');

    // DUMMY DATA
    var data = [
        {
            rating: 3
        },
    ];
    var star_rating = 3;

    // INITIALIZE
    (function init() {
        for (var i = 0; i < data.length; i++) {
            addRatingWidget(buildShopItem(data[i]), data[i]);
        }
    })();

    // BUILD SHOP ITEM
    function buildShopItem(data) {
        var shopItem = document.createElement('div');

        var html = '<div class="c-shop-item__img"></div>' +
            '<ul class="c-rating"></ul>' +
            '</div>';

        shopItem.classList.add('c-shop-item');
        shopItem.innerHTML = html;
        shop.appendChild(shopItem);

        return shopItem;
    }

    // ADD RATING WIDGET
    function addRatingWidget(shopItem, data) {
        var ratingElement = shopItem.querySelector('.c-rating');
        var currentRating = data.rating;
        var maxRating = 5;
        var callback = function(rating) {
            star_rating = rating;
        };
        var r = rating(ratingElement, currentRating, maxRating, callback);
    }

    $(document).on('submit','#stars',function () {
        // event.preventDefault();

        var self = $('#stars');
        $.ajax(self.attr('action'),{
            method: "POST",
            data: $(this).serialize() + '&NonFormValue=' + star_rating,
            success:function(respons) {
                var resObj = JSON.parse(respons)
                if(resObj.status == 'error'){
                    alert('Your message is invalid');
                } else if(resObj.status == 'length'){
                    alert('Your message have a wrong');
                } else {
                    alert(respons);
                    $('#starsModal').modal('hide')
                    location.reload()
                }
            }
        })

        return false;
    });

})();

$(document).ready(function() {






    /*--------------------new js----------------*/

    $('#ok').click(function(){
        $('#myModal').modal('hide');
        $('#clientPay').modal('show');
    });

    $('.answer').click(function(){
        $('#expertAnswer').modal('show');

    });

    $(document).on('submit','#delete-msg',function () {
        // event.preventDefault();
        var self = $('#delete-msg');
        $.ajax(self.attr('action'),{
            method: "POST",
            data:self.serialize(),
            success:function() {
                alert("Ok");
                location.href = "http://g-projects.net/aleem/client/messages";
            }
        })

        return false;
    });

    $(document).on('submit','#delete-all-msg',function () {
        // event.preventDefault();
        var self = $('#delete-all-msg');
        $.ajax(self.attr('action'),{
            method: "POST",
            data:self.serialize(),
            success:function() {
                alert("You are successfully deleted that messages");
                location.reload()
            }
        })

        return false;
    });

    $(document).on('submit','#blockExpert',function () {
        // event.preventDefault();
        var self = $('#blockExpert');
        $.ajax(self.attr('action'),{
            method: "POST",
            data:self.serialize(),
            success:function(response) {
                location.reload()
            }
        })

        return false;
    });

    $(document).on('submit','#free_message',function () {
        // event.preventDefault();
        var self = $('#free_message');
        $.ajax(self.attr('action'),{
            method: "POST",
            data:self.serialize(),
            success:function(response) {
                alert(response);
                location.reload()
            }
        })

        return false;
    });

    $(document).on('submit', '#frm_invoice', function () {
        // event.preventDefault();
        var self = $('#frm_invoice');

        $.ajax(self.attr('action'), {
            method: "POST",
            data: self.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    // Invoice sent successfully
                    window.location.href = self.attr('redirect');
                } else {
                    // Invoice not sent successfully
                    console.log(response);
                    alert("An error has been occured while sending the invoice. Please try again later.");
                }
            }
        })

        return false;
    });

    $(document).on('submit', '#pay_invoice_form', function () {
        var self = $('#pay_invoice_form');

        $.ajax(self.attr('action'), {
            method: "POST",
            data: self.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    // Invoice paid successfully
                    window.location.reload();
                } else if (response.status == 'poor') {
                    // Balance not sufficient
                    alert("Your balance is not sufficient. Please add funds to pay the invoice.");
                } else {
                    // Invoice not paid successfully
                    console.log(response);
                    alert("An error has been occured while processing the payment. Please try again later.");
                }
            }
        })

        return false;
    });

    $('#dlg_payinvoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var invoice = button.data('invoice') // Extract info from data-* attributes
        var expert = button.data('expert')

        var modal = $(this);
        modal.find('#invoice_expert').html(button.data('expert_name'));
        modal.find('#invoice_amount').html('$' + button.data('amount'));
        modal.find('#invoice_id').val(invoice);
        modal.find('#expert_id').val(expert);
    });

    $('.withdraw_button').on('click', function() {
        $.ajax(baseURL + 'load_wdform', {
            method: 'post',
            success: function(response) {
                $('#dlg_withdraw .withdraw_container').html(response);
                $('#dlg_withdraw').modal('show');
            }
        });
    });

    $(document).on('click', '#btn_submitWithdraw', function() {
        var amount = $.trim($('#withdraw_amount').val());
        var email = $.trim($('#withdraw_email').val());

        if (!amount || !$.isNumeric(amount)) {
            bootbox.alert('Please enter the withdraw amount correctly.');
            return false;
        }

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!email || !regex.test(email)) {
            bootbox.alert('Please enter correct paypal address.');
            return false;
        }

        $.ajax(baseURL + 'withdraw', {
            method: 'post',
            data: {
                amount: amount,
                email: email,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    bootbox.alert('Withdraw requested successfully');
                    $('#dlg_withdraw').modal('hide');
                    window.location.reload();
                } else if (response.status === 'error') {
                    bootbox.alert(response.message);
                } else {
                    console.log(response);
                    bootbox.alert('There was a problem while requesting withdraw.');
                }
            }
        });

        return false;
    });

    $(document).on('submit','#check_my_payment',function () {
        // event.preventDefault();
        var self = $('#check_my_payment');
        $.ajax(self.attr('action'),{
            method: "POST",
            data:self.serialize(),
            dataType:'JSON',
            success:function(respons) {
                var str = "<tr><td>N</td><td>Top up</td><td>Pay</td><td>Date</td></tr>";
                var top_up = 0;
                var pay = 0;
                var account;
                var spend = 0;
                for(var k in respons) {
                    i = +k+1;
                    if(respons[k].type =="top_up"){
                        top_up+=parseFloat(respons[k].amount);
                        str += "<tr  class='success'>"+
                            "<td>"+i+"</td>"+
                            "<td>"+respons[k].amount+"$</td>"+
                            "<td>-</td>"+
                            "<td>"+respons[k].date+"</td>"+
                            "</tr>"

                    }else if(respons[k].type =="pay"){
                        pay+=parseFloat(respons[k].amount);
                        str += "<tr class='warning'> "+
                            "<td>"+i+"</td>"+
                            "<td>-</td>"+
                            "<td>"+respons[k].amount+"$</td>"+
                            "<td>"+respons[k].date+"</td>"+
                            "</tr>";
                        if(respons[k].spend == 1){
                            spend += parseFloat(respons[k].amount);
                        }
                    }
                }
                account = top_up - pay;
                str += "<tr><td>Total</td><td>"+top_up+"</td><td>"+pay+"</td><td></td></tr>";
                str += "<tr><td>Spend message</td><td>"+spend+"</td><td></td></tr>";
                str += "<tr><td>Account total</td><td>"+account+"</td><td></td></tr>";
                $('.table').html(str);
            }
        })

        return false;
    });

    $(document).on('submit','#check_expert_payment',function () {
        // event.preventDefault();
        var self = $('#check_expert_payment');

        $.ajax(self.attr('action'), {
            method: "POST",
            data: self.serialize(),
            dataType: 'JSON',
            success: function(respons) {
                var str = "<tr><td>Transaction</td><td>Pay/Payout</td><td>Date</td></tr>";
                var pay_in_message = 0;
                var pay = 0;
                for(var k in respons) {
                    i = +k+1;
                    if (respons[k].type =="pay" || 1) {
                        pay+=parseFloat(respons[k].amount);
                        str += "<tr class='warning'> "+
                            "<td>"+i+"</td>"+
                            "<td class='text-green'>"+respons[k].amount+"$</td>"+
                            "<td>"+respons[k].date+"</td>"+
                            "</tr>";
                        if (respons[k].spend == 1) {
                            pay_in_message += parseFloat(respons[k].amount);
                        }
                    }
                }
                str += "<tr><td>Total</td><td class='text-green'>"+pay+"</td><td></td></tr>";
                str += "<tr><td>Your earned in message</td><td class='text-green'>"+pay_in_message+"</td><td></td></tr>";
                str += "<tr><td>Your earned</td><td class='text-green'>"+pay/2+"</td><td></td></tr>";
                str += "<tr><td>Withdraw </td><td class='text-green'>"+'-'+"</td><td></td></tr>";
                $('.table').html(str);
            }
        })

        return false;
    });
    //
    // $(document).on('click', '#view_more', function () {
    //     $.ajax({
    //         url: 'history/ajax',
    //         method: "GET",
    //         success:function(response) {
    //             console.log(response);
    //             var str = "";
    //             document.getElementById('load_more_content').innerHTML = str;
    //         }
    //     })
    // });

    var unread = $('#unread_value').val();
        if(unread !== undefined && unread == 1){
            var audio = new Audio(window.baseURL+'assets/site/mp3/good.mp3');
            audio.play();
        }

    /* Start Messages */

    if ($('#messages_container').length) {
        // messages page
        loadMessages();

        $(document).on('click', '.view-previous', function() {
            loadMessages(parseInt($(this).parent().data('page')) - 1, $('#mail_query').val())
        });

        $(document).on('click', '.view-next', function() {
            loadMessages(parseInt($(this).parent().data('page')) + 1, $('#mail_query').val())
        });

        $(document).on('click', '.btn-refresh', function() {
            loadMessages()
        });

        $(document).on('click', '.btn-delete', function() {
            bootbox.confirm("Are you sure to delete selected messages?", function(result) {
                if (!result) return;

                $.ajax($('#messages_container').data('url') + 'expert/messages/delete', {
                    method: "POST",
                    data: $('#mails_form').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            loadMessages();
                        } else {
                            console.log(response);
                        }
                    }
                })
            })
        });

        //Enable check and uncheck all functionality
        $(document).on('click', '.checkbox-toggle', function() {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

    }

    /* End Messages */

});

/* Start Messages */

/**
 * load inbox messages
 * @param page
 * @param search
 */
function loadMessages(page, search)
{
    $.ajax($('#messages_container').data('url') + 'load-messages', {
        method: "POST",
        data: {
            perpage: 10,
            page: page,
            search: search,
        },
        success: function(response) {
            $('#messages_container').html(response);

            $("time.timeago").timeago();
            // $('.mailbox-date').each(function() {
            //     // convert using timeago
            //     $(this).html($.timeago($(this).html()))
            // });

            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('.mailbox-messages input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-pink',
                radioClass: 'iradio_flat-pink'
            });
        }
    })
}

var updateExpertName = function(sel) {
    activeUserId = sel.options[sel.selectedIndex].value;
    $('#expert_name').val(sel.options[sel.selectedIndex].text);
}

/* End Messages */
