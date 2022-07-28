/* Selectors */
let nameInput = document.getElementById("name");
let shortNameInput = document.getElementById("short-name");
let automaticOptions = document.getElementById("automaticSlug");

/* Listeners */
nameInput.addEventListener("blur", () => {
    automaticOptions.replaceChildren();
    if (nameInput.value.trim() != "") {
        let automaticOptionsLabel = document.createElement("label");
        automaticOptionsLabel.textContent = "Opciones Automáticas: ";
        automaticOptions.appendChild(automaticOptionsLabel);
        generateShortNameOptions(eliminateDiacritic(nameInput.value));
        automaticOptions.setAttribute("class", "mb-2");
    }
});

/* Functions */
function generateShortNameOptions(eventName) {
    automaticOptions.appendChild(generateInput(eventName, "opt1"));
    automaticOptions.appendChild(generateInput(eventName, "opt2"));
    automaticOptions.appendChild(generateInput(eventName, "op3"));
    automaticOptions.appendChild(generateInput(eventName, "other"));
}

function generateInput(eventName, option) {
    let div = document.createElement("div");
    let input = document.createElement("input");
    let label = document.createElement("label");
    let year = new Date().getFullYear();
    let shortName = "";
    switch (option) {
        case "opt1":
            shortName = eventName
                .toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
            input.setAttribute("value", shortName);
            break;
        case "opt2":
            let eventNameInitials = eventName.match(/\b(\w)/g).join("");
            shortName += eventNameInitials + year;
            input.setAttribute("value", shortName);
            break;
        case "op3":
            shortName +=
                year +
                "-" +
                eventName
                    .toLowerCase()
                    .replace(/[^\w ]+/g, "")
                    .replace(/ +/g, "-")
                    .split("-")
                    .slice(0, 2)
                    .join("-");
            input.setAttribute("value", shortName);
            break;
        case "other":
            shortName += "Otro: ";
            input.setAttribute("value", "");
            break;
        default:
            shortName += "Otro: ";
            input.setAttribute("value", "");
            break;
    }
    input.setAttribute("type", "radio");
    input.setAttribute("id", `${option}`);
    input.setAttribute("name", "shortName");
    label.setAttribute("for", `${option}`);
    label.setAttribute("class", "ml-2");
    label.textContent = shortName;
    div.appendChild(input);
    div.appendChild(label);
    div.setAttribute("class", "ml-4");
    input.addEventListener("click", () => {
        shortNameInput.value = input.value;
        if (input.getAttribute("id") !== "other") {
            shortNameInput.readOnly = true;
        } else {
            shortNameInput.readOnly = false;
        }
    });
    return div;
}

function eliminateDiacritic(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}
