<!doctype html>
<html lang="en">

@include('layouts.header')
{{-- @viteReactRefresh
@vite(['resources/js/app.js','resources/css/app.css']) --}}

<script src="../assets/js/Toast.js"></script> 
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
		<div id="LoadingOverlay" class="LoadingOverlay d-none">
			<div class="Line-Progress">
				<div class="indeterminate"></div>
			</div>
		</div>
	</div>
	<!--end wrapper-->
    @include('layouts.footer')
	<script>
		$(document).ready(function(){

			function ToastFun(text,status){
				Toastify({
					text: text,
					duration: 3000,
					newWindow: true,
					close: true,
					className: "info",
					gravity: "bottom", 
					position: "center", 
					stopOnFocus: true, 
					// style: {
					//     background: "#00b09b",
					// },
				}).showToast();
			}
		})
	</script>
	@stack('js')

	
</body>
</html>