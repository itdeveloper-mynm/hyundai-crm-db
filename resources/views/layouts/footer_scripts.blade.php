	<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script src="{{ asset('login_asset') }}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used by this page)-->
		<script src="{{ asset('login_asset') }}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used by this page)-->
		<script src="{{ asset('login_asset') }}/assets/js/widgets.bundle.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/custom/widgets.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/custom/apps/chat/chat.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/custom/utilities/modals/new-target.js"></script>
		<script src="{{ asset('login_asset') }}/assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->


		<script src="{{ asset('login_asset') }}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!-- validation -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>

        <script>
        $('#exportbutton').on('mouseenter', function(e) {
            e.preventDefault(); // Prevent the form from submitting

            // Get all the select elements from the first form
            const selectElements = document.querySelectorAll('#myForm select, #myForm input[type="date"]');

            // Clear the export_form_div
            const exportFormDiv = document.getElementById('export_form_div');
            exportFormDiv.innerHTML = '';

            // Append the cloned elements to the export form
            selectElements.forEach(element => {
                const clonedElement = element.cloneNode(true);
                clonedElement.value = element.value; // Set the cloned element's value to the original's value
                clonedElement.name = element.name; // Ensure the name is set for form submission
                exportFormDiv.appendChild(clonedElement);
            });
    });

    $(document).ready(function() {
        $('select[data-control="select2"]').each(function() {
            var $select = $(this);
            $select.select2({
                placeholder: $select.data('placeholder'),
                allowClear: $select.data('allow-clear')
            });

            if ($select.attr('multiple')) {
                $select.on('select2:select select2:unselect', function(e) {
                    var selectedOptions = $(this).val();
                    if (selectedOptions.length > 2) {
                        $(this).next('.select2-container').first().find('.select2-selection__rendered').text(selectedOptions.length + ' selected');
                    }
                });
            }
        });

        $('#kt_menu_62fe86549b38d').on('click', function(event) {
            event.stopPropagation(); // Prevent event from bubbling up to document
        });

        // Close the menu when clicking outside of it
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#kt_menu_62fe86549b38d').length) {
                // Check if the click was not within the menu
                $('#kt_menu_62fe86549b38d').removeClass('menu-sub-show'); // Replace with your menu class
            }
        });

        // Close the menu when the "Apply" button is clicked
        $('#kt_menu_62fe86549b38d').on('click', '#apply', function(event) {
            // No need to call event.stopPropagation() here
            $('#kt_menu_62fe86549b38d').removeClass('show menu-dropdown');
        });

        // Close the menu when the "Apply" button is clicked
        $('#kt_menu_62fe86549b38d').on('click', '#reset', function(event) {
            // No need to call event.stopPropagation() here
            $('#kt_menu_62fe86549b38d').removeClass('show menu-dropdown');
        });

        // // Prevent closing the menu when clicking inside the form elements
        // $('#kt_menu_62fe86549b38d form').on('click', function(event) {
        //     event.stopPropagation(); // Prevent event from bubbling up to document
        // });
    });


    $('#printButton').click(function() {
        // Open the print dialog
        window.print();
    });

    // code to select/unselect checkboxes
    $(document).ready(function() {
            // Event delegation for dynamically added checkboxes
            $(document).on('change', '.checkbox-item', function() {
                logCheckedValues();
                toggleDeleteButton(); // Check whether to show or hide the delete button
            });

            // Check/Uncheck all checkboxes in the table
            $('#selectAll').on('change', function() {
                $('.checkbox-item').prop('checked', this.checked);
                logCheckedValues();
                toggleDeleteButton(); // Check whether to show or hide the delete button
            });

            // Function to log the values of selected checkboxes
            function logCheckedValues() {
                let checkedValues = [];
                $('.checkbox-item:checked').each(function() {
                checkedValues.push($(this).val());
                });
                // console.log("Checked values: ", checkedValues);
                return checkedValues;
            }

            // Function to toggle the visibility of the "Delete All" button
            function toggleDeleteButton() {
                let checkedLength = $('.checkbox-item:checked').length;
                if (checkedLength > 0) {
                $('#deleteAll').show();
                $('#updateDataAll').show();
                } else {
                $('#deleteAll').hide();
                $('#updateDataAll').hide();
                }
            }

             // Handle delete all button click with SweetAlert confirmation
            $('#deleteAll').on('click', function() {
                Swal.fire({
                title: 'Are you sure?',
                text: "You are about to delete selected items!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Hide the delete button after deletion
                    $('#deleteAll').hide();
                    console.log(logCheckedValues());
                    // Display success alert

                    $.ajax({
                        type: "POST",
                        url: "{{ route('delete-bulk-records') }}",
                        data: {
                            _token: "{{ csrf_token() }}", // Correct the CSRF token key
                            ids: logCheckedValues() // Ensure this function returns an array of IDs
                        },
                        cache: false,
                        timeout: 800000,
                        success: function(data) {
                            if (data.result === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Selected Records have been deleted.',
                                    'success'
                                );
                            }
                            // Uncheck 'Select All' after the request
                            $('#selectAll').prop('checked', false);

                            // Optionally redraw the DataTable
                            if (typeof table !== 'undefined') {
                                table.draw(); // Redraw the table if it's a DataTable
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire(
                                'Error!',
                                'There was an error processing your request.',
                                'error'
                            );
                        }
                    });


                }
                });
            });


            $('#update_all_form').submit(function(e) {
            e.preventDefault();
            var form = $('#update_all_form')[0];
            var data = new FormData(form);
            data.append('checked_values', JSON.stringify(logCheckedValues()));

            $.ajax({
                type: "POST",
                url: "{{ route('leads.updateAllData') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(data) {
                    if (data.result == 'success') {
                        Swal.fire(
                            "{{ __('Add') }}",
                            data.message,
                            data.result,
                        )

                    }
                    if (data.result == 'error') {
                        Swal.fire(
                            "{{ __('Not Add') }}",
                            data.message,
                            'error'
                        )
                        return false;
                    }
                    $("#updateAllModal").modal('hide');
                    // table.draw();
                    if (typeof table !== 'undefined') {
                                table.draw(); // Redraw the table if it's a DataTable
                    }
                    $('#selectAll').prop('checked',false);
                    $("#f_city_id").val([]).change();
                    $("#f_branch_id").val([]).change();
                    $("#f_vehicle_id").val([]).change();
                    $("#f_source_id").val([]).change();
                    $("#f_campaign_id").val([]).change();
                    $("#f_type").val([]).change();


                    // $("#btnSubmit").prop("disabled", false);
                }
            });
        });


        });
    //end code to select/unselect checkboxes


    $(document).ready(function () {
            $(".campaign_wise_row:first-child").click();
            $(".city_wise_row:first-child").click();
            $(".campaign_wise_comp_row:first-child").click();
            $(".city_wise_comp_row:first-child").click();
        });



        $(document).on('click', '.campaign_wise_row', function () {
            // Get the value of the data-id attribute
            var dataId = $(this).data("id");
            var detials = $('#campaign_wise_detials_' +dataId).val();
            $('#source_detials_div').html(detials);
            console.log("Data ID:", dataId);
            // Remove the 'active-tr' class from all .campaign_wise_row elements
            $(".campaign_wise_row").removeClass("active-tr");

            // Add the 'active-tr' class to the clicked element
            $(this).addClass("active-tr");
        });


        $(document).on('click', '.city_wise_row', function () {
            // Get the value of the data-id attribute
            var dataId = $(this).data("id");
            var detials = $('#city_wise_detials_' +dataId).val();
            $('#branch_detials_div').html(detials);
            console.log("Data ID:", dataId);
            // Remove the 'active-tr' class from all .campaign_wise_row elements
            $(".city_wise_row").removeClass("active-tr");

            // Add the 'active-tr' class to the clicked element
            $(this).addClass("active-tr");
        });


        $(document).on('click', '.campaign_wise_comp_row', function () {
            // Get the value of the data-id attribute
            var dataId = $(this).data("id");
            var detials = $('#campaign_wise_comp_detials_' +dataId).val();
            $('#source_detials_comp_div').html(detials);
            console.log("Data ID:", dataId);
            // Remove the 'active-tr' class from all .campaign_wise_row elements
            $(".campaign_wise_comp_row").removeClass("active-tr");

            // Add the 'active-tr' class to the clicked element
            $(this).addClass("active-tr");
        });

        $(document).on('click', '.city_wise_comp_row', function () {
            // Get the value of the data-id attribute
            var dataId = $(this).data("id");
            var detials = $('#city_wise_comp_detials_' +dataId).val();
            $('#branch_detials_comp_div').html(detials);
            console.log("Data ID:", dataId);
            // Remove the 'active-tr' class from all .campaign_wise_row elements
            $(".city_wise_comp_row").removeClass("active-tr");

            // Add the 'active-tr' class to the clicked element
            $(this).addClass("active-tr");
        });

        $(document).on('change', '.editable', function () {
            let element = $(this);
            let id = element.data('id');
            let column = element.data('column');
            let value = element.val();

            $.ajax({
                url: '{{ route("leads.updateColumn") }}',
                type: 'POST',
                data: {
                    id: id,
                    column: column,
                    value: value,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "success",
                    title: "Updated successfully!"
                    });
                    if (typeof table !== 'undefined') {
                        if(column == 'city_id'){
                            table.draw(); // Redraw the table if it's a DataTable
                        }
                    }
                },
                error: function (xhr) {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "error",
                    title: "Failed to update. Please try again."
                    });
                }
            });
        });

        $(document).on('change', '.page_type_checkbox', function() {
            var id = $(this).data('id');
            var pageType = $(this).data('value');
            var model = $(this).data('target');

            // Handle when both checkboxes are checked/unchecked
            var selectedPageTypes = [];
            $('input.page_type_checkbox[data-id="' + id + '"]:checked').each(function() {
                selectedPageTypes.push($(this).data('value'));
            });

            var newPageType = selectedPageTypes.length > 0 ? selectedPageTypes.join(',') : null;

            // Update the page_type value in the database
            updatePageType(id, newPageType,model);
        });

        // Function to update the page_type value in the database
        function updatePageType(id, pageType,model) {
            $.ajax({
                url: "{{ route('campaign.updatePageType') }}", // Create a route for this
                type: "POST",
                data: {
                    id: id,
                    page_type: pageType,
                    model: model,
                    _token: '{{ csrf_token() }}'  // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "success",
                        title: "Page type updated successfully!"
                        });
                        // if (typeof table !== 'undefined') {
                        //     table.draw();
                        // }
                    } else {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: "Error updating page type."
                        });
                    }
                }
            });
        }


    // // kt_app_content
    // document.getElementById("captureButton").addEventListener("click", function () {
    //     let element = document.getElementById("kt_app_content"); // Select the graph container

    //     html2canvas(element, { scale: 2 }).then(canvas => {
    //         let imgData = canvas.toDataURL("image/png"); // Convert to image format

    //         // Open a new tab and print the image
    //         let newTab = window.open();
    //         newTab.document.open();
    //         newTab.document.write(`
    //             <html>
    //                 <head>
    //                     <title>Print Screenshot</title>
    //                     <style>
    //                         body { margin: 0; text-align: center; background: #fff; }
    //                         img { width: 100%; max-width: 100%; height: auto; }
    //                         @media print {
    //                             body { margin: 0; }
    //                             img { width: 100%; max-width: 100%; height: auto; }
    //                         }
    //                     </style>
    //                 </head>
    //                 <body onload="window.print(); window.onafterprint = function() { window.close(); }">
    //                     <img src="${imgData}" />
    //                 </body>
    //             </html>
    //         `);
    //         newTab.document.close();
    //     });
    // });


</script>
