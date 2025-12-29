<table class="table table-striped gy-4 gs-7">
    <thead>
        <tr style="background: #A0C5E8;">
            <th class="w-200px" colspan="2">
                <h5><span style="float: left">Name</span></h5>
            </th>
            <th class="w-200px">
                <h5><span style="float: left">Qualified</span></h5>
            </th>
            <th class="w-200px">
                <h5><span style="float: left">Not Qualified</span></h5>
            </th>
            <th class="w-200px">
                <h5><span style="float: left">General Inquiry</span></h5>
            </th>
            <th class="w-200px">
                <h5><span style="float: left">Total</span></h5>
            </th>
            <th class="w-200px">
                <h5><span style="float: left">Conversion (%)</span></h5>
            </th>
            <th>
                <h5><span style="float: left">Inv</span></h5>
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
        @endphp
        @foreach ($crm_users_graph as $crm_users)
            <tr class="cursor-pointer">
                <td colspan="2">
                    <span class="float-left">
                        {{ $crm_users['updatedby']['name'] ?? '' }}
                    </span>
                </td>
                @php
                    $badgeClass = Arr::random($badgeClasses);
                    $qualified = $crm_users['qualified_count'] ?? 0;
                    $notQualified = $crm_users['not_qualified_count'] ?? 0;
                    $generalInquiry = $crm_users['general_inquiry_count'] ?? 0;
                    $total = $qualified + $notQualified + $generalInquiry;
                    $mql = $crm_users['mql'] ?? 0;
                @endphp
                <td>
                    <span class="float-left badge badge-{{ $badgeClass }}">{{ $qualified }}</span>
                </td>
                <td>
                    <span class="float-left badge badge-{{ $badgeClass }}">{{ $notQualified }}</span>
                </td>
                <td>
                    <span class="float-left badge badge-{{ $badgeClass }}">{{ $generalInquiry }}</span>
                </td>
                <td>
                    <span class="float-left badge badge-{{ $badgeClass }}">{{ $total }}</span>
                </td>
                <td>
                    <span
                        class="float-left badge" style="background-color: #002c5f !important;">{{ calculatePercentage($total, $qualified) }}</span>
                </td>
                <td>
                    <span style="float: left" class="badge badge-success">{{ $crm_users['inv'] ?? 0 }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        @php
            $badgeClass = Arr::random($badgeClasses);
            $totalQualified = collect($crm_users_graph)->sum('qualified_count') ?? 0;
            $totalNotQualified = collect($crm_users_graph)->sum('not_qualified_count') ?? 0;
            $totalGeneralInquiry = collect($crm_users_graph)->sum('general_inquiry_count') ?? 0;
            $grandTotal = $totalQualified + $totalNotQualified + $totalGeneralInquiry;
            $mql = collect($crm_users_graph)->sum('mql') ?? 0;
            $cql = collect($crm_users_graph)->sum('qualified_count') ?? 0;
        @endphp

        <tr style="background: #8FBC8F;">
            <th colspan="2">
                <h5><span class="float-left">Total Count</span></h5>
            </th>
            <th>
                <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $totalQualified }}</span></h5>
            </th>
            <th>
                <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $totalNotQualified }}</span></h5>
            </th>
            <th>
                <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $totalGeneralInquiry }}</span></h5>
            </th>
            <th>
                <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $grandTotal }}</span></h5>
            </th>
            <th>
                <h5><span class="float-left badge" style="background-color: #002c5f !important;">{{ calculatePercentage($total, $cql) }}</span></h5>
            </th>
            <th>
                <h5><span style="float: left"
                        class="badge badge-success">{{ collect($crm_users_graph)->sum('inv') ?? 0 }}</span></h5>
            </th>
        </tr>
    </tfoot>
</table>
