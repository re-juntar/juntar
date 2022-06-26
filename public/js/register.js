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

            //console.log(availableTags);
            // cuando se presional a tercera tecla busca los paises que coincidan
            $("#country").autocomplete({
                minLength: 3,
                source: availableTags,
                classes: {
                    "ui-autocomplete":
                        "bg-fogra-dark text-white-ghost w-20 p-4 rounded",
                },
                // una vez seleccionado el pais busco las provincias
                select: function (event, ui) {
                    pais = ui.item.label;

                    $.ajax({
                        type: "GET",
                        url: "../json/province.json",
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function (data) {
                            let availableTags = new Array();
                            // recorro el arreglo de paises y luego en cada provincia recorro para anexar los nombres de la provincia
                            data.forEach((country) => {
                                if (country.name == pais) {
                                    country.provincias.forEach((estado) => {
                                        availableTags.push(estado.nombre);
                                    });
                                }
                            });

                            $("#province").autocomplete({
                                minLength: 2,
                                source: availableTags,
                                max: 10,
                                classes: {
                                    "ui-autocomplete":
                                        "bg-fogra-dark text-white-ghost w-20 p-4 rounded",
                                },
                                // una vez seleccionado la provincia busco las ciudades                                
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
                                            // recorro el arreglo de provincias y luego en cada provincia recorro para anexar los nombres de las ciudades
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
                                                minLength: 2,
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
