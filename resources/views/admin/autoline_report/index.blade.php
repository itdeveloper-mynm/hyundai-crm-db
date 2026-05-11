@extends('layouts.master')

@section('title', 'AutoLine Sync Report')

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
                                    AutoLine Sync Report
                                </h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">Qualified Leads vs AutoLine</li>
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
                <form method="GET" action="{{ route('autoline-report.index') }}" class="d-flex align-items-end gap-4 flex-wrap">
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
                        <a href="{{ route('autoline-report.index') }}" class="btn btn-light ms-2">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="row g-5 mb-5">
            <div class="col-md-3">
                <div class="card card-flush h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-8">
                        <span class="fs-2hx fw-bold text-dark">{{ number_format($total) }}</span>
                        <span class="fs-6 text-gray-500 fw-semibold mt-1">Total Qualified Leads</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-8">
                        <span class="fs-2hx fw-bold text-success">{{ number_format($synced) }}</span>
                        <span class="fs-6 text-gray-500 fw-semibold mt-1">Synced to AutoLine</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-8">
                        <span class="fs-2hx fw-bold text-danger">{{ number_format($unsynced) }}</span>
                        <span class="fs-6 text-gray-500 fw-semibold mt-1">Not Synced</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush h-100 {{ $errorRate > 3 ? 'border border-danger' : '' }}">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-8">
                        <span class="fs-2hx fw-bold {{ $errorRate > 3 ? 'text-danger' : 'text-success' }}">
                            {{ $errorRate }}%
                        </span>
                        <span class="fs-6 text-gray-500 fw-semibold mt-1">Error Rate</span>
                        @if($errorRate > 3)
                            <span class="badge badge-light-danger mt-2">Exceeds 3% threshold</span>
                        @else
                            <span class="badge badge-light-success mt-2">Within threshold</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Unsynced Leads Table --}}
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-4 text-dark">Unsynced Leads</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Qualified leads with no AutoLine lead ID</span>
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
                                <th>Sub Category</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($unsyncedLeads as $lead)
                                <tr>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->customer->full_name ?? '-' }}</td>
                                    <td>{{ $lead->customer->mobile ?? '-' }}</td>
                                    <td>{{ $lead->customer->email ?? '-' }}</td>
                                    <td>{{ $lead->vehicle->name ?? '-' }}</td>
                                    <td>{{ $lead->branch->name ?? '-' }}</td>
                                    <td>{{ $lead->campaign->name ?? '-' }}</td>
                                    <td>{{ $lead->sub_category ?? '-' }}</td>
                                    <td>{{ $lead->updated_at ? $lead->updated_at->format('Y-m-d') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-6">All qualified leads are synced.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $unsyncedLeads->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
