(function () {
    $(document).ready(function () {
        $('#adminForm').submit(event => {
            $(`input[name="jform[name]"]`).val($(`input[name="jform[firstname]"]`).val());
        });
    });
})();