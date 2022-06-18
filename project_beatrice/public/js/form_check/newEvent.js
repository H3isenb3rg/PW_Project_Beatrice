var newEventErrors = {
    name_empty: {
        en: "The event name field is required",
        it: "Il campo nome dell'evento non può essere vuoto"
    },
    desc_empty: {
        en: "The event description field is required",
        it: "Il campo descrizione dell'evento non può essere vuoto"
    },
    date: {
        en: "Insert a valid Date",
        it: "Inserire una data valida"
    },
    past_date: {
        en: "The date event must be today or in the future",
        it: "La data dell'evento deve essere oggi o nel futuro"
    },
    guests: {
        en: "Guests number must be a number between 0(no guests limit) and 999",
        it: "Il numero di posti disponibile deve essere compreso tra 0(nessun limite di posti) e 999"
    },
    invalid_venue: {
        en: "Venue not found",
        it: "Luogo non trovato"
    },
    empty_venue: {
        en: "Venue field is required",
        it: "Il campo luogo è obbligatorio"
    },
    not_unique: {
        en: "There is already an event programmed on this day",
        it: "Esiste già un evento in questa data"
    }
}

$(document).ready(function() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    $("#event-date").attr("min", today);
});

function checkEvent(lang) {
    eventName = $("#event-name");
    eventName_div = $("#event-name-div");
    eventName_div.removeClass("has-error");
    eventName_msg = $("#event-name-div .help-block");
    eventName_msg.html("");

    eventDesc = $("#event-description");
    eventDesc_div = $("#event-description-div");
    eventDesc_div.removeClass("has-error");
    eventDesc_msg = $("#event-description-div .help-block");
    eventDesc_msg.html("");

    eventDate = $("#event-date");
    eventDate_div = $("#event-date-div");
    eventDate_div.removeClass("has-error");
    eventDate_msg = $("#event-date-div .help-block");
    eventDate_msg.html("");

    eventGuests = $("#event-guests");
    eventGuests_div = $("#event-guests-div");
    eventGuests_div.removeClass("has-error");
    eventGuests_msg = $("#event-guests-div .help-block");
    eventGuests_msg.html("");

    eventVenue = $("#event-venue");
    eventVenue_div = $("#event-venue-div");
    eventVenue_div.removeClass("has-error");
    eventVenue_msg = $("#event-venue-div .help-block");
    eventVenue_msg.html("");

    var error = false;

    // Static Checks
    if (eventName.val().trim() === "") {
        registerError(eventName_msg, newEventErrors.name_empty[lang], eventName_div)
        eventName.focus();
        error = true;
    }
    eventNameValue = eventName.val().trim().toLowerCase();

    if (eventDesc.val().trim() === "") {
        registerError(eventDesc_msg, newEventErrors.desc_empty[lang], eventDesc_div)
        eventDesc.focus();
        error = true;
    }

    if (isNaN(Date.parse(eventDate.val()))) {
        registerError(eventDate_msg, newEventErrors.date[lang], eventDate_div)
        eventDate.focus();
        error = true;
    } else if (new Date(eventDate.val()).getTime() < new Date().getTime()) {
        registerError(eventDate_msg, newEventErrors.past_date[lang], eventDate_div)
        eventDate.focus();
        error = true;
    }
    eventDateValue = eventDate.val();

    if (!(eventGuests.val().trim() === "") &&
        (isNaN(parseInt(eventGuests.val())) || parseInt(eventGuests.val()) < 0 || parseInt(eventGuests.val()) > 999)) {
        registerError(eventGuests_msg, newEventErrors.guests[lang], eventGuests_div)
        eventGuests.focus();
        error = true;
    }

    if (!eventVenue.val() || eventVenue.val().trim() === "") {
        registerError(eventVenue_msg, newEventErrors.empty_venue[lang], eventVenue_div)
        eventVenue.focus();
        error = true;
    }


    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({
        type: 'GET',

        url: '/ajaxNewEvent',

        data: {
            venue: eventVenue.val().trim().toLowerCase(),
            event_date: eventDateValue
        },

        success: function (data) {
            var valid_data = true;

            if (!data.venue_valid) {
                registerError(eventVenue_msg, newEventErrors.invalid_venue[lang], eventVenue_div)
                eventVenue.focus();
                valid_data = false;
            }

            if (!data.unique) {
                registerError(eventDate_msg, newEventErrors.not_unique[lang], eventDate_div)
                eventDate.focus();
                valid_data = false;
            }

            if (valid_data) {
                $('form[name=event-form]').submit();
            }
        }
    });
}

function registerError(msg_element, msg, div) {
    msg_element.html(msg);
    div.addClass("has-error");
}