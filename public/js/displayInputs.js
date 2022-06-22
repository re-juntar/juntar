jQuery(function () {
    createParticipantLimitDiv();
    createPreinscriptionDiv();
    // $(".showCoorganizers").select2({
    //     placeholder: "Seleccione un Coorganizador",
    // });
    let datos = {
        id: $("#id").val(),
    };


    let usuarios = getJsonInfo("http://juntar.test/api/users", datos);
    // console.log(usuarios);
    var stlyes = "block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] w-full mb-[1rem]";

    function getJsonInfo(url, datos) {
        var jsonData = $.ajax({
            url: url,
            method: "POST",
            dataType: 'json',
            async: false,
            data: datos
        });
        return jsonData.responseJSON;
    }


    $("#participant-limit").on("change", function () {
        createParticipantLimitDiv();
    });

    $("#requires-preinscription").on("change", function () {
        createPreinscriptionDiv();
    });

    $("#requires-coorganizer").on("change", function () {
        createCoorganizerDiv();
        $("#coorganizer").on('keyup', function () {
            $('#coorganizersList').html("<option disabled selected>Seleccione</option>");
            if (this.value.length >= 3) {
                let organizers;
                let inputOrganizer = this.value;
                $.each(usuarios, function (i, item) {
                    let longitudInput = inputOrganizer.length;
                    let subStringOrganizer = item.name.substring(0, longitudInput);
                    if (subStringOrganizer.toLowerCase() == inputOrganizer) {
                        organizers += `<option value="${item.id}">${item.name}</option>`;
                    }
                });
                $("#coorganizersList").append(organizers);
            }
        });

        $("#coorganizersList").on("change", function () {
            let i = 0;
            let encontrado = false;
            let nombre = "";
            while (i < usuarios.length && !encontrado) {
                if (usuarios[i]['id'] == this.value) {
                    encontrado = true;
                    nombre = usuarios[i]['name'];
                }
                ++i;
            }
            let coorganizersSelected = $(".selected-coorganizers").length;
            console.log(coorganizersSelected);
            if (coorganizersSelected < 3) {
                if (coorganizersSelected == 0) {
                    let div = `<div id="actual-coorganizers">\n<input hidden name="coorganizer1" value="${this.value}"></input>\n<input disabled class="selected-coorganizers" name="coorganizer1-name">${nombre}</input>\n</div>`;
                    console.log(div);
                    $("#coorganizer-container").append(div);
                } else {
                    let input = `<input hidden name="coorganizer${coorganizersSelected + 1}" value="${this.value}"></input>\n<input disabled class="selected-coorganizers" name="coorganizer1-name">${nombre}</input>`;
                    console.log(input);
                    $("#actual-coorganizers").append(input);
                }
            }
        });
    });

    // let coorganizersList = document.getElementById('coorganizersList');
    // console.log(coorganizersList);
    // coorganizersList.addEventListener('change', function() {});



    $("#modality").on("change", function (e) {
        createLugarDiv();
    });

    function createParticipantLimitDiv() {
        let div =
            "<x-label for='amount-of-participants'> Ingrese número de participantes * </x-label> <input id='amount-of-participants' class='" + stlyes + "' name='amount-of-participants' type='number' min='1'/>";
        if ($("#si-limite-participantes").is(":checked")) {
            $("#amount-of-participants-container").append(div);
        } else if ($("#no-limite-participantes").is(":checked")) {
            $("#amount-of-participants-container").html("");
        }
    }

    function createPreinscriptionDiv() {
        let div =
            "<x-label for='preinscription-date'> Fecha límite de preinscripción * </x-label> <input id='preinscription-date' class='" + stlyes + "' name='preinscription-date' type='date'/>";
        if ($("#yes-preinscription").is(":checked")) {
            $("#preinscription-date-container").append(div);
        } else if ($("#no-preinscription").is(":checked")) {
            $("#preinscription-date-container").html("");
        }
    }

    function createCoorganizerDiv() {
        let div =
            "<x-label for='coorganizer'> Ingrese Nombre del Coorganizador * </x-label> <input id='coorganizer' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem] w-full' name='coorganizer' type='text'/><select class='block mt-1 w-full border-[#ced4da] rounded-[0.375rem]' placeholder='Seleccione' name='coorganizersList' id='coorganizersList'><option disabled selected>Seleccione</option></select>";
        if ($("#yes-coorganizer").is(":checked")) {
            $("#coorganizer-container").append(div);
        } else if ($("#no-coorganizer").is(":checked")) {
            $("#coorganizer-container").html("");
        }
    }

    function createLugarDiv() {

        let lugar = "<x-label for='place'> Lugar * </x-label> <input id='place' class='" + stlyes + "' name='place' type='text'/>";
        let meet = "<x-label for='meet'> Link de reunion * </x-label> <input id='meet' class='" + stlyes + "' name='meet' type='text'/>";
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

// called by create-event to multiselect coorganizersList
function dropdown() {
    return {
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event) {
            if (!this.options[index].selected) {

                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);

            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);


        },
        loadOptions() {
            const options = document.getElementById('select').options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                });
            }
        },
        selectedValues() {
            return this.selected.map((option) => {
                return this.options[option].value;
            })
        }
    }
}
