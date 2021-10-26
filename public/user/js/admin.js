$(document).ready(function() {

	    $(".adverStatusChange").change(function() {
        $("#adverMessage").html('<span class="alert alert-warning">loading...</span>');
        var e = $(this).val();
        $.ajax({
            url: "/admin/advertisementReport/changeStatusReport.jsp/" + e
        }).done(function(e) {
            $("#adverMessage").html('<span class="alert alert-success">Status has been changed</span>'), location.reload()
        })
    })

});