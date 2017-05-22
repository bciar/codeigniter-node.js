$(document).ready(function(){
    $("#am_sel").change(function(){
        $('#am_inp').val($(this).val())
    })
    $("#addFundsBtn").click(function(){
        $('#addFundsModal').modal('show');
    })
})