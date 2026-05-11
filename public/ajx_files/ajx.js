
$('#city_id').change(function() {
    var selectedCity = $(this).val();
    var page_type = $(this).data('page_type') ?? null;
    getBranches(selectedCity, page_type, '#branch_id');
});

function getBranches(selectedCity, page_type, branch_id){
    var branchesSelect = $(branch_id);
    var previousValue = branchesSelect.val();

    $.ajax({
        url: '/get-branches/' + selectedCity +'/'+page_type,
        type: 'GET',
        success: function(data) {
            branchesSelect.empty();
            branchesSelect.append('<option value="">--select--</option>');

            $.each(data, function(key, value) {
                var selected = (previousValue && value.id == previousValue) ? ' selected' : '';
                branchesSelect.append('<option value="' + value.id + '"' + selected + '>' + value.name + '</option>');
            });

            if (branchesSelect.data('select2')) {
                branchesSelect.trigger('change.select2');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
