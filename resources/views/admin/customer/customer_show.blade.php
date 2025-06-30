@extends('layouts.master')

@section('title', 'Contact Detials')

@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container ">

            <form class="form d-flex flex-column flex-lg-row" >
            {{-- <form class="form d-flex flex-column flex-lg-row" style="pointer-events: none;"> --}}

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">

                                <div class="card card-flush py-4">

                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Contact Detials') }}</h2>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="row ">
                                            <div class="col-lg-6">
                                                <div class="alert alert-info alert-dismissible">
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="alert"></button>
                                                    <strong>This contact has <a target="_blank" href="{{ route("crm-leads.index") }}?mobile={{$customer->mobile}}&date=0">{{ $customer->applications()->count() ?? 0 }} leads</a> associated with
                                                        it.</strong>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-flex justify-content-end">

                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('First Name') }}</label>
                                                <input type="text" name="first_name" id="first_name"
                                                    value="{{ $customer->first_name }}" class="form-control mb-2"
                                                    required />
                                            </div>
                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('Last Name') }}</label>
                                                <input type="text" name="last_name" id="last_name"
                                                    value="{{ $customer->last_name }}" class="form-control mb-2" required />
                                            </div>

                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('Mobile') }}</label>
                                                <small>Please follow the format: (966123456789)</small>
                                                <input type="number" name="mobile" id="mobile"
                                                    value="{{ ltrim($customer->mobile, '+') }}" class="form-control mb-2"
                                                    required pattern="[0-9]{9,14}"
                                                    title="Mobile number must be between 9 and 12 digits"
                                                    placeholder="e.g., 966123456789"
                                                    oninput="validity.valid||(value='');" />
                                            </div>
                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('Email') }}</label>
                                                <input type="email" name="email" id="email"
                                                    value="{{ $customer->email }}" class="form-control mb-2" required />
                                            </div>

                                        </div>

                                        <div class="row mt-5">

                                            <div class="mb-5 fv-row col-lg-6">
                                                <label class="form-label">{{ __('Customers Bank') }}</label>
                                                <select class="form-select mb-2" name="bank_id" data-control="select2"
                                                    data-placeholder="{{ __('select option') }}" data-allow-clear="true">
                                                    <option value=""></option>
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}" @selected($bank->id == $customer->bank_id)>
                                                            {{ $bank->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')

<script>
    document.querySelectorAll('form input, form select, form textarea').forEach(function(element) {
  element.disabled = true;
});
</script>

@endsection
