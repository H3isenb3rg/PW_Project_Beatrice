$(document).ready(function() {
    $('#collapseEdit').on('hidden.bs.collapse', function () {
        $('#edit-venue-well').addClass('hidden'); 
        $("#venue-to-edit").val($("#venue-to-edit option:first").val());
    })
});

function fillFields(id, name, city, address, maps) {
    $("#edit-venue-name").val(name);
    $("#edit-venue-city").val(city);
    $("#edit-venue-address").val(address);
    $("#venueID").val(id);
    if (!(maps.trim() === "")) {
        $("#edit-venue-name").val(maps);
    }
}

function showFillForm() {
    var venue_id = $("#venue-to-edit").val();

    $.ajax({

        type: 'GET',

        url: '/ajaxGetVenue',

        data: { venueID: venue_id },

        success: function (data) {
            fillFields(data.id, data.name, data.city, data.address, data.maps);
            $("#edit-venue-well").removeClass("hidden");

            var base_id = "#edit-venue-name";
            venueName_div = $(base_id + "-div");
            venueName_div.removeClass("has-error");
            venueName_msg = $(base_id + "-div .help-block");
            venueName_msg.html("");

            base_id = "#edit-venue-city";
            venueCity_div = $(base_id + "-div");
            venueCity_div.removeClass("has-error");
            venueCity_msg = $(base_id + "-div .help-block");
            venueCity_msg.html("");

            base_id = "#edit-venue-maps";
            venueMaps_div = $(base_id + "-div");
            venueMaps_div.removeClass("has-error");
            venueMaps_msg = $(base_id + "-div .help-block");
            venueMaps_msg.html("");

            base_id = "#edit-venue-address";
            venueAddr_div = $(base_id + "-div");
            venueAddr_div.removeClass("has-error");
            venueAddr_msg = $(base_id + "-div .help-block");
            venueAddr_msg.html("");
        }
    });
}

function checkVenueEdit(lang) {
    var base_id = "#edit-venue-name";
    venueName = $(base_id);
    venueName_div = $(base_id + "-div");
    venueName_div.removeClass("has-error");
    venueName_msg = $(base_id + "-div .help-block");
    venueName_msg.html("");

    base_id = "#edit-venue-city";
    venueCity = $(base_id);
    venueCity_div = $(base_id + "-div");
    venueCity_div.removeClass("has-error");
    venueCity_msg = $(base_id + "-div .help-block");
    venueCity_msg.html("");

    base_id = "#edit-venue-maps";
    venueMaps = $(base_id);
    venueMaps_div = $(base_id + "-div");
    venueMaps_div.removeClass("has-error");
    venueMaps_msg = $(base_id + "-div .help-block");
    venueMaps_msg.html("");

    base_id = "#edit-venue-address";
    venueAddr = $(base_id);
    venueAddr_div = $(base_id + "-div");
    venueAddr_div.removeClass("has-error");
    venueAddr_msg = $(base_id + "-div .help-block");
    venueAddr_msg.html("");

    var error = false;
    var validURL = function (url) {
        var regexp = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
        if (regexp.test(url)) {
            return true;
        } else {
            return false;
        }
    }

    // Static Checks
    if (venueName.val().trim() === "") {
        registerError(venueName_msg, newVenueErrors.name_empty[lang], venueName_div);
        venueName.focus();
        error = true;
    }
    var venueNameValue = venueName.val().trim().toLowerCase();

    if (venueCity.val().trim() === "") {
        registerError(venueCity_msg, newVenueErrors.city_empty[lang], venueCity_div);
        venueCity.focus();
        error = true;
    }
    var venueCityValue = venueCity.val().trim().toLowerCase();

    if (venueAddr.val().trim() === "") {
        registerError(venueAddr_msg, newVenueErrors.addr_empty[lang], venueAddr_div);
        venueAddr.focus();
        error = true;
    }
    var venueAddressValue = venueAddr.val().trim().toLowerCase();

    if (!(venueMaps.val().trim() === "") && !validURL(venueMaps.val().trim())) {
        registerError(venueMaps_msg, newVenueErrors.maps[lang], venueMaps_div);
        venueMaps.focus();
        error = true;
    }

    var venueID = $("#venueID").val();


    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({

        type: 'GET',

        url: '/ajaxEditVenue',

        data: { id: venueID, name: venueNameValue, city: venueCityValue },

        success: function (data) {
            var valid_data = true;

            if (data.found) {
                registerError(venueName_msg, newVenueErrors.not_unique[lang], venueName_div)
                venueName.focus();
                valid_data = false;
            }

            if (valid_data) {
                $('form[name=edit-venue-form]').submit();
            }
        }

    });
}