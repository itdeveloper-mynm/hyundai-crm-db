
<table class="table table-striped gy-4 gs-7">
    <thead>
        <tr  style="background: #A0C5E8;">
            <th class="w-150px" colspan="2">
                <h5><span style="float: left">Name</span></h5>
            </th>
            <th class="w-150px"><h5><span style="float: left">Email</span></h5></th>
            <th class="w-150px"><h5><span style="float: left">Whatsapp</span></h5></th>
            <th class="w-150px"><h5><span style="float: left">Inbound</span></h5></th>
            <th class="w-150px"><h5><span style="float: left">Outbound</span></h5></th>
            <th class="w-150px"><h5><span style="float: left">Other Sources</span></h5></th>
            <th class="w-150px"><h5><span style="float: left">Total</span></h5></th>
        </tr>
    </thead>
    <tbody>
        @php
            $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
        @endphp
        @foreach ($crm_users_source_graph as $key => $crm_users)
        <tr class="cursor-pointer">
            @php
                $email = $crm_users['email_count'] ?? 0;
                $whatsapp = $crm_users['whatsapp_count'] ?? 0;
                $inbound = $crm_users['inbound_count'] ?? 0;
                $outbound = $crm_users['outbound_count'] ?? 0;
                $other = $crm_users['other_count'] ?? 0;
                $total = $email + $whatsapp + $inbound + $outbound + $other;
            @endphp

            <td colspan="2">
                <span>{{ $crm_users['updatedby']['name'] ?? "" }}</span>
            </td>
            <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $email }}</span></td>
            <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $whatsapp }}</span></td>
            <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $inbound }}</span></td>
            <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $outbound }}</span></td>
            <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $other }}</span></td>
            <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $total }}</span></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="background: #8FBC8F;">
            @php
                $emailTotal = collect($crm_users_source_graph)->sum('email_count') ?? 0;
                $whatsappTotal = collect($crm_users_source_graph)->sum('whatsapp_count') ?? 0;
                $inboundTotal = collect($crm_users_source_graph)->sum('inbound_count') ?? 0;
                $outboundTotal = collect($crm_users_source_graph)->sum('outbound_count') ?? 0;
                $otherTotal = collect($crm_users_source_graph)->sum('other_count') ?? 0;
                $grandTotal = $emailTotal + $whatsappTotal + $inboundTotal + $outboundTotal + $otherTotal;
            @endphp

            <th colspan="2">
                <h5><span>Total Count</span></h5>
            </th>
            <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $emailTotal }}</span></h5></th>
            <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $whatsappTotal }}</span></h5></th>
            <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $inboundTotal }}</span></h5></th>
            <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $outboundTotal }}</span></h5></th>
            <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $otherTotal }}</span></h5></th>
            <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $grandTotal }}</span></h5></th>
        </tr>

    </tfoot>
</table>
