@extends('layouts.master')

@section('title', 'Email Sending Criteria')

@section('css')
<style>
    #user_table_filter {
     display: block !important;
}

</style>
@endsection

@section('content')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="card-header mb-3" style="padding: 0px;">


            <div class="card-toolbar ">
                <div class="row  mt-5">
                <div class="col-lg-4">
                            <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">

                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('Email Sending Criteria') }}</h1>
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <li class="breadcrumb-item text-muted">
                                            <a href="#" class="text-muted text-hover-primary">{{ __('Email Sending Criteria') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-8">
                        <div class="card-title">
                            {{-- <div class="d-flex align-items-center position-relative my-1" style="float: right;">
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
                            </div> --}}
                            @can('email-sending-criteria-create')
                                <a href="{{ route('email-sending-criteria.create') }}" class="btn btn-primary" style="float: right">
                                    <span class="svg-icon svg-icon-2"> <i class="bi bi-patch-check fs-3"></i></span>
                                    {{ __('Add') }}</a>
                            @endcan
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-success me-3 export_excel">
                            <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i> </span>
                            {{ __('Excel') }}
                        </button>

                        <button type="button" class="btn btn-warning me-3 export_print">
                            <span class="svg-icon svg-icon-2"> <i class="bi bi-printer"></i> </span>
                            {{ __('Print') }}

                        </button>


                        <a href="#" class="btn btn-primary">
                            <span class="svg-icon svg-icon-2"> <i class="bi bi-patch-check fs-3"></i></span>
                            {{ __('Print') }}</a>
                    </div> --}}
                </div>
            </div>


        </div>
        <div class="card">
            <div class="card-body" style="padding: 1rem;">
                <table id="user_table" class="table table-striped table-bordered" width="100%">
                    <thead class="table-dark" style="border-radius: 10px 10px 10px 10px;">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="min-w-150px">{{ __('Header') }}</th>
                            <th class="min-w-150px">{{ __('Body') }}</th>
                            <th class="min-w-150px">{{ __('Type') }}</th>
                            <th class="min-w-150px">{{ __('Emails') }}</th>
                            <th class="min-w-150px">{{ __('Action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($alldata as $singledata)
                        <tr>
                            <td class="center">{{ $loop->iteration }}</td>
                            <td>
                                <a class="text-dark fw-bold">{{$singledata->header}}</a>
                            </td>
                            <td><a class="text-dark fw-bold">{{$singledata->body}}</a></td>
                            <td><a class="text-dark fw-bold">{{$singledata->type}}</a></td>
                            <td><a class="text-dark fw-bold">{{$singledata->emails}}</a></td>
                            <td>
                                <a class="text-dark fw-bold">
                                    @can('email-sending-criteria-edit')
                                        <a href="{{route('email-sending-criteria.edit',['email_sending_criterion' =>  $singledata->id ])}}" class="btn btn-sm btn-icon btn-light-primary"  data-toggle="tooltip" title="{{ __("table.edit") }}"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('email-sending-criteria-delete')
                                        <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-light-danger" onclick="rowDelete({{$singledata->id}})" ><i class="bi-trash"></i></a>
                                    @endcan
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
$(document).ready(function () {
    // var table = $('#user_table').DataTable({
    //     "paging": true, // Enable pagination
    //     "lengthChange": true, // Disable items per page change
    //     "searching": true,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    // });

    $("#user_table").DataTable({
        "searching": true,
        "ordering": false,
	"language": {
		"lengthMenu": "Show _MENU_",
	},
	"dom":
		"<'row mb-2'" +
		"<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
		"<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
		">" +

		"<'table-responsive'tr>" +

		"<'row'" +
		"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
		"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
		">"
    });
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
            url: '{{ url("roles") }}/' + id,
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
                    location.reload();
                    //window.reload(null, false);
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



</script>


@endsection
