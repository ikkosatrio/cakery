<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta property="og:title" content="{{$config->name}}">
	<meta property="og:description" content="{{$config->description}}">
	<meta property="og:image" content="{{$config->LogoPath}}">
	<meta property="og:image" content="{{$config->FaviconPath}}">
	<meta property="og:url" content="{{ url('/') }}">
	<meta name="description" content="{{$config->description}}">
	<link rel="shortcut icon" href="{{$config->FaviconPath}}">
	<title>{{$config->name}} - @yield('title')</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ url('public/assets/admin') }}/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/assets/admin') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="{{ url('public/assets/admin') }}/assets/css/core.min.css" rel="stylesheet" type="text/css">

	<link href="{{ url('public/assets/admin') }}/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/assets/admin') }}/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/assets/admin') }}/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/assets/admin') }}/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/assets/admin') }}/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css" integrity="sha512-uMIpMpgk4n6esmgdfJtATLLezuZNRb96YEgJXVeo4diHFOF/gqlgu4Y5fg+56qVYZfZYdiqnAQZlnu4j9501ZQ==" crossorigin="anonymous" />
	<link href="{{ url('public/assets/admin') }}/assets/css/cakcode.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script src="{{ url('public/assets/admin') }}/assets/js/main/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/uploaders/dropzone.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/notifications/noty.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/plugins/forms/styling/switch.min.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/app.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/extra_jgrowl_noty.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/extra_sweetalert.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/dashboard.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/uploader_bootstrap.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/datatables_basic.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/form_select2.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/editor_ckeditor.js"></script>
	<script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/form_checkboxes_radios.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js" integrity="sha512-VHsNaV1C4XbgKSc2O0rZDmkUOhMKPg/rIi8abX9qTaVDzVJnrDGHFnLnCnuPmZ3cNi1nQJm+fzJtBbZU9yRCww==" crossorigin="anonymous"></script>
	<script src="{{ url('public') }}/js/cakcode.js"></script>
	{{-- <script src="{{ url('public/assets/admin') }}/assets/js/demo_pages/datatables_basic.js"></script> --}}
	<!-- /theme JS files -->
    @yield('css')
	<style>
		/* Always set the map height explicitly to define the size of the div
		* element that contains the map. */
		#map {
			height: 100%;
		}
		/* Optional: Makes the sample page fill the window. */
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}


	</style>
</head>
<body>
	<div class="page-content">

		<!-- Main content -->
		@yield('content')
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>
