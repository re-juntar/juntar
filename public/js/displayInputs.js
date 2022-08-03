jQuery(function () {
    let styles =
        "block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] w-full mb-[1rem]";

    createPreinscriptionDiv();
    createParticipantLimitDiv();

    $("#participant-limit").on("change", function () {
        createParticipantLimitDiv();
    });

    $("#requires-preinscription").on("change", function () {
        createPreinscriptionDiv();
    });

    $("#requires-coorganizer").on("change", function () {
        $("#coorganizer-container").toggleClass("hidden");
    });

    $("#modality").on("change", function (e) {
        createLugarDiv();
    });

    function createParticipantLimitDiv() {
        let div =
            "<x-label for='amount-of-participants'> Ingrese número de participantes * </x-label> <input id='amount-of-participants' class='" +
            styles +
            "' name='amount-of-participants' type='number' min='1'/>";
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

    function createLugarDiv() {
        let lugar =
            "<x-label for='place'> Lugar * </x-label> <input id='place' class='" +
            styles +
            "' name='place' type='text'/>";
        let meet =
            "<x-label for='meet'> Link de reunion * </x-label> <input id='meet' class='" +
            styles +
            "' name='meet' type='text'/>";
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

/**
 * Funcionality for <x-dropdown-multiselect /> called in create-event view
 * @returns multiple objects/functions
 */
function dropdown() {
    return {
        value: "",
        options: [],
        selected: [],
        show: false,
        setValueDefault() {
            this.value = null;
        },
        getValue() {
            return this.value;
        },
        setValue(val) {
            this.value = val;
        },
        open() {
            this.show = true;
        },
        close() {
            this.show = false;
        },
        isOpen() {
            return this.show === true;
        },
        select(id, event) {
            let coorganizers = document.getElementsByClassName("coorganizer");

            // When option from dropdown is selected, save selection on this.selected array
            //  If the options was already selected, unselect it and delete from this.selected array
            if (!this.options[id].selected) {
                if (this.selectedValues().length >= 3) return;

                this.options[id].selected = true;
                this.options[id].element = event.target;
                this.selected.push(id);
                this.setValueDefault();

                // Add selected value to corresponding hidden inputs coorganizer 1/2/3
                this.updateHiddenInputsValue(this.options[id].text);
            } else {
                this.selected.splice(this.selected.lastIndexOf(id), 1);
                this.options[id].selected = false;

                // Set selected value to null on corresponding hidden inputs coorganizer 1/2/3
                this.updateHiddenInputsValue();
            }
        },
        updateHiddenInputsValue(value = null) {
            let coorganizersId = `coorganizer${
                value === null
                    ? this.selectedValues().length + 1
                    : this.selectedValues().length
            }`;

            if (document.getElementById(coorganizersId)) {
                document.getElementById(coorganizersId).value = value;
                console.log(document.getElementById(coorganizersId).value);
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);
        },
        loadOptions() {
            // Gets users
            const usersResponse = $.ajax({
                url: "http://juntar.test/api/users",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    id: $("#hiddenUserId").val(),
                },
            });

            const users = usersResponse.responseJSON;

            // Loads options array with users info to feed the dropdown divs
            for (let i = 0; i < users.length; i++) {
                this.options.push({
                    id: i,
                    value: i + users[i].id,
                    text: users[i].email,
                    selected: false,
                    show: false,
                });
            }

            // If theres {{old('oldCoorganizer1/2/3')}} inputs selected, add them to this.selected array
        },
        selectedValues() {
            return this.selected.map((option) => {
                return this.options[option].value;
            });
        },
        updateUsersList(event) {
            // Only search when a minimum of 3 letters are typed
            if (event.target.value.length < 3) return;

            // On keyup open dropdown in case it closed
            //  set the current value to what was typed
            //  search for results coinciding with that was typed
            this.open();
            this.setValue(event.target.value);
            for (let index = 0; index < this.options.length; index++) {
                let inputOrganizer = event.target.value.toLowerCase();
                let inputLength = inputOrganizer.length;

                let subStringOrganizer = this.options[index].text.substring(
                    0,
                    inputLength
                );
                if (
                    subStringOrganizer.toLowerCase() ==
                    inputOrganizer.toLowerCase()
                ) {
                    this.options[index].show = true;
                } else {
                    this.options[index].show = false;
                }
            }
        },
    };
}
