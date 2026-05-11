
<table class="table table-striped gy-4 gs-7">
    <thead>
        <tr  style="background: #A0C5E8;">
            <th class="" colspan="2">
                <h5><span style="float: left">Name</span></h5>
            </th>
            <th class=""><h5><span style="float: left">MQL</span></h5></th>
            <th class=""><h5><span style="float: left" title="Target Sql (MQL / Percentage)">TSQL <small>(30%)</small></span></h5></th>
            <th class=""><h5><span style="float: left">SQL</span></h5></th>
            <th class=""><h5><span style="float: left">SGI</span></h5></th>
            <th class=""><h5><span style="float: left">SNQ</span></h5></th>
            <th class=""><h5><span style="float: left" title="Unreachable">Unreach</span></h5></th>
            <th class=""><h5><span style="float: left" title="Pending CRM Leads">PCL</span></h5></th>
            <th class=""><h5><span style="float: left">Conversion (%)</span></h5></th>
            <th class=""><h5><span style="float: left">Inv</span></h5></th>
            <th class=""><h5><span style="float: left">SalesConv (%)</span></h5></th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_percentage_value = 0;
        @endphp
        @if($vehcile_detial_graph)
            @foreach ($vehcile_detial_graph as $key => $vehcile)
                <tr class="campaign-row toggle-sources" data-campaign-id="{{ $vehcile['vehicle_id'] }}">
                    @php
                        $mql = $vehcile['mql'] ?? 0;
                        $cql = $vehcile['cql'] ?? 0;
                        $cgi = $vehcile['cgi'] ?? 0;
                        $cnq = $vehcile['cnq'] ?? 0;
                        $unreachable = $vehcile['unreach'] ?? 0;
                        $inv = $vehcile['inv'] ?? 0;
                        $remaining = $vehcile['pending_crm_leads'] ?? 0;

                        // Calculate percentage value and sum it
                        $percentage_value = calculatePercentageValue($mql, 30);
                        $total_percentage_value += $percentage_value;
                    @endphp
                    <td colspan="2"><span style="float: left">{{ $vehcile['vehicle_name'] }}</span></td>
                    <td><span class="badge badge-primary">{{ $mql }}</span></td>
                    <td><span class="badge badge-primary">{{ $percentage_value }}</span></td>
                    <td><span class="badge badge-success">{{ $cql }}</span></td>
                    <td><span class="badge badge-info">{{ $cgi }}</span></td>
                    <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                    <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                    <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                    <td><span class="badge" style="background-color: #002c5f !important;">
                        {{ calculatePercentage($mql, $cql) }}
                    </span></td>
                    <td><span class="badge badge-success">{{ $inv }}</span></td>
                    <td><span class="badge" style="background-color: #002c5f !important;">
                        {{ calculatePercentage($mql, $inv) }}
                    </span></td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr style="background: #a36b4f">
            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
            @php
                $mql = collect($vehcile_detial_graph)->sum('mql') ?? 0;
                $cql = collect($vehcile_detial_graph)->sum('cql') ?? 0;
                $cgi = collect($vehcile_detial_graph)->sum('cgi') ?? 0;
                $cnq = collect($vehcile_detial_graph)->sum('cnq') ?? 0;
                $inv = collect($vehcile_detial_graph)->sum('inv') ?? 0;
                $unreachable = collect($vehcile_detial_graph)->sum('unreach') ?? 0;
                $remaining = collect($vehcile_detial_graph)->sum('pending_crm_leads') ?? 0;
            @endphp
            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
            <th><h5><span class="badge badge-primary">{{ $total_percentage_value }}</span></h5></th>
            <th><h5><span class="badge badge-success">{{ $cql }}</span></h5></th>
            <th><h5><span class="badge badge-info">{{ $cgi }}</span></h5></th>
            <th><h5><span class="badge badge-warning">{{ $cnq }}</span></h5></th>
            <th><h5><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></h5></th>
            <th><h5><span class="badge badge-danger">{{ $remaining }}</span></h5></th>
            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                {{ calculatePercentage($mql, $cql) }}
            </span></h5></th>
            <th><h5><span class="badge badge-success">{{ $inv }}</span></h5></th>
            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                {{ calculatePercentage($mql, $inv) }}
            </span></h5></th>
        </tr>

    </tfoot>
</table>
