		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Rukada</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>

			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="/">
						<div class="parent-icon"><i class='bx bx-home-circle'></i></div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

				<li class="menu-label">Manage Products</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
						<li> <a href="/page/category"  ><i class="bx bx-right-arrow-alt"></i>Category</a></li>
						<li> <a href="/page/brand"  ><i class="bx bx-right-arrow-alt"></i>Brand</a></li>
						<li> <a href="/page/unit"  ><i class="bx bx-right-arrow-alt"></i>Unit</a></li>
						<li> <a href="/page/product"  ><i class="bx bx-right-arrow-alt"></i>Product</a></li>
					</ul>
				</li>


				<li class="menu-label">Manage Application</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Application</div>
					</a>
					<ul>
						<li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a></li>
						<li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a></li>
					</ul>
				</li>

			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->

@push('js')



@endpush()
		