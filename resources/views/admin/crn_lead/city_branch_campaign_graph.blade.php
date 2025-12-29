
<table class="table gy-4 gs-7">
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

        @foreach ($city_branch_camp_data as $key => $city)
            <tr class="cursor-pointer campaign-row toggle-sources" data-campaign-id="{{ $city['city_id'] }}" data-child-name="cities-row">
                @php
                    $mql = $city['mql'] ?? 0;
                    $cql = $city['cql'] ?? 0;
                    $cgi = $city['cgi'] ?? 0;
                    $cnq = $city['cnq'] ?? 0;
                    $unreachable = $city['unreach'] ?? 0;
                    $inv = $city['inv'] ?? 0;
                    $remaining = $city['pending_crm_leads'] ?? 0;


                @endphp
                <td colspan="2"><span style="float: left">{{ $city['city_name'] }}</span></td>
                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                <td><span class="badge badge-primary">0</span></td>
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
            @foreach($city['branches'] as $branch)
                <tr class="cities-row nested-sources toggle-child-sources" data-campaign-id="{{ $city['city_id'] }}" data-child-id="{{ $branch['branch_id'] }}" data-child-name="branches-row"
                style="cursor: pointer;display: none;
                {{ $loop->first ? 'border-top: 2px solid black;' : '' }}
                {{ $loop->last ? 'border-bottom: 2px solid black;' : '' }}">

                @php
                    $mql = $branch['mql'] ?? 0;
                    $cql = $branch['cql'] ?? 0;
                    $cgi = $branch['cgi'] ?? 0;
                    $cnq = $branch['cnq'] ?? 0;
                    $unreachable = $branch['unreach'] ?? 0;
                    $inv = $branch['inv'] ?? 0;
                    $remaining = $branch['pending_crm_leads'] ?? 0;
                @endphp

                <td colspan="2" style="border-left: 2px solid black;">
                    <span>{{ $branch['branch_name'] }}</span>
                </td>
                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                <td>0</td>
                <td><span class="badge badge-success">{{ $cql }}</span></td>
                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                <td>
                    <span class="badge" style="background-color: #002c5f !important;">
                        {{ calculatePercentage($mql, $cql) }}
                    </span>
                </td>
                <td><span class="badge badge-success">{{ $inv }}</span></td>
                <td style="border-right: 2px solid black;">
                    <span class="badge" style="background-color: #002c5f !important;">
                        {{ calculatePercentage($mql, $inv) }}
                    </span>
                </td>
            </tr>
                @foreach($branch['campaigns'] as $campaign)
                    <tr class="branches-row nested-sources" data-campaign-id="{{ $city['city_id'] }}" data-city-id="{{ $branch['branch_id']  }}"
                    style="display: none;background: antiquewhite;
                    {{ $loop->first ? 'border-top: 2px solid #b503ff;' : '' }}
                    {{ $loop->last ? 'border-bottom: 2px solid #b503ff;' : '' }}">

                    @php
                        $mql = $campaign['mql'] ?? 0;
                        $cql = $campaign['cql'] ?? 0;
                        $cgi = $campaign['cgi'] ?? 0;
                        $cnq = $campaign['cnq'] ?? 0;
                        $unreachable = $campaign['unreach'] ?? 0;
                        $inv = $campaign['inv'] ?? 0;
                        $remaining = $campaign['pending_crm_leads'] ?? 0;
                    @endphp

                    <td colspan="2" style="border-left: 2px solid #b503ff;">
                        <span>{{ $campaign['campaign_name'] }}</span>
                    </td>
                    <td><span class="badge badge-primary">{{ $mql }}</span></td>
                    <td>0</td>
                    <td><span class="badge badge-success">{{ $cql }}</span></td>
                    <td><span class="badge badge-info">{{ $cgi }}</span></td>
                    <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                    <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                    <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                    <td>
                        <span class="badge" style="background-color: #002c5f !important;">
                            {{ calculatePercentage($mql, $cql) }}
                        </span>
                    </td>
                    <td><span class="badge badge-success">{{ $inv }}</span></td>
                    <td style="border-right: 2px solid #b503ff;">
                        <span class="badge" style="background-color: #002c5f !important;">
                            {{ calculatePercentage($mql, $inv) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr style="background: #a36b4f">
            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
            @php
                $mql = collect($city_branch_camp_data)->sum('mql') ?? 0;
                $cql = collect($city_branch_camp_data)->sum('cql') ?? 0;
                $cgi = collect($city_branch_camp_data)->sum('cgi') ?? 0;
                $cnq = collect($city_branch_camp_data)->sum('cnq') ?? 0;
                $unreachable = collect($city_branch_camp_data)->sum('unreach') ?? 0;
                $inv = collect($city_branch_camp_data)->sum('inv') ?? 0;
                $remaining = collect($city_branch_camp_data)->sum('pending_crm_leads') ?? 0;
            @endphp
            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
            <th><h5><span class="badge badge-primary">{{    $total_percentage_value }}</span></h5></th>
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
