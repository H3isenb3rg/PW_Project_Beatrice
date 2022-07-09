function update_reservation_count(event_id, modal_id) {
    $.ajax({

        type: 'GET',

        url: '/ajaxUpdateReservationCount',

        data: {
            "_token": '{{ csrf_token() }}',
            "event_id": event_id
        },

        success: function(data) {
            $(modal_id + " #reservations-count").html(data.reservations);
            $(modal_id + " #guests-count").html(data.guests);
        }
    });
}

$(document).ready(function () {
    var loading_svg = $("#reservations-count").html();
    
    $('.modal').on('show.bs.modal', function (e) {
        var modal_id = "#"+e.target.id;

        $(modal_id + " #reservations-count").html(loading_svg);
        $(modal_id + " #guests-count").html(loading_svg);
    })

    $('.modal').on('shown.bs.modal', function (e) {
        var modal_id = "#"+e.target.id;
        var event_id = parseInt(modal_id.replace("#myModal", ""));
        
        update_reservation_count(event_id, modal_id);
    })
})