@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1 class="pull-right"> {{$services->name}}</h1>
			<p class="pull-left">

				<span style="padding-left: 5px">
					<span class="label label-default">
						<i class="glyphicon glyphicon-eye-open"></i>

						{{$services->view_count}}
					</span>
					<span class="label label-info">
						<i class="glyphicon glyphicon-user"></i>
						{{$services->vote_count}}
					</span>
					<span class="label label-warning">
						<i class="glyphicon glyphicon-star"></i>

						@if($sum == null)
						0
						@else
						{{$sum }} 

						@endif
						
					</span>
					<span class="label label-success">
						@if($sum == null)
						0%
						@else
						{{($sum * 100 /($services->vote_count*5))}} %

						@endif
					</span>
				</span>

				<a href="{{ url('/admin/delete/'.$services->id) }}" class="btn btn-sm btn-danger">
					<i class="glyphicon glyphicon-trash"></i>
					حذف

				</a>
				@if($services->status ==0)
				<a href="{{ url('/admin/accepteservices/'.$services->id.'/1') }}" class="btn btn-sm btn-success">
					<i class="glyphicon glyphicon-ok-sign"></i>
					تفعيل الخدمه
				</a>
				@else
				<a href="{{ url('/admin/accepteservices/'.$services->id.'/0') }}" class="btn btn-sm btn-danger">
					<i class="glyphicon glyphicon-remove"></i>
					الغاء تفعيل الخدمه
				</a>
				@endif
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
						معلومات  عن العضو صاحب الخدمه
					</div>
				</div>
				<div class="bootstrap-admin-panel-content">
					<ul>
						<li>
							<a href="{{ url('admin/user/'.$services->user->id.'/edit') }}">
								{{$services->user->name}}</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">
								طلبات الخدمه
								{{count($services->order)}}
							</div>
						</div>
						<div class="bootstrap-admin-panel-content">
							<ul>
								@foreach($services->order as $order)
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

			{!! Form::model($services, ['route'=>['admin.services.update',$services->id], 'method'=>'PATCH', 'files'=>'true' ]  ) !!}

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-muted bootstrap-admin-box-title">

								{{$services->name}}
							</div>
						</div>
						<div class="bootstrap-admin-panel-content text-muted" >
							<div class="col-lg-12">

								

								
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										اسم الخدمه
									</label>
									<div class="col-lg-10">
										<input type="text" name="name" value="{{$services->name}}" class="form-control" >
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										وصف الخدمه
									</label>
									<div class="col-lg-10">

										<textarea name="des" rows="10"  class="form-control">{{$services->des}}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										القسم
									</label>
									<div class="col-lg-10">
										<select class="form-control"  name="cat_id" >
											<option value="{{$services->cat_id}}" >
												{{$services->cat->name}}
											</option>
											@foreach($cat as $c)
											<option value="{{$c->id}}" >
												{{$c->name}}
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 pull-right">									صوره الخدمه
									</label>
									<div class="col-lg-10">
										@if($services->image != '')
										<img  src="{{ url('images/services') }}/{{$services->image}}" alt="" class="img-responsive">
										<br>
										@endif
										<input type="file" name="image"  class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 pull-right">
										السعر
									</label>
									<div class="col-lg-10">
										<input type="text" name="price" value="{{$services->price}} "  class="form-control">
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
