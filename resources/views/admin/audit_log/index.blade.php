@extends('layouts.master')

@section('title', 'Lead Audit Log')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">

        {{-- Page header --}}
        <div class="d-flex align-items-center justify-content-between mb-5">
            <div>
                <h1 class="fs-2 fw-bold mb-1">Lead Audit Log</h1>
                <p class="text-muted mb-0">Tracks all field changes made to lead records by CRM users.</p>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card mb-5">
            <div class="card-body py-4">
                <form method="GET" action="{{ route('audit-log.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">From</label>
                        <input type="date" name="from" class="form-control form-control-solid"
                            value="{{ $from }}" max="{{ today()->toDateString() }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">To</label>
                        <input type="date" name="to" class="form-control form-control-solid"
                            value="{{ $to }}" max="{{ today()->toDateString() }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Lead ID</label>
                        <input type="number" name="application_id" class="form-control form-control-solid"
                            value="{{ request('application_id') }}" placeholder="e.g. 1234567">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control form-control-solid"
                            value="{{ request('mobile') }}" placeholder="e.g. 05XXXXXXXX">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Changed By</label>
                        <select name="user_id" class="form-select form-select-solid" data-control="select2"
                            data-placeholder="All Users" data-allow-clear="true">
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ ucwords($user->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-dark">Apply</button>
                        <a href="{{ route('audit-log.index') }}" class="btn btn-light">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Summary --}}
        <div class="d-flex align-items-center mb-3">
            <span class="text-muted fs-6">
                Showing <strong>{{ $logs->total() }}</strong> log
                {{ Str::plural('entry', $logs->total()) }}
                for <strong>{{ \Carbon\Carbon::parse($from)->format('d M Y') }}</strong>
                &ndash;
                <strong>{{ \Carbon\Carbon::parse($to)->format('d M Y') }}</strong>
            </span>
        </div>

        {{-- Log table --}}
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-row-bordered table-row-gray-200 align-top gs-0 gy-4 mb-0">
                        <thead class="fs-7 text-gray-400 text-uppercase bg-light">
                            <tr>
                                <th class="ps-4 min-w-80px">Date / Time</th>
                                <th class="min-w-80px">Lead ID</th>
                                <th class="min-w-150px">Customer</th>
                                <th class="min-w-130px">Changed By</th>
                                <th class="min-w-300px">Changes</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @forelse($logs as $log)
                                <tr>
                                    <td class="ps-4 text-nowrap">
                                        {{ $log->created_at->format('d M Y') }}<br>
                                        <span class="text-muted fs-7">{{ $log->created_at->format('H:i:s') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-primary fs-7">
                                            #{{ $log->application_id }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($log->application && $log->application->customer)
                                            {{ ucwords($log->application->customer->first_name . ' ' . $log->application->customer->last_name) }}
                                            <br>
                                            <span class="text-muted fs-7">{{ $log->application->customer->mobile ?? '-' }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ ucwords($log->user->name ?? 'System') }}
                                        @if($log->user)
                                            <br>
                                            <span class="text-muted fs-7">{{ $log->user->email }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($log->changes as $field => $change)
                                            <div class="mb-1">
                                                <span class="badge badge-light-dark fs-8 me-1">
                                                    {{ \App\Models\ApplicationAuditLog::fieldLabel($field) }}
                                                </span>
                                                <span class="text-danger text-decoration-line-through me-1">
                                                    {{ $change['from'] !== null && $change['from'] !== '' ? $change['from'] : '(empty)' }}
                                                </span>
                                                <span class="text-muted me-1">&rarr;</span>
                                                <span class="text-success">
                                                    {{ $change['to'] !== null && $change['to'] !== '' ? $change['to'] : '(empty)' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-10">
                                        No audit log entries found for the selected filters.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($logs->hasPages())
                    <div class="px-4 py-4">
                        {{ $logs->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
