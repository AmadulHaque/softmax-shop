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

				<li>
					<a href="/page/pos">
						<div class="parent-icon"><i class="lni lni-customer"></i></div>
						<div class="menu-title">POS</div>
					</a>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-cart"></i></div>
						<div class="menu-title">Manage Order </div>
					</a>
					<ul>
						<li> <a href="/page/customer"><i class="bx bx-right-arrow-alt"></i>All Customer</a></li>
						<li> <a href="/page/order/new"><i class="bx bx-right-arrow-alt"></i>New Order</a></li>
						<li> <a href="/page/order"><i class="bx bx-right-arrow-alt"></i>Complete Order</a></li>
						<li> <a href="/page/order/cancle"><i class="bx bx-right-arrow-alt"></i>Cancle Order</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-paypal"></i></div>
						<div class="menu-title">Manage Product</div>
					</a>
					<ul>
						<li> <a href="/page/product"  ><i class="bx bx-right-arrow-alt"></i>Product</a></li>
						<li> <a href="/page/ProductDetail"  ><i class="bx bx-right-arrow-alt"></i>Product-Details</a></li>
						<li> <a href="/page/category"  ><i class="bx bx-right-arrow-alt"></i>Category</a></li>
						<li> <a href="/page/brand"  ><i class="bx bx-right-arrow-alt"></i>Brand</a></li>
						<li> <a href="/page/unit"  ><i class="bx bx-right-arrow-alt"></i>Unit</a></li>
						<li> <a href="/page/pdimporant"  ><i class="bx bx-right-arrow-alt"></i>PD-Imporant</a></li>
						<li> <a href="/page/pdlearn"  ><i class="bx bx-right-arrow-alt"></i>PD-Learn</a></li>
						<li> <a href="/page/BookReview"  ><i class="bx bx-right-arrow-alt"></i>Book Review</a></li>
						<li> <a href="/page/BookNews"  ><i class="bx bx-right-arrow-alt"></i>Book News</a></li>
						<li> <a href="/page/Gift"  ><i class="bx bx-right-arrow-alt"></i>Gift</a></li>
						<li> <a href="/page/QuationAns"  ><i class="bx bx-right-arrow-alt"></i>QA-Manage</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-cart-full"></i></div>
						<div class="menu-title">Manage Purchase</div>
					</a>
					<ul>
						<li> <a href="/page/supplier"><i class="bx bx-right-arrow-alt"></i>All Supplier</a></li>
						<li> <a href="/page/purchase"><i class="bx bx-right-arrow-alt"></i>All Purchase</a></li>
						<li> <a href="/page/purchase/add"><i class="bx bx-right-arrow-alt"></i>Add Purchase</a></li>
						<li> <a href="/page/purchase/pending"><i class="bx bx-right-arrow-alt"></i>Purchase Pending</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-cart-full"></i></div>
						<div class="menu-title">Manage Stcok</div>
					</a>
					<ul>
						<li> <a href="a"><i class="bx bx-right-arrow-alt"></i>Stcok Report</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-cart-full"></i></div>
						<div class="menu-title">Manage Stcok</div>
					</a>
					<ul>
						<li> <a href="a"><i class="bx bx-right-arrow-alt"></i>Stcok Report</a></li>
					</ul>
				</li>


			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->

@push('js')



@endpush()
		