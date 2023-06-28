(function () {
    'use strict';
    $(document).ready(function () {
        var maxLength = 3;
        var method = 'getAuthors';

        $(".js-author-data").select2({
            ajax: {
                method: 'POST',
                url: function () {
                    let method;
                    switch (this[0].name) {
                        case 'jform[co_authors]':
                            method = 'getAuthors';
                            break;
                        case 'jform[reviewers]':
                            method = 'getReviewers';
                            break;
                    }
                    return `index.php?option=com_jcontent&task=ajax.${method}&format=json`;
                },
                delay: 250,
                headers: {
                    'X-CSRF-Token': Joomla.getOptions("csrf.token")
                },
                data: function (params) {
                    let query = {
                        q: params.term,
                    };
                    return query;
                },
                processResults: function (data) {
                    data = JSON.parse(data.data);
                    return {
                        results: data
                    };
                },
            },
            multiple: true,
            minimumInputLength: 1,
            maximumSelectionLength: maxLength,
            placeholder: {
                id: '',
                text: Joomla.JText._('COM_JPROFILE_SELECT_VALUE')
            }
        });
    });
})();