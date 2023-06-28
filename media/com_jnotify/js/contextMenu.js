"use strict"

const contextMenuButtons = document.querySelectorAll(".notification-card__delete-btn");

contextMenuButtons.forEach(button => {
    button.addEventListener('click',()=>{
        deleteMessage();
    });
});

function deleteMessage(){

}