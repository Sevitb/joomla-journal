(function () {
    'use strict';
    $(document).ready(function () {
        $(".js-api-data-ajax").select2({
            ajax: {
                method: 'POST',
                url: function () {
                    let method;
                    switch (this[0].name) {
                        case 'jform[region]':
                            method = 'getRegions';
                            break;
                        case 'jform[city]':
                            method = 'getCities';
                            break;
                        case 'jform[organization]':
                            method = 'getUniversities';
                            break;
                    }
                    return `index.php?option=com_jprofile&task=ajax.${method}&format=json`;
                },
                delay: 250,
                headers: {
                    'X-CSRF-Token': Joomla.getOptions("csrf.token")
                },
                data: function (params) {
                    let query = {
                        country_id: $("select[name='jform[country]']").val(),
                        q: params.term,
                    };
                    switch (this[0].name) {
                        case 'jform[city]':
                            query.region_id = $("select[name='jform[region]']").val();
                            break;
                        case 'jform[organization]':
                            query.city_id = $("select[name='jform[city]']").val();
                            break;
                    }
                    return query;
                },
                processResults: function (data) {
                    data = JSON.parse(data.data);
                    let dataObjects = $.map(data, (dataObject) => {
                        dataObject.text = dataObject.title;

                        return dataObject;
                    });
                    return {
                        results: dataObjects
                    };
                },
            },
            minimumInputLength: 1,
            placeholder: {
                id: '',
                text: Joomla.JText._('COM_JPROFILE_SELECT_VALUE')
            }
        });
    });
})();