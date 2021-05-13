$( document).ready(function() {
    $("#formOT").validate( {
        rules: {
            username: {
                required: true
            },
            dateOT: {
                required: true
            },
            start: {
                required: true
            },
            end: {
                required: true
            },
            work: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please select user name"
            },
            dateOT: {
                required: "Please enter date OT"
            },
            start: {
                required: "Please enter time start"
            },
            end: {
                required: "Please enter time end"
            },
            work: {
                required: "Please enter work OT"
            }
        }
    });
});

$('#start_ot').click(function () {
    if ($('#start').val() === "") {
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes();
        $('#start').val(time);
    } else {
        var cfm = confirm("Are you sure you want to change this time start ?");
        if (cfm == true) {
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes();
            $('#start').val(time);
        } else {
            return false;
        }
    }
});
$('#end_ot').click(function () {
    if ($('#end').val() === "") {
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes();
        $('#end').val(time);
    } else {
        var cfm = confirm("Are you sure you want to change this time end ?");
        if (cfm == true) {
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes();
            $('#end').val(time);
        } else {
            return false;
        }
    }
});
$('.addOT').click(function () {
    if ($('.end-ot').val() < $('.start-ot').val()) {
        var cfm = confirm("The time start more than time end." +
            "You need change this time!");
        if (cfm == true) {
            return false;
        }
    }
});

$('#start, #end').change(function () {
    if (($('#end').val()) != "") {
        if (($('#end').val()) >= ($('#start').val())) {
            $('.error-time').html('');
        } else {
            $('.error-time')
                .html('The end time must be less than the start time')
                .css("color", "#ff0000");
        }
    } else {
        $('.error-time').html('');
    }
});

