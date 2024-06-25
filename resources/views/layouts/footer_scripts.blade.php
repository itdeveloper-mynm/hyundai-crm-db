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

        </script>
