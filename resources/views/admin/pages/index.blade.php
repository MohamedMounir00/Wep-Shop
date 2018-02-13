@extends('admin.layouts.layouts')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>
				رئيسيه لوحه التحكم
			</h1>
		</div>
	</div>
</div>
<div class="row">

	<div class="col-lg-6">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="text-muted bootstrap-admin-box-title">

							الارباح
						</div>
					</div>
					<div class="bootstrap-admin-panel-content text-muted" >
						<ul>
							<li>
								الارباح الكليه للموقع
								:
								{{$websiteprofit}}
								$


							</li>
							<li>
								الارباح المرسله للاعضاء
								:
								{{$userprofit}}
								$


							</li>
						</ul>



					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="text-muted bootstrap-admin-box-title">

							الخدمات
						</div>
					</div>
					<div class="bootstrap-admin-panel-content text-muted" >
						<ul>
							<li>
								<a href="{{ url('/admin/services') }}">		

									الخدمات الكليه
									{{$services}}
								</a>

							</li>
							<li>
								<a href="{{ url('/admin/services/1') }}">		

									الخدمات المفعله
									{{$servicesDone}}
								</a>
							</li>
							<li>
								<a href="{{ url('/admin/services/0') }}">		
									الخدمات غير المفعله
									{{$servicesWaiting}}
								</a>
							</li>
						</ul>


					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-lg-6">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="text-muted bootstrap-admin-box-title">

							الطلبات
						</div>
					</div>
					<div class="bootstrap-admin-panel-content text-muted" >
						<ul>
							<li>
								<a href="{{ url('/admin/orders') }}">		

									كل الطلبات
									{{$orders}}
								</a>

							</li>
							<li>
								<a href="{{ url('/admin/orders/0') }}">		
									طلب جديد
									{{$orderNew}}

								</a>


							</li>
							<li>
								<a href="{{ url('/admin/orders/4') }}">		

									طلب قديم
									{{$orderOld}}
								</a>
								



							</li>	
							<li>
								<a href="{{ url('/admin/orders/3') }}">		
									طلب ملغي
									{{$orderCansel}}

								</a>



							</li>
							<li>
								<a href="{{ url('/admin/orders/2') }}">		
									طلب قيد التنفيذ

									{{$orderWatiing}}

								</a>



							</li>	
							<li>
								<a href="{{ url('/admin/orders/1') }}">		
									طلب منتهي
									{{$orderDone}}

								</a>



							</li>
						</ul>



					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="text-muted bootstrap-admin-box-title">

							الاعضاء
						</div>
					</div>
					<div class="bootstrap-admin-panel-content text-muted" >
						<ul>
							<li>
								<a href="{{ url('/admin/user') }}">		

									كل الاعضاء								
									{{$Allusers}}
								</a>

							</li>
							<li>
								<a href="{{ url('/admin/user/1') }}">		

									المدرين
									{{$usersM}}
									
								</a>
							</li>
							<li>
								<a href="{{ url('/admin/user/0') }}">		

									الاعضاء
									{{$users}}
									
								</a>
							</li>
						</ul>



					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection