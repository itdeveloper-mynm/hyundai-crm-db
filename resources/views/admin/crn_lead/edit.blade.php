@extends('layouts.master')


@section('title', 'Crm Lead Edit')

@section('content')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container ">

    <form class="form d-flex flex-column flex-lg-row" method="post" id="myForm">
            @csrf
            @method('PUT')

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Crm Lead Edit') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name" value="{{$lead->customer->first_name}}" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" id="last_name" value="{{$lead->customer->last_name}}" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Mobile') }}</label>
                                            <input type="text" disabled value="{{$lead->customer->mobile}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" value="{{$lead->customer->email}}"  class="form-control mb-2"
                                                required />
                                        </div>


                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="form-label">{{ __('Gender') }}</label>
                                                <select class="form-select mb-2" name="gender" id="gender"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Male" @selected($lead->customer->gender == 'Male')>Male</option>
                                                <option value="Female"  @selected($lead->customer->gender == 'Female')>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('National Id') }}</label>
                                            <input type="text" name="national_id" id="national_id" value="{{$lead->customer->national_id}}"  pattern="(\d{10}|0)" class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Dealer City') }}</label>
                                            <select class="form-select mb-2" name="city_id" id="city_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true"    data-page_type ="sales">
                                                <option value=""></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @selected($lead->city_id==$city->id)>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Dealer Branch') }}</label>
                                            <select class="form-select mb-2" name="branch_id" id="branch_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{$branch->id}}"  @selected($lead->branch_id==$branch->id)>{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Vehicle') }}</label>
                                            <select class="form-select mb-2" name="vehicle_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}" @selected($lead->vehicle_id==$vehicle->id)>{{$vehicle->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Year') }}</label>
                                                <select class="form-select mb-2" name="yearr" id="yearr"  required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Used Car">Used Car</option>
                                                <option value="2023" @selected($lead->yearr == '2023')>2023</option>
                                                <option value="2024" @selected($lead->yearr == '2024')>2024</option>
                                                <option value="2025" @selected($lead->yearr == '2025')>2025</option>
                                                <option value="2026" @selected($lead->yearr == '2026')>2026</option>
                                                <option value="2027" @selected($lead->yearr == '2027')>2027</option>
                                                <option value="2028" @selected($lead->yearr == '2028')>2028</option>
                                                <option value="2029" @selected($lead->yearr == '2029')>2029</option>
                                                <option value="2030" @selected($lead->yearr == '2030')>2030</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Intention to Buy') }}</label>
                                            <select class="form-select mb-2" name="purchase_plan" id="purchase_plan"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                    <option value=""></option>
                                                    <option value="1 month"  @selected($lead->purchase_plan=='1 month')>1 month</option>
                                                    <option value="2-3 month"  @selected($lead->purchase_plan=='2-3 month')>2-3 month</option>
                                                    <option value="After 3 month"  @selected($lead->purchase_plan=='After 3 month')>After 3 month</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Monthly Salary') }}</label>
                                            <select class="form-select mb-2" name="monthly_salary" id="monthly_salary"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="Between 5,000 and 10,000" @selected($lead->monthly_salary=='Between 5,000 and 10,000')>Between 5,000 and 10,000</option>
                                                    <option value="Above 10,000" @selected($lead->monthly_salary=='Above 10,000')>Above 10,000</option>
                                                    <option value="Cash Deal" @selected($lead->monthly_salary=='Cash Deal')>Cash Deal</option>
                                            </select>
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Customers Bank') }}</label>
                                            <select name="bank_id" id="bank_id" class="form-select mb-2"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" @selected($lead->customer->bank_id==$bank->id)>{{$bank->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                            <div class="mb-5 fv-row col-lg-6">
                                                <label class="required form-label">{{ __('Source') }}</label>
                                                <select class="form-select mb-2" name="source_id" required="required"
                                                    data-control="select2" data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true">
                                                    <option value=""></option>
                                                    @foreach ($sources as $source)
                                                        @if(in_array($source->name, ['Email', 'Whatsapp', 'Inbound','Outbound']))
                                                        <option value="{{$source->id}}"  @selected($lead->source_id==$source->id)>{{$source->name}}</option>
                                                        @endif
                                                        @endforeach
                                                </select>
                                            </div>

                                        {{-- <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.campaign' ,[ 'required' =>true, 'data' => $lead ])
                                        </div> --}}
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Preferred Time to contact') }}</label>
                                            <select class="form-select mb-2" name="preferred_appointment_time" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="Morning (08:00AM~12:00PM)"  @selected($lead->preferred_appointment_time=='Morning (08:00AM~12:00PM)')>Morning (08:00AM~12:00PM)</option>
                                                    <option value="Afternoon (12:00PM~04:00PM)"  @selected($lead->preferred_appointment_time=='Afternoon (12:00PM~04:00PM)')>Afternoon (12:00PM~04:00PM)</option>
                                                    <option value="Any Time"  @selected($lead->preferred_appointment_time=='Any Time')>Any Time</option>
                                            </select>
                                        </div>


                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Category') }}</label>
                                            <select class="form-select mb-2" name="category" id="category" onchange="updateSubCategory()" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                    <option value=""></option>
                                                    <option value="Qualified"  @selected($lead->category=='Qualified')>Qualified</option>
                                                    <option value="Not Qualified" @selected($lead->category=='Not Qualified')>Not Qualified</option>
                                                    <option value="General Inquiry" @selected($lead->category=='General Inquiry')>General Inquiry</option>
                                            </select>
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Sub Category') }}</label>
                                            <select class="form-select mb-2" name="sub_category" id="sub_category" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                    <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('KYC') }}</label>
                                            <select class="form-select mb-2" name="kyc" id="kyc" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                    <option value=""></option>
                                                    <option value="Social Media" @selected($lead->kyc=='Social Media')>Social Media</option>
                                                    <option value="Friends & Relative">  @selected($lead->kyc=='Friends & Relative')Friends & Relative</option>
                                                    <option value="Outdoor Advertisement" @selected($lead->kyc=='Outdoor Advertisement')>Outdoor Advertisement</option>
                                                    <option value="Influencer" @selected($lead->kyc=='Influencer')>Influencer</option>
                                                    <option value="Others" @selected($lead->kyc=='Others')>Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-12">
                                            <label class="form-label">{{ __('Comments') }}</label>
                                            <textarea name="comments" id="comments" class="form-control" cols="30" rows="5">{{$lead->comments}}</textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark btn_submit sub_button" disabled
                                        id="btnSubmit" style="background-color: #000044">
                                        <span class="indicator-label">{{ __('Save') }}</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
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

<script src="{{ asset('ajx_files/ajx.js') }}"></script>

<script>
$(document).ready(function() {

    $("#myForm").validate({
        ignore: [],
        rules: {
            'status': {
                required: true,
            },
            'mobile': {
                required: true,
                remote: {
                    url: "{{ route('check.name.exist') }}",
                    type: "get",
                    data: {
                        mobile: function(data) {
                            return $('#mobile').val();
                        },
                        check: function(data) {
                            return "{{$lead->customer_id}}";
                        },
                        tableName: function(data) {
                            return 'customers';
                        },
                        fieldName: function(data) {
                            return 'mobile';
                        },

                    }
                }
            },
        },
        messages: {
            'status': {
                'required': "{{ __('status field is required') }}"
            },
            mobile: {
                remote: "Mobile Already Exists",

            },
        },

        submitHandler: function(form) {

            $('.indicator-label').css({
                'display': 'none'
            });
            $('.indicator-progress').css({
                'display': 'inline-block'
            });
            $('.sub_button').attr('disabled', true);


            var form = $('#myForm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('crm-leads.update', [$lead->id]) }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                beforeSubmit: function() {

                    $("body").addClass("loading");

                },
                success: function(data) {

                    if (data.result == 'success') {
                        Swal.fire(
                            "{{ __('Updated') }}",
                            data.message,
                            data.result,
                        )

                        window.location.href = "{{route('crm-leads.index')}}";

                    }
                    if (data.result == 'error') {
                        Swal.fire(
                            "{{ __('not_add') }}",
                            "{{ __('not_add') }}",
                            data.result
                        )
                    }
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        }
    })

    $(".sub_button").prop("disabled", false);

    updateSubCategory();
})

function getCategories(){
  const categories = {
    'Qualified': ['New Leads', 'Follow Up', 'Lead - Test Drive'],
    'General Inquiry': [
        'Timing & Locations',
        'Inquiry - Another Company',
        'Product Specification',
        'Price',
        'Showroom Numbers',
        'Not interested',
        'Already bought',
        'Wrong Number',
        'Callback'
    ],
    'Not Qualified': [
      'Salary does not allow financing',
      'High Commitment',
      'High-Prices',
      'Traffic Violations'
    ]
  };

  return categories;
}

function updateSubCategory() {
  const selectedCategory = $('#category').val(); // Renamed to selectedCategory
  const subCategory = $('#sub_category');
  const selectedSubCategory =   "{{$lead->sub_category}}";

  let options = '';

  const categories = getCategories(); // Changed from const category to const categories

  if (selectedCategory in categories) { // Changed from category to selectedCategory
    const optionsArray = categories[selectedCategory]; // Changed from categories[category] to categories[selectedCategory]
    optionsArray.forEach(option => {
      //options += `<option value="${option}">${option}</option>`;

      if (option === selectedSubCategory) {
        options += `<option value="${option}" selected>${option}</option>`;
      } else {
        options += `<option value="${option}">${option}</option>`;
      }

    });
  }

  subCategory.html(options);
}




</script>
@endsection
