$(document).ready(function() {
    $('#loading').hide();
    mostrarSaludo();

});

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

function mostrarMensaje(messageTitle, messageBody) {
    $("#messageTitleModal").html(messageTitle);
    $("#messageBodyModal").html(messageBody);
    $("#messageModal").modal("show");
};

function mostrarLoading() {
    $('#loading').show();
}