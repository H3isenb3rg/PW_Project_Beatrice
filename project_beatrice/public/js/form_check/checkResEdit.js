var resEditError = {
    table_name_empty: {
        en: "Please insert a table name",
        it: "Inserire un nome per la prenotazione"
    },
    guests_empty: {
        en: "Please insert a guests number",
        it: "Inserire un numero di persone"
    },
    guestsFull: {
        en: "Max capacity reached. Available seats: ",
        it: "Capacità massima raggiunta. Posti ancora disponibili: "
    },
    invalid_table_name: {
        en: "Name already in use. Choose a different name",
        it: "Nome già in uso. Scegliere un nome diverso"
    }
}

function checkResEdit(lang) {
    table_name = $("#table_name");
    table_name_div = $("#table_name_div");
    table_name_div.removeClass("has-error");
    table_name_msg = $("#table_name_div .help-block");
    table_name_msg.html("");

    guests = $("#guests");
    guests_div = $("#guests_div");
    guests_div.removeClass("has-error");
    guests_msg = $("#guests_div .help-block");
    guests_msg.html("");

    reservation_id = $("#resID").val().trim();

    var error = false;

    // Static Checks
    if (table_name.val().trim() === "") {
        registerError(table_name_msg, resEditError.table_name_empty[lang], table_name_div)
        table_name.focus();
        error = true;
    }
    var table_nameValue = table_name.val().trim();

    if (guests.val().trim() === "") {
        registerError(guests_msg, resEditError.guests_empty[lang], guests_div)
        guests.focus();
        error = true;
    }
    var guestsValue = parseInt(guests.val().trim());

    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({

        type: 'GET',

        url: '/ajaxEditReservation',

        data: { reservation_id: reservation_id, table_name: table_nameValue, guests: guestsValue },

        success: function (data) {
            valid_data = true;
            
            if (data.validGuests>=0) {
                registerError(guests_msg, resEditError.guestsFull[lang] + " " + data.validGuests, guests_div);
                guests.focus();
                valid_data = false;
            }

            if (!data.validName) {
                registerError(table_name_msg, resEditError.invalid_table_name[lang], table_name_div);
                table_name.focus();
                valid_data = false;
            }

            if (valid_data) {
                $('form[name=reservation]').submit();
            }
        }

    });
}

function registerError(msg_element, msg, div) {
    msg_element.html(msg);
    div.addClass("has-error");
}