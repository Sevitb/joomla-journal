$(function ($) {
    var storage = getCookie('nav-tabs');

    if (storage && storage[1] !== "#") {

        $('.nav-tabs span[id="' + storage + '"]').tab('show');

    }

    $('ul#userTab li').on('click', function () {

        var id = $(this).find('span.tabs__title.nav-link').attr('id');
        document.cookie = 'nav-tabs=' + id;

    });

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

});