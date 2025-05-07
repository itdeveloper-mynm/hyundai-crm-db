<div class="row gx-5 gx-xl-10 mt-5 bank-section">
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 31-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-7 mb-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">City ({{collect($citygraph)->sum('count') ?? 0}})</span>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body align-items-end pt-0">
                <!--begin::Chart-->
                    <div class="tab-content" id="campaignTabsContent">
                        <!-- Backtoschool-2024 Content -->
                        <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel" aria-labelledby="tab-backtoschool">
                            <table class="table table-striped gy-4 gs-7">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                                    <h5><span style="float: left">Current Cities</span></h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                    @endphp
                                    @foreach ($citygraph as $key => $campaign_wise)
                                        <tr class="city_wise_row cursor-pointer" data-id="{{ $key }}">
                                            <td colspan="2"><span style="float: left"> {{ $campaign_wise['name'] ?? '' }}</span>
                                                            <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                            </td>
                                        </tr>

                                        <textarea id="city_wise_detials_{{ $key }}" style="display: none">
                                            <table class="table table-striped gy-4 gs-7">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">
                                                                    <h5><span style="float: left">{{ $campaign_wise['name'] ?? '' }}</span></h5>
                                                                    <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($campaign_wise['branches'] as $source_data)
                                                        @if (isset($source_data))
                                                        <tr class="cursor-pointer">
                                                            <td colspan="2"><span style="float: left"> {{ $source_data['name'] ?? '' }}</span>
                                                                            <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $source_data['count'] ?? 0 }}</span>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </textarea>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Chart widget 31-->
    </div>
    <!--end::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 31-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-7 mb-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Branches</span>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body align-items-end pt-0">
                <!--begin::Chart-->
                    <div class="tab-content" id="campaignTabsContent">
                        <!-- Backtoschool-2024 Content -->
                        <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel" aria-labelledby="tab-backtoschool">
                            <div id="branch_detials_div"></div>
                        </div>
                    </div>
                <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Chart widget 31-->
    </div>

</div>
