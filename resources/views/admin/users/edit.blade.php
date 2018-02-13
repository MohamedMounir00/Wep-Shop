@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 class="pull-right"> {{$users->name}}</h1>
			<p class="pull-left">

				

				<a href="{{ url('/admin/delete/'.$users->id) }}" class="btn btn-sm btn-danger">
					<i class="glyphicon glyphicon-trash"></i>
					حذف

				</a>
				<a href="{{ url('/admin/user/') }}" class="btn btn-sm btn-info">
					<i class="glyphicon glyphicon-user"></i>
					كل الاعضاء

				</a>

				
			</p>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="text-muted bootstrap-admin-box-title">
						الخدمات الخاصه بهذا العضو
					</div>
				</div>
				<div class="bootstrap-admin-panel-content">
					<ul>
						@foreach($services as $service)
						<li>
							<a href="{{ url('admin/services/'.$service->id.'/edit') }}">
								{{$service->name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">
								الطلبات التى تم طلبها من خدمات هذا العضو

								({{count($orders)}})
								طلب
							</div>
						</div>
						<div class="bootstrap-admin-panel-content">
							<ul>
								@foreach($orders as $order)
								<li>
									<a href="{{ url('admin/order/'.$order->id.'/edit') }}" class="pull-right" target="_blank">{{$order->id}}	</a>
									<span class="pull-left">
										<small>
											<i class=" glyphicon glyphicon-calendar"></i>
											{{$order->created_at}}
										</small>
									</span>

									<span class="pull-left">
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
										
									</span>
									<div class="clearfix">	</div>

								</li>
								@endforeach
								

							</ul>
							
							
							
						</div>
						
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">
								الطلبات التى قام  بطلبها هذا العضو

								({{count($myorders)}})
								طلب
							</div>
						</div>
						<div class="bootstrap-admin-panel-content">
							<ul>
								@foreach($myorders as $order)
								<li>
									<a href="{{ url('admin/order/'.$order->id.'/edit') }}" class="pull-right" target="_blank">{{$order->id}}	</a>
									<span class="pull-left">
										<small>
											<i class=" glyphicon glyphicon-calendar"></i>
											{{$order->created_at}}
										</small>
									</span>

									<span class="pull-left">
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
										
									</span>
									<div class="clearfix">	</div>

								</li>
								@endforeach
								

							</ul>
							
							
							
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">
								معلومات عن رصيد العضو
							</div>
						</div>
						<div class="bootstrap-admin-panel-content">
							<div class="row">
								<div class="col-lg-3">
									<div class="well text-center">
										<h5>
											الارباح
										</h5>
										{{ $thisProfit = \App\buy::where('rev_id',$users->id)->where('finish','=',1)->sum('buy_price') }} $
									</div>
								</div>

								<div class="col-lg-3">
									<div class="well text-center">
										<a href="{{ url('admin/profits/user/'.$users->id.'/0') }}">
											<h5>
												الارباح المحتجزه
											</h5>
											{{ $thisProfitWaiting = \App\Profit::where('user_id',$users->id)->where('status',0)->sum('profit_price') }} $
										</a>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="well text-center">
										<a href="{{ url('admin/profits/user/'.$users->id.'/1') }}">

											<h5>
												الارباح المرسله
											</h5>
											{{ $thisProfitDone = \App\Profit::where('user_id',$users->id)->where('status',1)->sum('profit_price') }} $
										</a>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="well text-center">
										<h5>
											باقى الارباح
										</h5>
										{{  $thisProfit -  ($thisProfitWaiting +$thisProfitDone)}} $
									</div>
								</div>
							</div>

							
							<div class="row">
								
								
								<div class="col-lg-4">
									<div class="well text-center">
										<h4>
											شحن الحساب
										</h4>
										

										
										{{ $thischarge = \App\PayInfo::where('user_id',$users->id)->sum('price') }} $

									</div> 
								</div>

								
								<div class="col-lg-4">	
									<div class="well text-center">
										<h4>
											المدفوعات
										</h4>
										{{ $thisPay = \App\buy::where('user_id',$users->id)->where('finish','!=',2)->sum('buy_price') }} $
									</div> 
								</div>
								

								<div class="col-lg-4">
									<div class="well text-center">
										<h4>
											الرصيد 
										</h4>
										{{ ( $thisProfit + $thischarge )- $thisPay }}$
									</div> 
								</div> 
							</div>

							
						</div>
					</div>
				</div>
			</div>
			{!! Form::model($users, ['route'=>['admin.user.update',$users->id], 'method'=>'PATCH', 'files'=>'true' ]  ) !!}

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">

								{{$users->name}}
							</div>
						</div>
						<div class="bootstrap-admin-panel-content text-muted" >
							<div class="col-lg-12">

								

								
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										اسم العضو
									</label>
									<div class="col-lg-10">
										<input type="text" name="name" value="{{$users->name}}" class="form-control" >
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										الاميل
									</label>
									<div class="col-lg-10">
										<input type="email" name="email" value="{{$users->email}}" class="form-control">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										الصلاحيات
									</label>
									<div class="col-lg-10">
										<select class="form-control"  name="admin" >
											
											@if($users->admin == 1)
											<option value="1" >
												مدير
											</option>
											<option value="0" >
												عضو
											</option>

											@else
											<option value="0" >
												عضو
											</option>
											<option value="1" >
												مدير
											</option>
											@endif
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 pull-right">	
										صوره العضو								
									</label>
									<div class="col-lg-10">
										@if($users->image != '')
										<img  src="{{ url('images/users') }}/{{$users->image}}" alt="" class="img-responsive">
										<br>
										@endif
										<input type="file" name="image"  class="form-control">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										
									</label>
									<div class="col-lg-10">
										<input type="submit"  value="تعديل" class="btn btn-info form-control" >
									</div>
								</div>
							</div>
							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>

			{!! Form::close() !!}
		</div>

		@endsection
