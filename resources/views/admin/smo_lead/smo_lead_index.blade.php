@extends('layouts.master')

@section('title', 'Smo Leads Listing')

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
                                    {{ __('Smo Leads Listing') }}</h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('smo-lead.index') }}"
                                            class="text-muted text-hover-primary">{{ __('Smo Lead') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-customer-table-filter="search" name="search" id="search"
                                    class="form-control w-250px ps-15" placeholder="Search" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-end">


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
                                    @can('smo-leads-filters')
                                    <div class="row">
                                        <div class="col-lg-4">
                                            @include('admin.common_files_filters.city')
                                        </div>
                                        <div class="col-lg-4">
                                            @include('admin.common_files_filters.vehicle')
                                        </div>
                                        <div class="col-lg-4">
                                            @include('admin.common_files_filters.source')
                                        </div>
                                        <div class="col-lg-4">
                                            @include('admin.common_files_filters.category')
                                        </div>
                                        <div class="col-lg-4">
                                            @include('admin.common_files_filters.created_by')
                                        </div>
                                        <div class="col-lg-4">
                                            @include('admin.common_files_filters.updated_by')
                                        </div>
                                    </div>
                                    @endcan
                                    <div class="row mt-1">
                                            @include('admin.common_files_filters.created_date')
                                    </div>
                                    <div class="row mt-2">
                                            @include('admin.common_files_filters.updated_date')
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true" value="apply"
                                                    id="apply">Apply</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true" value="reset" id="reset">Reset</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- <button type="button" class="btn btn-success me-3 export_excel">
                            <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i> </span>
                            {{ __('Excel') }}
                        </button>

                        <button type="button" class="btn btn-warning me-3 export_print">
                            <span class="svg-icon svg-icon-2"> <i class="bi bi-printer"></i> </span>
                            {{ __('Print') }}

                        </button> -->

                        @can('smo-leads-export')
                        <form action="{{route('smo-lead.export')}}" method="POST"  id="exportForm">
                            @csrf
                            <div id="export_form_div" style="display: none">
                            </div>
                            <button type="submit" class="btn btn-success me-3" id="exportbutton">
                                <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i> </span>
                                {{ __('Excel') }}
                            </button>
                        </form>
                        @endcan

                        @can('smo-leads-import')
                            <a href="{{asset('excel_files/smo-leads-sample.xlsx')}}" class="btn btn-warning  me-3" download>
                                <i class="fa fa-download"></i>
                                {{ __('Sample') }}</a>
                            <a href="#" class="btn btn-dark  me-3" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="fa fa-upload"></i>
                                {{ __('Import') }}</a>
                        @endcan

                        @can('smo-leads-import')
                            <a href="{{ route('smo-lead.create') }}" class="btn btn-primary">
                                <span class="svg-icon svg-icon-2"> <i class="bi bi-patch-check fs-3"></i></span>
                                {{ __('Add') }}</a>
                        @endcan
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
                            <th class="min-w-100px">{{ __('Full Name') }}</th>
                            <th class="min-w-100px">{{ __('Mobile') }}</th>
                            <th class="min-w-100px">{{ __('City') }}</th>
                            <th class="min-w-100px">{{ __('Vehicle') }}</th>
                            <th class="min-w-100px">{{ __('Source') }}</th>
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

                </table>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Import Smo Leads</h3>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor"></rect>
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

                                            <div class="card-body pt-0  tab-pane fade show active agency_tab" id=""
                                                role="tabpanel" aria-labelledby="">
                                                <div class="row ">
                                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                                        <label class="required form-label">{{ __('Select File')
                                                        }}</label>

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
</div>

</div>
</div>
</div>

@endsection

@section('js')
<script>
var table = $('#user_table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    searching: true,
    filter: true,

    ajax: {
        "url": "{{ route('smoLead.pagination') }}",
        "type": "GET",
        'data': function(data) {
            data.city_id = $('#city_id').val();
            data.vehicle_id = $('#vehicle_id').val();
            data.source_id = $('#source_id').val();
            data.category = $('#category').val();
            data.created_by = $('#created_by').val();
            data.updated_by = $('#updated_by').val();
            data.from = $('#from').val();
            data.to = $('#to').val();
            data.upd_from = $('#upd_from').val();
            data.upd_to = $('#upd_to').val();
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

                var result = '<a href="{{ url('smo-lead') }}/' + row.id +
                            '/edit" target="a_blank" class="fw-bold"  data-toggle="tooltip" title="{{ __('table.edit') }}"  >' + data + '</a>';
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
                @can('smo-leads-edit')
                res = '<a href="{{  url("smo-lead")  }}/' + data +
                    '/edit" class="btn btn-sm btn-icon btn-light-primary"  data-toggle="tooltip" title="{{ __("table.edit") }}"><i class="fa fa-pencil"></i></a> ';
                @endcan
                @can('smo-leads-delete')
                res2 =
                    '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-light-danger" onclick="rowDelete(' +
                    data + ')" ><i class="bi-trash"></i></a>';
                @endcan

                return res + res2;
            }
        }
    ],
    order: [
        [3, "desc"]
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
    var from = document.querySelector('#from');
    var to = document.querySelector('#to');
    from.value = '';
    to.value = '';

    // Reset date fields
    var upd_from = document.querySelector('#upd_from');
    var upd_to = document.querySelector('#upd_to');
    upd_from.value = '';
    upd_to.value = '';


    $("#city_id").val([]).change();
    $("#vehicle_id").val([]).change();
    $("#source_id").val([]).change();
    $("#category").val([]).change();
    $("#created_by").val([]).change();
    $("#updated_by").val([]).change();

    table.draw();

});



$('#search').keyup(function() {
    table.search($(this).val()).draw();
})

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
                url: '{{ url("smo-lead") }}/' + id,
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
            url: "{{ route('smo-lead.import') }}",
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

</script>


@endsection
