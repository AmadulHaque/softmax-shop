<!doctype html>
<html lang="en">

@include('layouts.header')
@viteReactRefresh
@vite(['resources/js/app.js','resources/css/app.css'])
<body>
	<!--wrapper-->
	<div class="wrapper">

		<!--sidebar wrapper -->
        @include('layouts.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
        @include('layouts.navbar')
		<!--end header -->
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div id="PageLoadData" class="page-content">
				@yield('content')
			</div>
		</div>
		<!--end page wrapper -->
	</div>
	<!--end wrapper-->
    @include('layouts.footer')
	@stack('js')
</body>
</html>