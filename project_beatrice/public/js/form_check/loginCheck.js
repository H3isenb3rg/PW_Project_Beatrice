var loginErrors = {
    username_empty: {
        en: "Please insert username",
        it: "Inserire nome utente"
    },
    password_empty: {
        en: "Please insert your password",
        it: "Inserire la password"
    },
    not_auth: {
        en: "Invalid username or password.",
        it: "Nome Utente o password non corretti."
    }
}

function checkLogin(lang) {
    username = $("#username");
    username_div = $("#username_div");
    username_div.removeClass("has-error");
    username_msg = $("#username_div .help-block");
    username_msg.html("");

    password = $("#password");
    password_div = $("#password_div");
    password_div.removeClass("has-error");
    password_msg = $("#password_div .help-block");
    password_msg.html("");

    var error = false;

    // Static Checks
    if (username.val().trim() === "") {
        registerError(username_msg, loginErrors.username_empty[lang], username_div)
        username.focus();
        error = true;
    }
    var usernameValue = username.val().trim();

    if (password.val().trim() === "") {
        registerError(password_msg, loginErrors.password_empty[lang], password_div)
        password.focus();
        error = true;
    }
    var passwordValue = password.val().trim();

    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({

        type: 'GET',

        url: '/user/ajaxLogin',

        data: { username: usernameValue, password: passwordValue },

        success: function (data) {
            valid_data = true;
            
            if (!data.valid) {
                registerError(username_msg, loginErrors.not_auth[lang], username_div)
                username.focus();
                valid_data = false;
            }

            console.log($("#link-home").attr("href"));

            if (valid_data) {
                $('form[name=login-form]').submit();
            }
        }

    });
}

function registerError(msg_element, msg, div) {
    msg_element.html(msg);
    div.addClass("has-error");
}