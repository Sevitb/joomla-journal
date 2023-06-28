(function () {
    $(document).ready(function () {
        processLinks();

        function sendRequest(event) {
            event.preventDefault();
            $.ajax({
                url: $(event.target).attr('href'),
                method: 'GET',
                beforeSend: function () {
                    $(`#${event.target.closest(".tab-pane").id}`)
                        .prepend(`<div id="loader">
                                        <div class="justify-content-center jimu-primary-loading"></div>
                                  </div>`);
                }
            }).done((data) => {
                let list = $(data).find(`#${event.target.closest(".tab-pane").id}`);
                if (!list.hasClass('active') && $(`#${event.target.closest(".tab-pane").id}`).hasClass('active')) {
                    list.addClass('active').addClass('show');
                }
                $(`#${event.target.closest(".tab-pane").id}`).replaceWith(list);
                processLinks(`#${event.target.closest(".tab-pane").id}`);
            });
        }

        function addOnClickListener() {
            if (this.hasAttribute('href') && $(this).attr('href') != '#') {
                $(this).on('click',sendRequest);
            }
        }

        function processLinks(parent) {
            if (!parent) {
                $('.page-link').each(addOnClickListener);
            } else {
                $(parent).find('.page-link').each(addOnClickListener);
            }
        }
    });
})();