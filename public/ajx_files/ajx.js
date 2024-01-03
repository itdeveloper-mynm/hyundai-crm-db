
$('#city_id').change(function() {
    var selectedCity = $(this).val();
    // Make AJAX request to fetch branches based on the selected city
    $.ajax({
        url: '/get-branches/' + selectedCity,
        type: 'GET',
        success: function(data) {
            // Populate the branches select box with the fetched data
            var branchesSelect = $('#branch_id');
            branchesSelect.empty();
            // Append the default option
            branchesSelect.append('<option value="">--select--</option>');


            $.each(data, function(key, value) {
                branchesSelect.append('<option value="' + value.id + '">' + value.name +
                    '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
