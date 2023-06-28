(function () {
    $(document).ready(function () {

        function saveValueToInput(inputName) {
            $(`input[name="jform[${inputName}]"]`).val(
                JSON.stringify(
                    $(`select[name="jform[${inputName}]"]`).val().map((id) => {
                        return {
                            id: id
                        }
                    })
                )
            );
        }

        $('[name="adminForm"]').submit((event) => {
            saveValueToInput('co_authors');
            saveValueToInput('reviewers');
        });
    });
})();