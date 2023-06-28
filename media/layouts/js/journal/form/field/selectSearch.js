(function () {
    'use strict';
    $(document).ready(function () {
        $(".js-api-data").select2({
            placeholder: {
                id: '',
                text: Joomla.JText._('COM_JPROFILE_SELECT_VALUE')
            }
        });
    });
})();