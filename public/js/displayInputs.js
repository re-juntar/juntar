$(document).ready(function () {
    createParticipantLimitDiv();
    createPreinscriptionDiv();
    $(".showCoorganizers").select2({
        placeholder: "Seleccione un Coorganizador",
    });
    let datos = {
        id: 10,
    };

    let usuarios = $.post("http://juntar.test/api/users", datos);
    // console.log(usuarios);

    $("#participant-limit").on("change", function () {
        createParticipantLimitDiv();
    });

    $("#requires-preinscription").on("change", function () {
        createPreinscriptionDiv();
    });

    $(function () {
        console.log(usuarios);
        console.log(usuarios.attr());
        $.each(usuarios.responseJSON, function (i, item) {
            console.log(item.name);
            $("#showCoorganizers").append(`hola`);
        });
    });

    function createParticipantLimitDiv() {
        let div =
            "<x-label for='amount-of-participants'> Ingrese número de participantes * </x-label> <input id='amount-of-participants' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] w-full mb-[1rem]' name='amount-of-participants' type='number' min='1'/>";
        if ($("#si-limite-participantes").is(":checked")) {
            $("#amount-of-participants-container").append(div);
        } else if ($("#no-limite-participantes").is(":checked")) {
            $("#amount-of-participants-container").html("");
        }
    }

    function createPreinscriptionDiv() {
        let div =
            "<x-label for='preinscription-date'> Fecha límite de preinscripción * </x-label> <input id='preinscription-date' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem]' name='preinscription-date' type='date'/>";
        if ($("#yes-preinscription").is(":checked")) {
            $("#preinscription-date-container").append(div);
        } else if ($("#no-preinscription").is(":checked")) {
            $("#preinscription-date-container").html("");
        }
    }
});
