"use strict"

function createField(fieldName, element) {
    let field = document.createElement("input");
    field.setAttribute("type", "text");
    field.setAttribute("class", "form-control valid form-control-success");
    field.setAttribute("name", fieldName);
    field.setAttribute("placeholder", "ФИО");
    field.setAttribute("id", `jform_${fieldName}-${Number(element.previousElementSibling.dataset.inputId) + 1}`);
    field.setAttribute("data-input-id", Number(element.previousElementSibling.dataset.inputId) + 1);
    field.setAttribute("aria-invalid", "false");
    return field;
}

function addField(plusElement) {
    let field;

    if (plusElement.previousElementSibling.name == 'co_author') {
        let controlGroup = document.querySelector("[class='control-group co-author']");

        // Stopping the function if the input field has no value.
        if (plusElement.previousElementSibling.value.trim() === "" || controlGroup.children.length >= 6) {
            return false;
        }

        field = createField('co_author', plusElement);

    } else if (plusElement.previousElementSibling.name == 'reviewer') {
        let controlGroup = document.querySelector("[class='control-group reviewer']");

        // Stopping the function if the input field has no value.
        if (plusElement.previousElementSibling.value.trim() === "" || controlGroup.children.length >= 4) {
            return false;
        }

        field = createField('reviewer', plusElement);
    }

    // creating the div container.
    let div = document.createElement("div");
    div.setAttribute("class", "controls has-success control-group__row");

    // Creating the plus span element.
    let plus = document.createElement("span");
    plus.setAttribute("class", "btn add");
    plus.setAttribute("onclick", "addField(this)");
    let plusIcon = document.createElement("span");
    plusIcon.setAttribute("class", "icon-plus");

    // Creating the minus span element.
    let minus = document.createElement("span");
    minus.setAttribute("class", "btn btn-danger remove");
    minus.setAttribute("onclick", "removeField(this)");
    let minusIcon = document.createElement("span");
    minusIcon.setAttribute("class", "icon-minus");

    // Adding the elements to the DOM.
    plusElement.parentElement.after(div);
    div.appendChild(field);
    div.appendChild(plus);
    plus.appendChild(plusIcon);
    div.appendChild(minus);
    minus.appendChild(minusIcon);

    // Un hiding the minus sign.
    plusElement.nextElementSibling.style.display = "block"; // the minus sign
    // // Hiding the plus sign.
    plusElement.style.display = "none"; // the plus sign
}

function removeField(minusElement) {
    if (!(minusElement.previousElementSibling.style.display == "none")) {
        return false
    }
    minusElement.parentElement.remove();
}

function fetchData(event) {
    const coAuthorInputs = document.querySelectorAll('[id^="jform_co_author-"]');
    const coAuthorsInput = document.getElementById('jform_co_authors');

    const rewieverInputs = document.querySelectorAll('[id^="jform_reviewer-"]');
    const rewieversInput = document.getElementById('jform_reviewers');

    let coAuthorsData = {};
    let reviewersData = {};

    coAuthorInputs.forEach((input, index) => {
        if (!(input.value == "")) {
            coAuthorsData[index - 1] = input.value;
        }
    });

    rewieverInputs.forEach((input, index) => {
        if (!(input.value == "")) {
            reviewersData[index - 1] = input.value;
        }
    });

    coAuthorsInput.value = JSON.stringify(coAuthorsData);
    rewieversInput.value = JSON.stringify(reviewersData);

}