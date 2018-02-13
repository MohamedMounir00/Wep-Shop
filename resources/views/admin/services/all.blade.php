@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 class="pull-right"> كل الخدمات</h1>
			<div class="btn-group pull-left">
				<button class="btn btn-info">الظهور على حسب </button>

				<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="{{ url('/admin/services/0') }}">
						<i class="glyphicon glyphicon-time"></i>

						خدمات قيد الانتظار</a></li>
						<li><a href="{{ url('/admin/services/1') }}">
							<i class="glyphicon glyphicon-ok"></i>
							خدمات تم الموافقه عليها</a></li>

							<li class="divider"></li>

							<li><a href="{{ url('/admin/services/id-desc') }}">
								<i class="glyphicon glyphicon-circle-arrow-up"></i>

								المضاف اخيرا</a></li>
								<li><a href="{{ url('/admin/services/id-asc') }}">
									<i class="glyphicon glyphicon-circle-arrow-down"></i>

									المضاف اولا</a></li>
									<li class="divider"></li>

									<li><a href="{{ url('/admin/services/created_at-asc') }}">
										<i class="glyphicon glyphicon-calendar"></i>

										على حسب التاريخ الاقدم</a></li>
										<li><a href="{{ url('/admin/services/created_at-desc') }}">
											<i class="glyphicon glyphicon-calendar"></i>

											على حسب التاريخ الاحدث</a></li>


											<li class="divider"></li>
										</ul>
									</div>

									<div class="btn-group pull-left" style="margin-left: 10px">
										<button class="btn btn-success">القسم </button>

										<button data-toggle="dropdown" class="btn btn-success dropdown-toggle"> <span class="caret"></span></button>
										<ul class="dropdown-menu">
											@foreach($cat as $c)
											<li><a href="{{ url('/admin/services/cat-'.$c->id) }}">
												<i class="glyphicon glyphicon-tag"></i>
												{{ $c->name}}
											</a></li>
											@endforeach
											<li class="divider"></li>
										</ul>
									</div>
									<div class="btn-group pull-left" style="margin-left: 10px">
										<form action="{{ url('/admin/services') }}" method="post" class="form-inline"  >
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

												الخدمات المضافه
											</div>
										</div>
										<div class="bootstrap-admin-panel-content text-muted" >
											<table class="table bootstrap-admin-table-with-actions">
												<thead>
													<tr>
														<th>#</th>
														<th>اسم الخدمه</th>
														<th>صاحب الخدمه</th>
														<th>عدد مرات البيع</th>

														<th>تاريخ اضافه الخدمه</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													@foreach($services as $service)
													<tr>
														<td>{{$service->id}}</td>

														<td>
															<a href="{{ url('/admin/services/'.$service->id.'/edit') }}">
																{{$service->name}}
															</a>
														</td>
														<td>
															<a href="{{ url('/admin/user/'.$service->user->id.'/edit') }}" >
																{{$service->user->name}}
															</a>
														</td>
														<td>
															<a href="{{ url('/admin/orders/getAllOrdersSold/'.$service->id) }}" >

																{{$service->order_count}}
															</a>

														</td>
														<td>{{ $service->created_at	}}</td>
														<td class="actions">
															
															<a href="{{ url('/admin/services/'.$service->id.'/edit') }}" class="btn btn-sm btn-primary">
																<i class="glyphicon glyphicon-pencil"></i>
																تعديل
																
															</a>

															
															
															<a href="{{ url('/admin/delete/'.$service->id) }}" class="btn btn-sm btn-danger">
																<i class="glyphicon glyphicon-trash"></i>
																حذف
																
															</a>
															@if($service->status ==0)
															<a href="{{ url('/admin/accepteservices/'.$service->id.'/1') }}" class="btn btn-sm btn-success">
																<i class="glyphicon glyphicon-ok-sign"></i>
																تفعيل الخدمه
															</a>
															@else
															<a href="{{ url('/admin/accepteservices/'.$service->id.'/0') }}" class="btn btn-sm btn-danger">
																<i class="glyphicon glyphicon-remove"></i>
																الغاء تفعيل الخدمه
															</a>
															@endif
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											{{$services->render()}}
										</div>
									</div>
								</div>
							</div>
							@endsection