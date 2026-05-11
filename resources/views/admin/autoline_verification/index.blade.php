@extends('layouts.master')

@section('title', 'AutoLine Lead Verification')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">

        {{-- Page Header --}}
        <div class="card-header mb-5" style="padding: 0px;">
            <div class="card-toolbar">
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    AutoLine Lead Verification
                                </h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">Verify synced leads exist in AutoLine</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Date Filter --}}
        <div class="card mb-5">
            <div class="card-body py-4">
                <form method="GET" action="{{ route('autoline-verification.index') }}" class="d-flex align-items-end gap-4 flex-wrap">
                    <div>
                        <label class="form-label fw-semibold">From</label>
                        <input type="date" name="from" class="form-control form-control-solid w-150px" value="{{ $from }}">
                    </div>
                    <div>
                        <label class="form-label fw-semibold">To</label>
                        <input type="date" name="to" class="form-control form-control-solid w-150px" value="{{ $to }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Apply</button>
                        <a href="{{ route('autoline-verification.index') }}" class="btn btn-light ms-2">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Synced Leads Table --}}
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-4 text-dark">Synced Leads</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">
                        Leads with an AutoLine lead ID — click Verify to confirm the lead exists in AutoLine.
                        If not found, the lead ID is cleared and the lead will be re-synced automatically.
                    </span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th>#</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Vehicle</th>
                                <th>Branch</th>
                                <th>Campaign</th>
                                <th>Lead ID</th>
                                <th>
                                    @php
                                        $createdDir = ($sortCol === 'created_at' && $sortDir === 'asc') ? 'desc' : 'asc';
                                        $updatedDir = ($sortCol === 'updated_at' && $sortDir === 'asc') ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => $createdDir]) }}" class="text-muted text-hover-primary">
                                        Created At
                                        @if($sortCol === 'created_at')
                                            {!! $sortDir === 'asc' ? '&#8593;' : '&#8595;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'updated_at', 'direction' => $updatedDir]) }}" class="text-muted text-hover-primary">
                                        Updated At
                                        @if($sortCol === 'updated_at')
                                            {!! $sortDir === 'asc' ? '&#8593;' : '&#8595;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($syncedLeads as $lead)
                                <tr id="row-{{ $lead->id }}">
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->customer->full_name ?? '-' }}</td>
                                    <td>{{ $lead->customer->mobile ?? '-' }}</td>
                                    <td>{{ $lead->customer->email ?? '-' }}</td>
                                    <td>{{ $lead->vehicle->name ?? '-' }}</td>
                                    <td>{{ $lead->branch->name ?? '-' }}</td>
                                    <td>{{ $lead->campaign->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-light-primary font-monospace" id="lead-id-{{ $lead->id }}">
                                            {{ $lead->lead_id }}
                                        </span>
                                    </td>
                                    <td>{{ $lead->created_at ? $lead->created_at->format('Y-m-d') : '-' }}</td>
                                    <td>{{ $lead->updated_at ? $lead->updated_at->format('Y-m-d') : '-' }}</td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-light-info verify-btn"
                                            data-id="{{ $lead->id }}"
                                            data-url="{{ route('autoline-verification.verify', $lead->id) }}"
                                            data-clear-url="{{ route('autoline-verification.clear', $lead->id) }}">
                                            Verify
                                        </button>
                                        <span class="ms-2 verification-status" id="status-{{ $lead->id }}"></span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-6">No synced leads found for this date range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $syncedLeads->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.verify-btn', function () {
        var btn    = $(this);
        var id     = btn.data('id');
        var url    = btn.data('url');
        var status = $('#status-' + id);

        Swal.fire({
            title: 'Verify this lead?',
            text: 'This will check if the lead exists in AutoLine. If not found, the Lead ID will be cleared and the lead will be re-queued for sync.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, verify',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#009ef7',
            cancelButtonColor: '#f1416c',
        }).then(function (result) {
            if (!result.isConfirmed) return;

            btn.prop('disabled', true).text('Verifying...');
            status.html('');

            $.ajax({
                type: 'POST',
                url: url,
                data: { _token: '{{ csrf_token() }}' },
                success: function (data) {
                    if (data.status === 'found') {
                        btn.text('Verified').removeClass('btn-light-info').addClass('btn-light-success');
                        status.html('<span class="badge badge-light-success">Found in AutoLine</span>');
                        Swal.fire({
                            title: 'Lead Confirmed',
                            text: 'This lead exists in AutoLine.',
                            icon: 'success',
                            timer: 2500,
                            showConfirmButton: false,
                        });
                    } else if (data.status === 'not_found') {
                        btn.prop('disabled', false).text('Verify');
                        Swal.fire({
                            title: 'Lead Not Found in AutoLine',
                            text: 'This lead does not exist in AutoLine. Do you want to clear the Lead ID so it gets re-synced on the next run?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, clear Lead ID',
                            cancelButtonText: 'No, keep it',
                            confirmButtonColor: '#f1416c',
                            cancelButtonColor: '#7e8299',
                        }).then(function (clearResult) {
                            if (!clearResult.isConfirmed) return;

                            $.ajax({
                                type: 'POST',
                                url: btn.data('clear-url'),
                                data: { _token: '{{ csrf_token() }}' },
                                success: function () {
                                    $('#row-' + id).addClass('bg-light-danger');
                                    btn.text('Not Found').removeClass('btn-light-info').addClass('btn-light-danger').prop('disabled', true);
                                    $('#lead-id-' + id).text('Cleared — pending re-sync').removeClass('badge-light-primary').addClass('badge-light-warning');
                                    status.html('<span class="badge badge-light-danger">Lead ID cleared</span>');
                                    Swal.fire({
                                        title: 'Lead ID Cleared',
                                        text: 'The lead will be re-synced on the next run.',
                                        icon: 'success',
                                        timer: 2500,
                                        showConfirmButton: false,
                                    });
                                },
                                error: function () {
                                    Swal.fire('Error', 'Could not clear the Lead ID. Please try again.', 'error');
                                }
                            });
                        });
                    } else {
                        btn.prop('disabled', false).text('Verify');
                        status.html('<span class="badge badge-light-warning">Error — try again</span>');
                        Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                    }
                },
                error: function () {
                    btn.prop('disabled', false).text('Verify');
                    status.html('<span class="badge badge-light-warning">Error — try again</span>');
                    Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                }
            });
        });
    });
</script>
@endsection
