<div class="row gx-5 gx-xl-10 mt-10 bank-section">
    <!--begin::Col-->
    <div class="col-xl-6">
        <!--begin::Chart widget 31-->
        <div class="card card-flush h-xl-100">
            <!--begin::Header-->
            <div class="card-header pt-7 mb-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Vehicles Interested ({{collect($vehcile_graph['vehicle_count'])->sum() ?? 0}})</span>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body align-items-end pt-0">
                <!--begin::Chart-->
                    <div class="tab-content">
                        <!-- Backtoschool-2024 Content -->
                        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-backtoschool">
                            <table class="table table-striped gy-4 gs-7">
                                <tbody>
                                    @php
                                        $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                    @endphp
                                    @foreach ($vehcile_graph['vehicle_names'] as $key => $vehcile)
                                    {{-- {{dd($vehcile_graph['vehicle_names'],$vehcile_graph['vehicle_count'])}} --}}
                                        <tr class="" data-id="{{ $key }}">
                                            <td colspan="2"><span style="float: left"> {{ $vehcile ?? '' }}</span>
                                                            <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $vehcile_graph['vehicle_count'][$key] ?? 0 }}</span>
                                            </td>
                                        </tr>
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
                    <span class="card-label fw-bold text-gray-800">Banks  ({{collect($banks_graph)->sum('count') ?? 0}})</span>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
                    <div class="card-body pt-5">
                        @foreach ($banks_graph as $bank)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <span
                                        class="text-black fw-semibold fs-6 me-2">{{ $bank['bank_name'] ?? '' }}</span>
                                    <!--end::Section-->
                                    <!--begin::Action-->
                                    <span
                                        class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                        <span
                                            class="badge py-3 px-4 fs-7 badge-light-primary">{{ $bank['count'] ?? 0 }}</span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->
                        @endforeach
                    </div>
            <!--end::Body-->
        </div>
        <!--end::Chart widget 31-->
    </div>

</div>
