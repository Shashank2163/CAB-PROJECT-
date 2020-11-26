$("#luggage").hide();

function getval(sel) {
    var a = 'CedMicro';
    if (a == sel.value) {
        $('#weight').prop('disabled', true);
        $("#luggage").show();
    } else {
        $('#weight').prop('disabled', false);
        $("#luggage").hide();
    }
}
$(document).ready(function() {
    $("#calculate").show();
    $("#book").hide();
    $("#weight").bind("keypress", function(e) {
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
        }
    });
    $("#luggage").hide();
    $('#message1').hide();
    $('#calculate').click(function() {
        var pickup = $('#current').val();
        var destination = $('#drop').val();
        var cab = $('#cab').val();
        var weight = $('#weight').val();
        if (isNaN(weight)) {
            $("#message").hide();
            return $("#message1").show();
        } else {
            $('#message1').hide();
            $("#message").show();
        }
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {
                pickup: pickup,
                destination: destination,
                cab: cab,
                weight: weight
            },
            success: function(msg) {
                // $("#calculate").hide();
                if (isNaN(msg)) {
                    $("#book").hide();
                    $("#calculate").show();
                    $("#message").html(msg);

                } else {
                    $("#book").show();
                    $("#calculate").show();
                    $("#message").html("Your Fare is :" + msg);
                }

                // $("#message").html(msg);

            }
        });
    });
});