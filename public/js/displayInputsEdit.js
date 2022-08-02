$(document).ready(function () {
    createParticipantLimitDiv();
    displayPreinscriptionDiv();
    createLugarDiv();
    // $(".showCoorganizers").select2({
    //     placeholder: "Seleccione un Coorganizador",
    // });
    let datos = {
        id: $("#id").val(),
    };

    let usuarios = getJsonInfo("http://juntar.test/api/users", datos);
    // console.log(usuarios);
    var styles =
        "block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] w-full mb-[1rem]";

    function getJsonInfo(url, datos) {
        var jsonData = $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            async: false,
            data: datos,
        });
        return jsonData.responseJSON;
    }

    $("#participant-limit").on("change", function () {
        createParticipantLimitDiv();
    });

    $("#requires-preinscription").on("change", function () {
        displayPreinscriptionDiv();
    });

    $("#modality").on("change", function (e) {
        createLugarDiv();
    });

    function createParticipantLimitDiv() {
        let hiddenCapacity = $("#hiddenCapacity").val();
        let div =
            "<x-label for='amount-of-participants'> Ingrese número de participantes * </x-label> <input " +
            (hiddenCapacity != -1 ? "value='" + hiddenCapacity + "' " : "") +
            "id='amount-of-participants' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem] w-full' name='capacity' type='number' min='1'/>";
        if ($("#si-limite-participantes").is(":checked")) {
            $("#amount-of-participants-container").append(div);
        } else if ($("#no-limite-participantes").is(":checked")) {
            $("#amount-of-participants-container").html("");
        }
    }

    function displayPreinscriptionDiv() {
        /* let hiddenDate = $("#hiddenDate").val();
        let div =
            "<x-label for='preinscription-date'> Fecha límite de preinscripción * </x-label> <input id='preinscription-date' value='" +
            hiddenDate +
            "' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem]' name='preinscription_date' type='date'/>"; */
        if ($("#yes-preinscription").is(":checked")) {
            $("#preinscription-date-container").addClass("block");
            $("#preinscription-date-container").removeClass("hidden");
        } else if ($("#no-preinscription").is(":checked")) {
            $("#preinscription-date-container").addClass("hidden");
            $("#preinscription-date-container").removeClass("block");
        }
    }

    function createLugarDiv() {
        let hiddenVenue = $("#hiddenVenue").val();
        let hiddenMeeting = $("#hiddenmeeting").val();
        let lugar =
            "<x-label for='place'> Lugar * </x-label> <input id='place' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem] w-full' " +
            (hiddenVenue != null ? "value='" + hiddenVenue + "' " : "") +
            " name='place' type='text'/>";

        let meet =
            "<x-label for='meet'> Link de reunion * </x-label> <input id='meet' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem] w-full'" +
            (hiddenMeeting != null ? "value='" + hiddenMeeting + "' " : "") +
            "name='meet' type='text'/ >";
        if ($("#modality option:selected").val() == "1") {
            $("#places-container").html("");
            $("#places-container").append(lugar);
        } else if ($("#modality option:selected").val() == "2") {
            $("#places-container").html("");
            $("#places-container").append(meet);
        } else if ($("#modality option:selected").val() == "3") {
            $("#places-container").html("");
            $("#places-container").append(meet);
            $("#places-container").append(lugar);
        } else {
            $("#places-container").html("");
        }
    }
});
