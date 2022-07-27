/* Selectors */
let nameInput = document.getElementById("name");
let shortNameInput = document.getElementById("short-name");
let automaticSlug = document.getElementById("automaticSlug");

/* Listeners */
nameInput.addEventListener("keyup", () => {
    automaticSlug.replaceChildren();
    if (nameInput.value.trim() != "") {
        console.log(nameInput.value);
        generateShortNameOptions(eliminateDiacritic(nameInput.value));
    }
});

/* Functions */
function generateShortNameOptions(eventName) {
    automaticSlug.appendChild(generateLowercaseShortName(eventName));
    automaticSlug.appendChild(generateInitialsWithYearShortName(eventName));
    automaticSlug.appendChild(generateYearShortName(eventName));
    automaticSlug.appendChild(generateOtherOptionShortName());
}

function generateLowercaseShortName(eventName) {
    let div = document.createElement("div");
    let input = document.createElement("input");

    let label = document.createElement("label");
    let slug = eventName
        .toLowerCase()
        .replace(/[^\w ]+/g, "")
        .replace(/ +/g, "-");
    input.setAttribute("type", "radio");
    input.setAttribute("id", "opc1");
    input.setAttribute("name", "shortName");
    input.setAttribute("value", slug);
    label.setAttribute("for", "opc1");
    label.setAttribute("class", "ml-2");
    label.textContent = slug;
    div.appendChild(input);
    div.appendChild(label);
    input.addEventListener("click", () => {
        shortNameInput.value = input.value;
    });
    return div;
}

function generateInitialsWithYearShortName(eventName) {
    let div = document.createElement("div");
    let input = document.createElement("input");
    let label = document.createElement("label");
    let year = new Date().getFullYear();
    let inicialesYear = eventName.match(/\b(\w)/g).join("");
    inicialesYear += year;
    input.setAttribute("type", "radio");
    input.setAttribute("id", "opc2");
    input.setAttribute("name", "shortName");
    input.setAttribute("value", inicialesYear);
    label.setAttribute("for", "opc2");
    label.setAttribute("class", "ml-2");
    label.textContent = inicialesYear;
    div.appendChild(input);
    div.appendChild(label);
    input.addEventListener("click", () => {
        shortNameInput.value = input.value;
    });
    return div;
}

function generateYearShortName(nombreEvento) {
    let div = document.createElement("div");
    let input = document.createElement("input");
    let label = document.createElement("label");
    let year = new Date().getFullYear();
    let cortoYear = year;
    cortoYear +=
        "-" +
        nombreEvento
            .toLowerCase()
            .replace(/[^\w ]+/g, "")
            .replace(/ +/g, "-")
            .split("-")
            .slice(0, 2)
            .join("-");
    //
    input.setAttribute("type", "radio");
    input.setAttribute("id", "opc3");
    input.setAttribute("name", "shortName");
    input.setAttribute("value", cortoYear);
    label.setAttribute("for", "opc3");
    label.setAttribute("class", "ml-2");
    label.textContent = cortoYear;
    div.appendChild(input);
    div.appendChild(label);
    input.addEventListener("click", () => {
        shortNameInput.value = cortoYear;
    });
    return div;
}

function generateOtherOptionShortName() {
    let div = document.createElement("div");
    let input = document.createElement("input");
    let label = document.createElement("label");
    let year = new Date().getFullYear();
    input.setAttribute("type", "radio");
    input.setAttribute("id", "otro");
    input.setAttribute("name", "shortName");
    input.setAttribute("value", "");
    label.setAttribute("for", "otro");
    label.setAttribute("class", "ml-2");
    label.textContent = "Otro: ";
    div.appendChild(input);
    div.appendChild(label);
    input.addEventListener("click", () => {
        shortNameInput.value = input.value;
    });
    return div;
}

function eliminateDiacritic(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}
/* $(document).on("click", ".nombresCortos input:radio", function () {
    if ($(this).attr("id") !== "otro") {
        $("#short-name").prop("readonly", true);
        $("#short-name").prop("disabled", true);
        $("#short-name").val($(this).val());
    } else {
        $("#short-name").prop("readonly", false);
        $("#short-name").prop("disabled", false);
    }
}); */
