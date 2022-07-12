var newVenueErrors = {
    name_empty: {
        en: "The venue name field is required",
        it: "Il campo nome del luogo non può essere vuoto"
    },
    city_empty: {
        en: "The city of the venue is required",
        it: "Il campo città del luogo non può essere vuoto"
    },
    addr_empty: {
        en: "The address of the Venue field is required",
        it: "L'indirizzo del luogo non può essere vuoto"
    },
    maps: {
        en: "The given link is not valid",
        it: "Il link inserito non è valido"
    },
    not_unique: {
        en: "A venue with this name already exists in the same city",
        it: "Un luogo con questo nome esiste già nella città inserita"
    }
}

function checkVenue(lang) {
    venueName = $("#venue-name");
    venueName_div = $("#venue-name-div");
    venueName_div.removeClass("has-error");
    venueName_msg = $("#venue-name-div .help-block");
    venueName_msg.html("");

    venueCity = $("#venue-city");
    venueCity_div = $("#venue-city-div");
    venueCity_div.removeClass("has-error");
    venueCity_msg = $("#venue-city-div .help-block");
    venueCity_msg.html("");

    venueMaps = $("#venue-maps");
    venueMaps_div = $("#venue-maps-div");
    venueMaps_div.removeClass("has-error");
    venueMaps_msg = $("#venue-maps-div .help-block");
    venueMaps_msg.html("");

    venueAddr = $("#venue-address");
    venueAddr_div = $("#venue-address-div");
    venueAddr_div.removeClass("has-error");
    venueAddr_msg = $("#venue-address-div .help-block");
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
        registerError(venueName_msg, newVenueErrors.name_empty[lang], venueName_div)
        venueName.focus();
        error = true;
    }
    var venueNameValue = venueName.val().trim().toLowerCase();

    if (venueCity.val().trim() === "") {
        registerError(venueCity_msg, newVenueErrors.city_empty[lang], venueCity_div)
        venueCity.focus();
        error = true;
    }
    var venueCityValue = venueCity.val().trim().toLowerCase();

    if (venueAddr.val().trim() === "") {
        registerError(venueAddr_msg, newVenueErrors.addr_empty[lang], venueAddr_div)
        venueAddr.focus();
        error = true;
    }

    if (!(venueMaps.val().trim() === "") && !validURL(venueMaps.val().trim())) {
        registerError(venueMaps_msg, newVenueErrors.maps[lang], venueMaps_div)
        venueMaps.focus();
        error = true;
    }


    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({

        type: 'GET',

        url: '/ajaxNewVenue',

        data: { name: venueNameValue, city: venueCityValue },

        success: function (data) {
            var valid_data = true;
            console.log(data);
            if (data.found) {
                registerError(venueName_msg, newVenueErrors.not_unique[lang], venueName_div)
                venueName.focus();
                valid_data = false;
            }

            if (valid_data) {
                $('form[name=venue-form]').submit();
            }
        }

    });
}

function checkVenueEdit(lang) {
    // TODO: depends from the form
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
        registerError(venueName_msg, newVenueErrors.name_empty[lang], venueName_div)
        venueName.focus();
        error = true;
    }
    var venueNameValue = venueName.val().trim().toLowerCase();

    if (venueCity.val().trim() === "") {
        registerError(venueCity_msg, newVenueErrors.city_empty[lang], venueCity_div)
        venueCity.focus();
        error = true;
    }
    var venueCityValue = venueCity.val().trim().toLowerCase();

    if (venueAddr.val().trim() === "") {
        registerError(venueAddr_msg, newVenueErrors.addr_empty[lang], venueAddr_div)
        venueAddr.focus();
        error = true;
    }

    if (!(venueMaps.val().trim() === "") && !validURL(venueMaps.val().trim())) {
        registerError(venueMaps_msg, newVenueErrors.maps[lang], venueMaps_div)
        venueMaps.focus();
        error = true;
    }


    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({

        type: 'GET',

        url: '/ajaxEditVenue',

        data: { name: venueNameValue, city: venueCityValue },

        success: function (data) {
            var valid_data = true;
            console.log(data);
            if (data.found) {
                registerError(venueName_msg, newVenueErrors.not_unique[lang], venueName_div)
                venueName.focus();
                valid_data = false;
            }

            if (valid_data) {
                $('form[name=venue-form]').submit();
            }
        }

    });
}