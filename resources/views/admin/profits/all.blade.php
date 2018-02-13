@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 class="pull-right"> طلبات سحب الارباح
			</h1>
			<div class="btn-group pull-left">
				<button class="btn btn-info">الظهور على حسب </button>

				<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="{{ url('/admin/profits/0') }}">
						<i class="glyphicon glyphicon-time"></i>

						ارباح لم يتم الوافقه عليها</a></li>
						<li><a href="{{ url('/admin/profits/1') }}">
							<i class="glyphicon glyphicon-ok"></i>
							ارباح تم الموافقه عليها</a></li>

							<li class="divider"></li>

							<li><a href="{{ url('/admin/profits/id-desc') }}">
								<i class="glyphicon glyphicon-circle-arrow-up"></i>

								المضاف اخيرا</a></li>
								<li><a href="{{ url('/admin/profits/id-asc') }}">
									<i class="glyphicon glyphicon-circle-arrow-down"></i>

									المضاف اولا</a></li>
									<li class="divider"></li>

									<li><a href="{{ url('/admin/profits/created_at-asc') }}">
										<i class="glyphicon glyphicon-calendar"></i>

										على حسب التاريخ الاقدم</a></li>
										<li><a href="{{ url('/admin/profits/created_at-desc') }}">
											<i class="glyphicon glyphicon-calendar"></i>

											على حسب التاريخ الاحدث</a></li>


											<li class="divider"></li>
										</ul>
									</div>

									
									<div class="btn-group pull-left" style="margin-left: 10px">
										<form action="{{ url('/admin/profits') }}" method="post" class="form-inline"  >
											{{ csrf_field() }}
											<input type="text" name="serach"  placeholder="بحث" class="form-control">
											<button type="submit"   class="btn btn-primary form-control">
												<i class="glyphicon glyphicon-search"></i>
												ابحث </button>
											</form>
										</div>
										<div class="btn-group pull-left" style="margin-left: 10px">

											
											<form action="{{ url('/admin/getOrderProfitsByDate') }}" method="post" class="form-inline"  >
												{{ csrf_field() }}
												<input type="date" name="serach"  placeholder="بحث" class="form-control">
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

													طلبات سحب الارباح
												</div>
											</div>
											<div class="bootstrap-admin-panel-content text-muted" >
												<table class="table bootstrap-admin-table-with-actions">
													<thead>
														<tr>

															<th>رقم الطلب</th>
															<th>صاحب الطلب</th>
															<th>حاله الطلب</th>
															<th>الربح</th>

															<th>تاريخ طلب السحب</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
														@foreach($profits as $profit)
														<tr>
															<td>{{$profit->id}}</td>

															
															<td>
																<a href="{{ url('/admin/user/'.$profit->user->id.'/edit') }}" >
																	{{$profit->user->name}}
																</a>
															</td>
															<td>
																@if($profit->status == 0)
																<span class="label label-warning">
																	قيد التنفيذ

																</span>
																@else

																<span class="label label-success">
																	تم سحب الارباح

																</span>
																@endif
															</td>
															<td>{{ $profit->profit_price}}</td>

															<td>{{ $profit->created_at	}}</td>
															<td>
																{{\Moment\Moment::setLocale('ar_TN')}}
																{{(new \Moment\Moment('@'.$profit->time, 'CET'))->addDays(env('profitDay'))->format('Y-m-d') }}

															</td>
															<td class="actions">
																
																<a href="{{ url('/admin/AddSendMoney/'.$profit->id) }}" class="btn btn-sm btn-primary">
																	<i class="glyphicon glyphicon-pencil"></i>
																	ارسل  الارباح
																	
																</a>

																
																
																
																
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
												{{$profits->render()}}
											</div>
										</div>
									</div>
								</div>
								@endsection