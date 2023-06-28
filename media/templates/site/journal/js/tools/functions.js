"use strict"

// Remove unnecessary
function removeLoader() {
    window.onload = () => {
        loader.classList.add("load-complete");
        loader.addEventListener('animationend', (e) => {
            if (e.animationName === "fadeout") loader.remove();
        }, { once: true });
    }
}


// Tools functions

// activeElement - elements to check click;
// className - class to add;
// nodeArray - elements to which the class will be added;

function addClassOnClick(activeElement, className, nodesArray = []) {
    if (activeElement) {
        activeElement.addEventListener('click', () => {
            if (nodesArray) {
                nodesArray.forEach((item) => {
                    if (item) {
                        item.classList.toggle(className);
                        return true;
                    }
                });
            } else {
                activeElement.classList.toggle(className);
            }
        });
    } else {
        if (nodesArray) {
            nodesArray.forEach((item) => {
                if (item) {
                    item.classList.toggle(className);
                    return true;
                }
            });
        }
    }
}

// activeElement - elements to check click;
// className - class to remove;
// nodeArray - elements to which the class will be added;

function removeClassOnClick(activeElement, className, nodesArray = []) {
    if (activeElement) {
        activeElement.addEventListener('click', () => {
            if (nodesArray) {
                nodesArray.forEach((item) => {
                    if (item) {
                        item.classList.remove(className);
                        return true;
                    }
                });
            } else {
                activeElement.classList.remove(className);
            }
        });
    }
}

// commonParent - elements to check;
// className - class to delete;
// nodeArray - elements to which the class will be removed;

function clickOutside(commonParent, className, nodesArray) {
    document.addEventListener('click', (event) => {
        let isClickIside = commonParent.contains(event.target);
        if (!isClickIside) {
            if (nodesArray) {
                nodesArray.forEach((item) => {
                    if (item.classList.contains(className)) {
                        item.classList.remove(className);
                    }
                });
            }
        }
    });

}


function getFormData(formElem, options = { hidden: false }) {
    let formId = formElem.attributes.id.value;
    let form = document.forms[formId];
    let data = {};
    Array.from(form).forEach((item) => {
        if (!options.hidden) {
            if (item.type != 'hidden') {
                data[item.name] = item;
            }
        } else {
            data[item.name] = item;
        }
    });
    console.log(data);
    console.log(form);
    formElem.addEventListener('submit', (event) => {
        const formData = new FormData(formElem);
        let data = {}
        formData.forEach((item) => {
            console.log(item);
        });
    });
    return data;
}

export { removeLoader, getFormData, addClassOnClick, removeClassOnClick, clickOutside };