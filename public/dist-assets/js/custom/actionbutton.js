$(document).ready(function () {

    $('.status').on('click', function () {

        var status = $("#status").val();

        $.ajax({
            url:'stand.settings',
            type: 'POST',
            data:{'status': status},
            success: function(data) {
                alert(data);
            }
        });

    })
});
