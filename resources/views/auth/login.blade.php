@extends('login_layouts.master')


@section('content')
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
							<!-- <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#"> -->
							<form  class="form w-100" method="POST" action="{{ route('login') }}">
                        		@csrf
								<!--begin::Heading-->
								<div class="text-center mb-11">
									<!--begin::Title-->
                                    <a href="#" class="mb-0 mb-lg-12">
                                        <img alt="Logo" src="{{ asset('admin_asset') }}/assets/media/logos/hyundai-logo.png"" class="h-60px h-lg-75px" />
                                    </a>
                                    <!--end::Title-->
								</div>
								<!--begin::Heading-->
									<!--begin::Login options-->
                                    <div class="row g-3 mb-9">
                                        <!--begin::Col-->
                                        <div class="col-md-12 text-center ">

                                            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Login options-->
								<!--begin::Separator-->
								{{-- <div class="separator separator-content my-14">
									<span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
								</div> --}}
								<!--end::Separator-->
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
									<input type="text" placeholder="Email" name="email" autocomplete="off" required class="form-control bg-transparent  @error('email') is-invalid @enderror" />
									@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                	@enderror
									<!--end::Email-->
								</div>
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
									<input type="password" placeholder="Password" name="password" autocomplete="off" required class="form-control bg-transparent   @error('password') is-invalid @enderror" />
									@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                	@enderror
									<!--end::Password-->
								</div>
								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<!--begin::Link-->
									{{-- <a href="#" class="link-primary">Forgot Password ?</a> --}}
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">Sign In</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>
								<!--end::Submit button-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Body-->
				<!--begin::Aside-->
				{{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-2 py-lg-15 px-5 px-md-15 w-100">
						<!--begin::Logo-->
						<a href="#" class="mb-0 mb-lg-12">
							<img alt="Logo" src="{{ asset('login_asset') }}/assets/media/logos/custom-1.png" class="h-60px h-lg-75px" />
						</a>
						<!--end::Logo-->
						<!--begin::Image-->
						<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('login_asset') }}/assets/media/misc/auth-screens.png" alt="" />
						<!--end::Image-->
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div> --}}
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
@endsection
