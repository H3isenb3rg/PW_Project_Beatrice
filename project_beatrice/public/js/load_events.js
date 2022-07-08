/** @type {boolean} specifies if the server has more events to load */
var has_more = true;

/** @type {string} The ID of the venue to filter by */
var venue_filter = null;

/**
 * Loads events dynamiccally from the server
 *
 * @param {boolean} sync_type True -> Async execution | False -> Sync execution
 */
function load_events(sync_type) {
    // ajax call to get next events data
    $.ajax({

        type: 'GET',

        url: '/ajaxFetchNextEvents',

        data: {
            venue_filter: venue_filter,
            lastLoadedDate: last_loaded_date
        },

        async: sync_type,

        success: function (data) {

            if (parseInt(data.count) > 0) {
                for (well in data.wells) {
                    $("#accordion").append(data.wells[well]);
                }

                if (parseInt(data.count) < 5) {
                    has_more = false;
                    $(window).unbind("scroll");
                } else {
                    last_loaded_date = data.lastLoadedDate;
                }
            } else {
                has_more = false;
                $(window).unbind("scroll");
            }

            $("#loading-div").hide();
        }
    });
}

function filterVenue() {
    venue_filter = $("#venueFilter").val();

    // Svuotare elenco degli eventi
    $("#accordion").html("")

    // Visualizzare icona caricamento
    $("#loading-div").show();

    // Scaricare le prime well degli eventi filtrati
    bind_scroll();
    last_loaded_date = null;
    load_events(false);
}

function bind_scroll() {
    var scrollTimer = null;
    $(window).scroll(function () {
        if (scrollTimer) {
            clearTimeout(scrollTimer); // clear previous timer
        }

        // set timer while we wait for a pause in scroll events
        scrollTimer = setTimeout(function () {
            scrollTimer = null; // timer done here
            if (!$("#loading-div").is(':visible') && (window.innerHeight + Math.ceil(window
                .pageYOffset)) >= document.body.offsetHeight) {
                $("#loading-div").show();
                load_events(true);
            }
        }, 250);
    })
}

$(document).ready(function () {
    // If the window height 
    while (($(document).height() <= $(window).height()) && has_more) {
        load_events(false);
    }
    $("#loading-div").hide();

    bind_scroll();
});