"use strict"

window.onload = () => {

    let new_scroll_position = 0;
    let last_scroll_position;
    const header = document.getElementById("header");

    document.getElementById("page-wrapper").style.paddingTop = header.offsetHeight + "px";

    window.addEventListener('scroll', function (e) {
        last_scroll_position = window.scrollY;

        // Scrolling down
        if (new_scroll_position < last_scroll_position && last_scroll_position > 80) {
            // header.removeClass('slideDown').addClass('slideUp');
            header.classList.remove("header_slideDown");
            header.classList.add("header_slideUp");

            // Scrolling up
        } else if (new_scroll_position > last_scroll_position) {
            // header.removeClass('slideUp').addClass('slideDown');
            header.classList.remove("header_slideUp");
            header.classList.add("header_slideDown");
        }

        new_scroll_position = last_scroll_position;
    });

    new ResizeObserver(() => {
        document.getElementById("page-wrapper").style.paddingTop = header.offsetHeight + "px";
    }).observe(header)
}