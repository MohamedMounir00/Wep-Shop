@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 class="pull-right"> المستخدمين</h1>
			<div class="btn-group pull-left">
				<button class="btn btn-info">الظهور على حسب </button>

				<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="{{ url('/admin/user/1') }}">
						<i class="glyphicon glyphicon-time"></i>

						المدرين</a></li>
						<li><a href="{{ url('/admin/user/0') }}">
							<i class="glyphicon glyphicon-ok"></i>
							الاعضاء</a></li>

							<li class="divider"></li>

							<li><a href="{{ url('/admin/user/id-desc') }}">
								<i class="glyphicon glyphicon-circle-arrow-up"></i>

								المضاف اخيرا</a></li>
								<li><a href="{{ url('/admin/user/id-asc') }}">
									<i class="glyphicon glyphicon-circle-arrow-down"></i>

									المضاف اولا</a></li>
									<li class="divider"></li>

									<li><a href="{{ url('/admin/user/created_at-asc') }}">
										<i class="glyphicon glyphicon-calendar"></i>

										على حسب التاريخ الاقدم</a></li>
										<li><a href="{{ url('/admin/user/created_at-desc') }}">
											<i class="glyphicon glyphicon-calendar"></i>

											على حسب التاريخ الاحدث</a></li>


											<li class="divider"></li>
										</ul>
									</div>

									<div class="btn-group pull-left" style="margin-left: 10px">
										<form action="{{ url('/admin/user') }}" method="post" class="form-inline">
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
														<th>اسم المستخدم</th>

														<th>الصلاحيات</th>
														<th>عدد الخدمات</th>
														<th>طلبات العضو</th>
														<th>طلبات اخرين للعضو</th>

														<th>تاريخ اضافه الخدمه</th>

														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													@foreach($users as $user)
													<tr>
														<td>{{$user->id}}</td>

														<td>
															<a href="{{ url('/admin/user/'.$user->id.'/edit') }}">
																{{$user->name}}
															</a>
														</td>
														<td>
															@if($user->admin == 1)
															مدير
															@else
															عضو
															@endif
														</td>
														<td>
															<a href="{{ url('/admin/services/getByUser/'.$user->id) }}">
																{{ $user->services_count}}
															</a>
														</td>
														<td>
															<a href="{{ url('/admin/orders/getMyorders/'.$user->id) }}">

																{{ $user->order_imade_count}}
															</a>
														</td>
														<td>
															<a href="{{ url('/admin/orders/getUsersorders/'.$user->id) }}">


																{{ $user->get_myservices_order_count}}
															</a></td>


															<td>{{ $user->created_at}}</td>
															<td class="actions">

																<a href="{{ url('/admin/user/'.$user->id.'/edit') }}" class="btn btn-sm btn-primary">
																	<i class="glyphicon glyphicon-pencil"></i>
																	تعديل

																</a>



																<a href="{{ url('/admin/delete/'.$user->id) }}" class="btn btn-sm btn-danger">
																	<i class="glyphicon glyphicon-trash"></i>
																	حذف

																</a>

															</td>


														</tr>
														@endforeach
													</tbody>
												</table>
												{{$users->render()}}
											</div>
										</div>
									</div>
								</div>
								@endsection