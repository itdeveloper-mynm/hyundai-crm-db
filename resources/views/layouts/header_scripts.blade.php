<head><base href=""/>
		<title>@yield('title')</title>
		<meta charset="utf-8" />
		<meta name="description" content="{{env('APP_NAME')}}" />
		<meta name="keywords" content="{{env('APP_NAME')}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="{{env('APP_NAME')}}" />
		<meta property="og:url" content="{{env('APP_URL')}}" />
		<meta property="og:site_name" content="{{env('APP_NAME')}}" />
		<link rel="canonical" href="{{env('APP_URL')}}" />
		{{-- <link rel="shortcut icon" href="{{ asset('login_asset') }}/assets/media/logos/favicon.ico" /> --}}
		<link rel="shortcut icon" href="{{asset('admin_asset/assets/media/logos/new-favicon.jpeg')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('login_asset') }}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('login_asset') }}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('login_asset') }}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('login_asset') }}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />

        @yield('header-js')
		<!--end::Global Stylesheets Bundle-->
		<style>
			.error {
				color: red;
			}
			div.dt-buttons{
				display: none !important;
			}

			#user_table_filter{
				display: none !important;
			}
		</style>
	</head>
