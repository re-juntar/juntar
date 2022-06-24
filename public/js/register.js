$(function () {
    var pais = "";
    var varprovince = "";
    $.ajax({
        type: "GET",
        url: "../json/countries.json",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            let availableTags = new Array();
            data.countries.forEach((countries) => {
                availableTags.push(countries.name);
            });

            console.log(availableTags);

            $("#country").autocomplete({
                minLength: 3,
                source: availableTags,
                classes: {
                    "ui-autocomplete":
                        "bg-fogra-dark text-white-ghost w-20 p-4 rounded",
                },
                select: function (event, ui) {
                    pais = ui.item.label;
                    $("#pais").val(ui.item.label).trigger("change");

                    $.ajax({
                        type: "GET",
                        url: "../json/province.json",
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function (data) {
                            let availableTags = new Array();

                            data.forEach((country) => {
                                if (country.name == pais) {
                                    country.provincias.forEach((estado) => {
                                        availableTags.push(estado.nombre);
                                    });
                                }
                            });

                            $("#province").autocomplete({
                                minLength: 3,
                                source: availableTags,
                                max: 10,
                                classes: {
                                    "ui-autocomplete":
                                        "bg-fogra-dark text-white-ghost w-20 p-4 rounded",
                                },
                                select: function (eve, estado) {
                                    varprovince = estado.item.label;
                                    $.ajax({
                                        type: "GET",
                                        url: "../json/city.json",
                                        contentType:
                                            "application/json; charset=utf-8",
                                        dataType: "json",
                                        success: function (data) {
                                            let availableTags = new Array();

                                            data.forEach((province) => {
                                                if (
                                                    province.nombre ==
                                                    varprovince
                                                ) {
                                                    province.ciudades.forEach(
                                                        (city) => {
                                                            availableTags.push(
                                                                city.nombre
                                                            );
                                                        }
                                                    );
                                                }
                                            });
                                            $("#city").autocomplete({
                                                minLength: 3,
                                                source: availableTags,
                                                max: 10,
                                                classes: {
                                                    "ui-autocomplete":
                                                        "bg-fogra-dark text-white-ghost w-20 p-4 rounded",
                                                },
                                            });
                                        },
                                    });
                                },
                            });
                        },
                    });
                },
            });
        },
    });
});
