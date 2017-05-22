$(function () {
    var BaseUrl = window.location.protocol + "//" + window.location.host + "/"

    $('.delete_expert').click(function () {

        var id = $(this).find('input').val();

        var del = $(this);

        swal({
                title: "Are you sure?",
                text: "You Want Delete User!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {

                $.post(BaseUrl + 'aleem/admin/deleteUser', {id: id}, function (response) {

                }, 'json').done(function () {

                    del.parents('tr').remove();

                    swal("Good job!", "User Deleted!", "success");
                });

                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
    });

    $('.delete_categories').click(function () {
        var id = $(this).find('input').val();
        var del = $(this);
        swal({
                title: "Are you sure?",
                text: "You Want Delete Category!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {

                $.post(BaseUrl + 'aleem/admin/categories/delete', {id: id}, function (response) {

                }, 'json').done(function () {
                    del.parents('tr').remove();
                    swal("Good job!", "User Deleted!", "success");
                });

                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });

    });
    if (!$("body").hasClass("alert-success")) {
        setTimeout(function () {
            $('.alert-success').slideUp('600');
        }, 4000);
    }
});

