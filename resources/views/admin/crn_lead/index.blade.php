@extends('layouts.master')


@section('title', 'Crm Leads')



@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <div class="card-header mb-3" style="padding: 0px;">


                <div class="card-toolbar ">
                    <div class="row  mt-5">
                        <div class="col-lg-4">
                            <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">

                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <h1
                                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        {{ __('Crm Leads List') }}</h1>
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <li class="breadcrumb-item text-muted">
                                            <a href="{{ route('crm-leads.index') }}"
                                                class="text-muted text-hover-primary">{{ __('Crm Leads') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">


                            <button type="button" class="btn btn-info me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>Filter</button>

                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-600px" data-kt-menu="true"
                                id="kt_menu_62fe86549b38d">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <form class="form d-flex flex-column flex-lg-row" id="myForm">
                                    <div class="px-7 py-5">
                                        <div class="mb-3">
                                            @can('crm-leads-filters')
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.city' , ['page_type' => 'sales' ])
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.branch')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.vehicle')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.source', ['crm_chk' => true])
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.campaign')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.purchase_plan')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.monthly_salary')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.preferred_appointment_time')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.kyc')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.category')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.app_types')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.departments')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.created_by', ['crm_chk' => true])
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.updated_by', ['crm_chk' => true])
                                                    </div>
                                                </div>
                                            @endcan
                                            <div class="row mt-1">
                                                @include('admin.common_files_filters.created_date' , ['no_of_months' => getUserNoOfMonths() ])
                                            </div>
                                            <div class="row mt-2">
                                                @include('admin.common_files_filters.updated_date' , ['no_of_months' => getUserNoOfMonths()  ])
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-menu-dismiss="true" value="apply"
                                                        id="apply">Apply</button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="{{ route('sale-graph.index') }}"
                                                        class="btn btn-sm btn-primary" data-kt-menu-dismiss="true"
                                                        value="reset" id="reset">Reset</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            </div>

                            @can('crm-leads-export')
                                <form action="{{ route('crm-leads.export') }}" method="POST" id="exportForm">
                                    @csrf
                                    <div id="export_form_div" style="display: none">

                                    </div>
                                    <button type="submit" class="btn btn-success me-3" id="exportbutton">
                                        <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i>
                                        </span>
                                        {{ __('Excel') }}
                                    </button>
                                </form>
                            @endcan

                            @can('crm-leads-import')
                                <a href="{{ asset('excel_files/crm-leads-sample.xlsx') }}" class="btn btn-warning  me-3"
                                    download>
                                    <i class="fa fa-download"></i>
                                    {{ __('Sample') }}</a>

                                <a href="#" class="btn btn-dark  me-3" data-bs-toggle="modal"
                                    data-bs-target="#importModal">
                                    <i class="fa fa-upload"></i>
                                    {{ __('Import') }}</a>
                            @endcan

                            @can('crm-leads-create')
                                <a href="{{ route('crm-leads.create') }}" class="btn btn-primary">
                                    <span class="svg-icon svg-icon-2"> <i class="bi bi-patch-check fs-3"></i></span>
                                    {{ __('Add') }}</a>
                            @endcan
                        </div>
                    </div>
                        <div class="row  mt-5">

                            <div class="col-lg-6">
                                @include('admin.common_files.top-message-lisitng-page')
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <input type="text" data-kt-customer-table-filter="search" name="search"
                                        id="search" class="form-control w-250px ps-15" placeholder="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card">
                <div class="card-body" style="padding: 1rem;">

                    <table id="user_table" class="table table-striped table-bordered" width="100%">
                        <thead class="table-dark" style="border-radius: 10px 10px 10px 10px;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="min-w-200px">{{ __('Full Name') }}</th>
                                <th class="min-w-70px">{{ __('Mobile') }}</th>
                                <th class="min-w-100px">{{ __('City') }}</th>
                                <th class="min-w-100px">{{ __('Branch') }}</th>
                                <th class="min-w-100px">{{ __('Vehicle') }}</th>
                                <th class="min-w-100px">{{ __('Source') }}</th>
                                <th class="min-w-100px">{{ __('Type') }}</th>
                                <th class="min-w-100px">{{ __('Category') }}</th>
                                <th class="min-w-100px">{{ __('Sub Category') }}</th>
                                <th class="min-w-100px">{{ __('Created At') }}</th>
                                <th class="min-w-100px">{{ __('Created By') }}</th>
                                <th class="min-w-100px">{{ __('Updated At') }}</th>
                                <th class="min-w-100px">{{ __('Updated By') }}</th>
                                <th class="min-w-100px">{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody></tbody>
                        <div class="modal fade" id="action_modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Update</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                        rx="1" transform="rotate(-45 6 17.3137)"
                                                        fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <div class="modal-body">
                                        <form class="form d-flex flex-column flex-lg-row" method="post" id="action_form"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active"
                                                        id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">

                                                            <div class="card card-flush py-4">

                                                                <div class="tab-content">
                                                                    <input type="hidden" name="rowid" id="rowid">
                                                                    <div class="row">
                                                                        <div class="mb-5 fv-row col-lg-12">
                                                                            <label
                                                                                class="required form-label">{{ __('Category') }}</label>
                                                                            <select class="form-select mb-2"
                                                                                name="action_category" id="action_category"
                                                                                onchange="updateSubCategory()"
                                                                                required="required" data-control="select2"
                                                                                data-placeholder="{{ __('select option') }}"
                                                                                data-allow-clear="true">
                                                                                <option value="">--select--</option>
                                                                                    @foreach (getCategories() as $category)
                                                                                        <option value="{{$category}}">{{$category}}</option>
                                                                                    @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-5 fv-row col-lg-12">
                                                                            <label
                                                                                class="required form-label">{{ __('Sub Category') }}</label>
                                                                            <select class="form-select mb-2"
                                                                                name="action_sub_category" id="action_sub_category"
                                                                                required="required" data-control="select2"
                                                                                data-placeholder="{{ __('select option') }}"
                                                                                data-allow-clear="true">
                                                                                <option value=""></option>
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary btn_submit sub_button"
                                                                    id="actionbtnSubmit" style="background-color: #000044">
                                                                    <span class="indicator-label">{{ __('Update') }}</span>
                                                                    <span class="indicator-progress">Please wait...
                                                                        <span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Import CRM Leads</h3>
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <form class="form d-flex flex-column flex-lg-row" method="post" id="csv_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                    role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">

                                        <div class="card card-flush py-4">

                                            <div class="tab-content">

                                                <div class="card-body pt-0  tab-pane fade show active agency_tab"
                                                    id="" role="tabpanel" aria-labelledby="">
                                                    <div class="row ">
                                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                                            <label
                                                                class="required form-label">{{ __('Select File') }}</label>

                                                            <input type="file" name="csvfile" id="products_uploaded"
                                                                class="form-control" value="Upload" required>
                                                        </div>
                                                    </div>
                                                    <!-- row  -->
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary " id="btnSubmit">
                                                    <span class="indicator-label "> {{ __('Upload') }}</span>
                                                </button>
                                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






@endsection

@section('js')

    <script src="{{ asset('ajx_files/ajx.js') }}"></script>


    <script>
        var table = $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            filter: true,
            pageLength: 100,

            ajax: {
                "url": "{{ route('crm-leads.pagination') }}",
                "type": "GET",
                'data': function(data) {
                    data.city_id = $('#city_id').val();
                    data.branch_id = $('#branch_id').val();
                    data.vehicle_id = $('#vehicle_id').val();
                    data.source_id = $('#source_id').val();
                    data.campaign_id = $('#campaign_id').val();
                    data.purchase_plan = $('#purchase_plan').val();
                    data.monthly_salary = $('#monthly_salary').val();
                    data.preferred_appointment_time = $('#preferred_appointment_time').val();
                    data.kyc = $('#kyc').val();
                    data.category = $('#category').val();
                    data.created_by = $('#created_by').val();
                    data.updated_by = $('#updated_by').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.upd_from = $('#upd_from').val();
                    data.upd_to = $('#upd_to').val();
                    data.type = $('#type').val();
                    data.department_types = $('#department_types').val();
                }
            },
            columns: [{
                    data: 'no',
                    name: 'no',
                    width: '5%',
                    className: 'center'
                },
                {
                    data: 'full_name',
                    render: function(data, type, row) {

                        var result = '<a href="{{ url('crm-leads') }}/' + row.id +
                            '/edit" target="a_blank" class="fw-bold"  data-toggle="tooltip" title="{{ __('table.edit') }}"  >' +
                            data + '</a>';
                        return result;

                    }
                },
                {
                    data: 'mobile',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'city_id',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'branch_id',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'vehicle_id',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'source_id',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'type',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'category',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'sub_category',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'created_at',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'created_by',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'updated_at',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },
                {
                    data: 'updated_by',
                    render: function(data, type, row) {

                        var result = '<a class=" text-dark fw-bold "  >' + data + '</a>';
                        return result;
                    }
                },

                {
                    data: 'id',
                    render: function(data, type, row) {
                        var res = '-';
                        var res2 = '-';
                        var res3 = '-';

                        @can('crm-leads-edit')
                            res = `<a href="{{ url('crm-leads') }}/${data}/edit" target="blank" class="btn btn-sm btn-icon btn-light-primary" data-toggle="tooltip" title="{{ __('table.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>`;
                        @endcan
                        @can('crm-leads-delete')
                                        res2 = `<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-light-danger" onclick="rowDelete(${data})">
                            <i class="bi-trash"></i>
                            </a>`;
                        @endcan

                        if(row.category != 'Qualified'){
                            res3 = `<a href="#" onclick="updateData(${row.id}, '${row.category}', '${row.sub_category}')">
                            <span class="svg-icon svg-icon-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            </a>`;
                        }

                        return res + res2 + res3;
                    }

                }
            ],
            order: [
                [8, "desc"]
            ],
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    className: 'btn-success',
                    text: "{{ __('table.print') }}",
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },

                {
                    extend: 'print',
                    className: 'btn-warning',
                    text: "{{ __('table.excel') }}",
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },

            ],

            columnDefs: [{
                    targets: 0,
                    sortable: false,
                    orderable: false
                },
                {
                    targets: 1,
                    sortable: false,
                    orderable: false
                },
                {
                    targets: 2,
                    sortable: false,
                    orderable: false
                },
                {
                    "className": "dt-center",
                    "targets": "_all"
                },

            ],
            "oLanguage": {
                "sSearch": "{{ __('search') }}",
                "sEmptyTable": "{{ __('No Data Found. Maybe change the Filter') }}"
            },
        });
        table.on('draw.dt', function() {
            var PageInfo = $('#user_table').DataTable().page.info();
            table.column(0, {
                page: 'current'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });

        //filter apply and reset submit form

        $('#myForm').submit(function(e) {
            e.preventDefault();
            table.draw();
        });
        $('#reset').click(function(e) {
            e.preventDefault();

            @role('SuperAdmin')
                var from = document.querySelector('#from');
                var to = document.querySelector('#to');
                from.value = '';
                to.value = '';

                // Reset date fields
                var upd_from = document.querySelector('#upd_from');
                var upd_to = document.querySelector('#upd_to');
                upd_from.value = '';
                upd_to.value = '';
            @endrole

            // Reset select fields
            $("#city_id").val([]).change();
            $("#branch_id").val([]).change();
            $("#vehicle_id").val([]).change();
            $("#source_id").val([]).change();
            $("#campaign_id").val([]).change();
            $("#purchase_plan").val([]).change();
            $("#kyc").val([]).change();
            $("#category").val([]).change();
            $("#created_by").val([]).change();
            $("#updated_by").val([]).change();
            $('#monthly_salary').val([]).change();
            $('#preferred_appointment_time').val([]).change();
            $('#type').val([]).change();
            $('#department_types').val([]).change();

            table.draw();

        });


        // Debounce function
        function debounce(fn, delay) {
            let timer;
            return function (...args) {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        // Apply to your search input
        $('#search').on('keyup', debounce(function () {
            table.search($(this).val()).draw();
        }, 1000)); // 1000ms delay

        // $('#search').keyup(function() {
        //     table.search($(this).val()).draw();
        // })


        $('.export_excel').on('click', function() {
            $(".buttons-excel").trigger("click");
        });
        $('.export_print').on('click', function() {
            $(".buttons-print").trigger("click");
        });


        function rowDelete(id) {

            Swal.fire({
                title: "{{ __('Delete') }}",
                text: "{{ __('Are You Sure') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Confirm') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '{{ url('crm-leads') }}/' + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.result == 'success') {
                                Swal.fire(
                                    "{{ __('Deleted') }}",
                                    data.message,
                                    data.result
                                )
                                table.ajax.reload(null, false);
                            }
                            if (data.result == 'error') {
                                Swal.fire(
                                    "{{ __('Not Deleted') }}",
                                    data.message,
                                    data.result
                                )
                            }

                        }
                    })
                }
            })
        }

        $('#csv_form').submit(function(e) {
            e.preventDefault();
            var form = $('#csv_form')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "{{ route('crm-leads.import') }}",
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
                    $("#importModal").modal('hide');
                    table.draw();

                    $("#btnSubmit").prop("disabled", false);
                }
            });
        });

        function updateData(id, category, sub_category) {
            // alert(id);
            console.log(category);
            if (sub_category != '') {
                $('#action_category').val(category);
                $('#action_category').change();
                $('#action_sub_category').html('<option value=' + sub_category + '>' + sub_category + '</option>');
            }
            // return false;
            $('#rowid').val(id);
            $('#action_modal').modal('show');
        }

        $('#action_form').submit(function(e) {
            e.preventDefault();

            $('.indicator-label').css({
                'display': 'none'
            });
            $('.indicator-progress').css({
                'display': 'inline-block'
            });
            $("#actionbtnSubmit").attr('disabled', true);

            var form = $('#action_form')[0];
            var data = new FormData(form);


            $.ajax({
                type: "POST",
                url: "{{ route('sub-category.update') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                beforeSubmit: function() {

                $("body").addClass("loading");

                },
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
                    $("#action_modal").modal('hide');
                    table.draw();

                    // Revert .indicator-label to display
                    $('.indicator-label').css({
                        'display': 'inline-block' // or 'block', depending on your original display property
                    });

                    // Revert .indicator-progress to hide
                    $('.indicator-progress').css({
                        'display': 'none'
                    });

                    $("#actionbtnSubmit").prop("disabled", false);
                }
            });
        });


        function updateSubCategory() {
            const category = $('#action_category').val();
            const subCategory = $('#action_sub_category');
            let options = '';

            const categories = @json(getsubCategories());

            if (category in categories) {
                const optionsArray = categories[category];
                optionsArray.forEach(option => {
                    options += `<option value="${option}">${option}</option>`;
                });
            }

            subCategory.html(options);
        }


        $(document).ready(function() {
        // Get the URL parameter 'mobile'
        var urlParams = new URLSearchParams(window.location.search);
        var mobileParam = urlParams.get('mobile');

        // Check if the 'mobile' parameter exists
        if (mobileParam) {
            // Set the value of the search input to the mobile parameter
            $('#search').val(mobileParam);

            // Trigger the keyup event to perform the search
            $('#search').keyup();
        }
    });
    </script>


@endsection
