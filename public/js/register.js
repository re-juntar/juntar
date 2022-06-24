$(function () {
    var pais ="";
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
                    "ui-autocomplete": "bg-white-ghost w-20"
                },
                select: function (event, ui) {
                    pais =ui.item.label;                 
                    $('#pais').val(ui.item.label).trigger('change');

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
                                    "ui-autocomplete": "bg-white-ghost w-20"
                                },
                                select: function(eve, estado){
                                    varprovince =estado.item.label; 
                                    $.ajax({
                                        type: "GET",
                                        url: "../json/city.json",
                                        contentType: "application/json; charset=utf-8",
                                        dataType: "json",
                                        success: function (data) {
                                            let availableTags = new Array();
                                            
                                            data.forEach((province) => {
                                                if (province.nombre == varprovince) { 
                                                    province.ciudades.forEach((city) => {
                                                        availableTags.push(city.nombre);
                                                    });
                                                }
                                            });
                                            $("#city").autocomplete({
                                                minLength: 3,
                                                source: availableTags,
                                                max: 10,
                                                classes: {
                                                    "ui-autocomplete": "bg-white-ghost w-20"
                                                } 
                                            });
                                        }
                                    });
                                } 
                            });
                        }
                    });
                }
            });
        }
    });
});



/* function autocompleteProvincias(nombrePais) {
    $.ajax({
        url: "/site/buscar-provincias",
        data: {pais: nombrePais},
        type: "POST",
        dataType: "json"
    })
    .done(function (data) {
    //console.log(data);
        if (data !== null) {
            if ($("#signupform-provincia").autocomplete !== undefined) {
                $("#signupform-provincia").autocomplete({
                    autoFill: true,
                    minLength: "3",
                    source: data,
                    select: function (event, ui) {
                        $("#signupform-provincia").val(ui.item.id);
                    },
                    change: function () {
                        autocompleteLocalidades($("#signupform-provincia").val());
                    }
                });
            }
        }
    });
} */