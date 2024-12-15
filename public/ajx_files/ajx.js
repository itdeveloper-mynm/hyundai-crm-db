
$('#city_id').change(function() {
    var selectedCity = $(this).val();
    var page_type = $(this).data('page_type') ?? null;
    getBranches(selectedCity,page_type, '#branch_id');

});

function getBranches(selectedCity, page_type, branch_id){
    // Make AJAX request to fetch branches based on the selected city
    $.ajax({
        url: '/get-branches/' + selectedCity +'/'+page_type,
        type: 'GET',
        success: function(data) {
            // Populate the branches select box with the fetched data
            var branchesSelect = $(branch_id);
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
}
