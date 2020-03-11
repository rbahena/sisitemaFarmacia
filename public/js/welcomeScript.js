function goRegister() {
    if ($("#login-form").is(':visible')) {
        $("#login-form").hide();
        $("#register-form").show();
    }
}

function goLogin() {
    if ($("#register-form").is(':visible')) {
        $("#register-form").hide();
        $("#login-form").show();
    }
}

function goResetPassword() {
    if ($("#login-form").is(':visible')) {
        $("#login-form").hide();
        $("#resetPwdEmail-form").show();
    }
}