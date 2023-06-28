(function () {
    $(document).ready(function () {
        $('#adminForm').submit(event => {
            let country = returnObj('country');
            let region = returnObj('region');
            let city = returnObj('city');
            let organization = returnObj('organization');
            
            $(`select[name="jform[country]"] option:selected`).val(JSON.stringify(country));
            $(`select[name="jform[region]"] option:selected`).val(JSON.stringify(region));
            $(`select[name="jform[city]"] option:selected`).val(JSON.stringify(city));
            $(`select[name="jform[organization]"] option:selected`).val(JSON.stringify(organization));
            
        });

        const returnObj = (fieldName) => {
            return {
                id: $(`select[name="jform[${fieldName}]"]`).val(),
                text: $(`select[name="jform[${fieldName}]"] option:selected`).text().trim()
            }
        }

    });
})();