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

function mostrarSaludo() {
    fecha = new Date();
    hora = fecha.getHours();

    if (hora >= 0 && hora < 12) {
        texto = "Buen día";
    }

    if (hora >= 12 && hora < 18) {
        texto = "Buena tarde";
    }

    if (hora >= 18 && hora < 24) {
        texto = "Buena noche";
    }
    if ($("#txtsaludo").length > 0 && texto != 'undefined' && texto != null) {
        document.getElementById('txtsaludo').innerHTML = texto;
    }
}