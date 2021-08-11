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
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="{{route('admin.dashboard')}}" class="d-inline-block">
				<img src="{{$config->LogoPath}}" style="height:30px;" alt="">
			</a>
		</div>
		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-mobile">
			<span class="navbar-text ml-md-3 mr-md-auto">
				<span class="badge bg-success">Online</span>
			</span>
			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="{{ url('public/assets/admin') }}/images/placeholders/placeholder.jpg" class="rounded-circle" alt="">
						<span>{{ Auth::user()->name }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-divider"></div>
						<a href="{{ route('admin.user.destroy', Auth::user()->id) }}" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->
			<!-- Sidebar content -->
			<div class="sidebar-content">
				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="{{ url('public/assets/admin') }}/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>
							<div class="media-body">
								<div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;{{ Auth::user()->email }}
								</div>
							</div>
							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->
				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active':'' }}">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link {{ Request::segment(2) == 'config' || Request::segment(2) == 'website' ? 'active':'' }}"><i class="icon-gear"></i> <span>Setting</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="{{ route('admin.config.index') }}" class="nav-link {{ Request::segment(2) == 'config' ? 'active':'' }}">Config</a></li>
								<li class="nav-item"><a href="{{ route('admin.profile.index') }}" class="nav-link {{ Request::segment(2) == 'profile' ? 'active':'' }}">Website</a></li>
							</ul>
						</li>
						<li class="nav-item"><a href="{{ route('admin.slide.index') }}" class="nav-link {{ Request::segment(2) == 'slide' ? 'active':'' }}"><i class="icon-images2"></i> <span>Slider</span></a></li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link {{ Request::segment(2) == 'user' || Request::segment(2) == 'group' ? 'active':'' }}"><i class="icon-users"></i> <span>Users</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Pickers">
								<li class="nav-item"><a href="{{ route('admin.user.index') }}" class="nav-link {{ Request::segment(2) == 'user' ? 'active':'' }}">User</a></li>
								<li class="nav-item"><a href="{{ route('admin.group.index') }}" class="nav-link {{ Request::segment(2) == 'group' ? 'active':'' }}">Group</a></li>
							</ul>
						</li>

						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Website</div> <i class="icon-menu" title="Website"></i></li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link {{ Request::segment(2) == 'home' || Request::segment(2) == 'visi-misi' ? 'active':'' || Request::segment(2) == 'struktur' ? 'active':'' || Request::segment(2) == 'logo' ? 'active':'' || Request::segment(2) == 'contoh-sertifikat' ? 'active':'' || Request::segment(2) == 'regulasi' ? 'active':'' }}"><i class="icon-magazine"></i> <span>Pages</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="{{ route('admin.home.index') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active':'' }}">Home</a></li>
								<li class="nav-item"><a href="{{ route('admin.cakemenu.index') }}" class="nav-link {{ Request::segment(2) == 'cakemenu' ? 'active':'' }}">Cake Menu</a></li>
								<li class="nav-item"><a href="{{ route('admin.confection.index') }}" class="nav-link {{ Request::segment(2) == 'confection' ? 'active':'' }}">Confection</a></li>
							</ul>
						</li>
						<li class="nav-item"><a href="{{ route('admin.faq.index') }}" class="nav-link"><i class="icon-help"></i> <span>FAQ's</span></a></li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link {{ Request::segment(2) == 'gallery' || Request::segment(2) == 'gallery-category' ? 'active':'' }}"><i class="icon-magazine"></i> <span>Gallery</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="{{ route('admin.gallery.index') }}" class="nav-link {{ Request::segment(2) == 'gallery' ? 'active':'' }}">Gallery</a></li>
								<li class="nav-item"><a href="{{ route('admin.gallery-category.index') }}" class="nav-link {{ Request::segment(2) == 'gallery-category' ? 'active':'' }}">Category Gallery</a></li>
							</ul>
						</li>
						<li class="nav-item"><a href="{{ route('admin.client.index') }}" class="nav-link"><i class="icon-users"></i> <span>Client</span></a></li>
						<li class="nav-item"><a href="{{ route('admin.appointment.index') }}" class="nav-link"><i class="icon-envelope"></i> <span>Appointment</span></a></li>
						<!-- /main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Shop</div> <i class="icon-menu" title="Shop"></i></li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link {{ Request::segment(2) == 'product' || Request::segment(2) == 'product_category'}}"><i class="icon-magazine"></i> <span>Product</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="{{ route('admin.product.index') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active':'' }}">Master Product</a></li>
								<li class="nav-item"><a href="{{ route('admin.product-category.index') }}" class="nav-link {{ Request::segment(2) == 'home' ? 'active':'' }}">Product Categoty</a></li>
							</ul>
						</li>
						<li class="nav-item"><a href="{{ route('admin.order.index') }}" class="nav-link"><i class="icon-cart"></i> <span>Order</span></a></li>

						<!-- Forms -->
						<!-- /forms -->
						<!-- Components -->
						<!-- /page kits -->
					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- /main sidebar -->
		<!-- Main content -->
		@yield('content')
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>
