@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 class="pull-right"> كل الطلبات</h1>
			<div class="btn-group pull-left">
				<button class="btn btn-info">الظهور على حسب </button>

				<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li>
						<a href="{{ url('/admin/orders/0') }}">
							<i class="glyphicon glyphicon-eye-open"></i>
							طلبات جديده
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/orders/1') }}">
							<i class="glyphicon glyphicon-eye-close"></i>
							طلبات قديمه
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/orders/2') }}">
							<i class="glyphicon glyphicon-time"></i>
							طلبات قيد التنفيذ
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/orders/4') }}">
							<i class="glyphicon glyphicon-ok"></i>
							طلبات منتهيه
						</a>
					</li>
					<li
					><a href="{{ url('/admin/orders/3') }}">
					<i class="glyphicon glyphicon-remove"></i>
					طلبات مرفوضه
				</a>
			</li>

			<li class="divider"></li>

			<li><a href="{{ url('/admin/orders/id-desc') }}">
				<i class="glyphicon glyphicon-circle-arrow-up"></i>

				المضاف اخيرا</a></li>
				<li><a href="{{ url('/admin/orders/id-asc') }}">
					<i class="glyphicon glyphicon-circle-arrow-down"></i>

					المضاف اولا</a></li>
					<li class="divider"></li>

					<li><a href="{{ url('/admin/orders/created_at-asc') }}">
						<i class="glyphicon glyphicon-calendar"></i>

						على حسب التاريخ الاقدم</a></li>
						<li><a href="{{ url('/admin/orders/created_at-desc') }}">
							<i class="glyphicon glyphicon-calendar"></i>

							على حسب التاريخ الاحدث</a></li>


							<li class="divider"></li>
						</ul>
					</div>

					
					<div class="btn-group pull-left" style="margin-left: 10px">
						<form action="{{ url('/admin/orders/search') }}" method="post" class="form-inline"  >
							{{ csrf_field() }}
							<input type="text" name="serach"  placeholder="بحث" class="form-control">
							<button type="submit"   class="btn btn-primary form-control">
								<i class="glyphicon glyphicon-search"></i>
								ابحث </button>

							</form>


						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">

								طلبات الخدمات
							</div>
						</div>
						<div class="bootstrap-admin-panel-content text-muted" >
							<table class="table bootstrap-admin-table-with-actions">
								<thead>
									<tr>
										<th>#</th>
										<th>اسم الخدمه</th>
										<th>صاحب الخدمه</th>
										<th>طالب الخدمه</th>
										<th>حاله الطلب</th>
										<th>تاريخ اضافه الخدمه</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $order)
									<tr>
										<td>{{$order->id}}</td>
										<td>
											<a href="{{ url('/admin/services/'.$order->service->id.'/edit') }}" >
												{{$order->service->name}}
											</a>
										</td>

										<td>
											<a href="{{ url('/admin/user/'.$order->GetUserAddSerivecs->id.'/edit') }}" >
												{{$order->GetUserAddSerivecs->name}}
											</a>
										</td>
										<td>
											<a href="{{ url('/admin/user/'.$order->GetMyOrders->id.'/edit') }}" >
												{{$order->GetMyOrders->name}}
											</a>
										</td>
										<td>
											@if($order->status == 0)
											<span class=" label label-info">
												طلب جديد
											</span>
											@elseif($order->status == 1)

											<span class="label label-default">
												طلب قديم
											</span>
											@elseif($order->status == 3)
											<span class="label label-danger">
												طلب ملغي
											</span>

											@elseif($order->status == 2)

											<span class="label label-warning">
												طلب قيد التنفيذ
											</span>
											@elseif($order->status == 4)

											<span class="label label-success">
												طلب منتهي
											</span>
											@endif
											
										</td>
										<td>{{ $order->created_at	}}</td>
										<td class="actions">
											
											<a href="{{ url('/admin/orders/'.$order->id.'/edit') }}" class="btn btn-sm btn-primary">
												<i class="glyphicon glyphicon-pencil"></i>
												تعديل
												
											</a>

											
											<a href="{{ url('/admin/orders/delete/'.$order->id) }}" class="btn btn-sm btn-danger">
												<i class="glyphicon glyphicon-trash"></i>
												حذف
												
											</a>
											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{$orders->render()}}
						</div>
					</div>
				</div>
			</div>
			@endsection