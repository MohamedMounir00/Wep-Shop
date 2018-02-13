@extends('admin.layouts.layouts')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">

			<h1 class="pull-right"> {{$order->service->name}}# رقم الطلب ({{$order->id}}) </h1>

			<p class="pull-left">
				<span style="padding-left: 5px">

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
				<a href="{{ url('/admin/orders/delete/'.$order->id) }}" class="btn btn-sm btn-danger">
					<i class="glyphicon glyphicon-trash"></i>
					حذف

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
						معلومات  عن العضو صاحب الخدمه
					</div>
				</div>
				<div class="bootstrap-admin-panel-content">
					

					<ul>
						<li>
							<a href="{{ url('admin/user/'.$order->GetUserAddSerivecs->id.'/edit') }}">{{$order->GetUserAddSerivecs->name}}</a>
						</li>
						<li> اجمالى شحن الحساب
							{{ $thischarge = \App\PayInfo::where('user_id',$order->GetUserAddSerivecs->id)->sum('price') }} $ </li> 

							<li> + الارباح
								{{ $thisProfit = \App\buy::where('rev_id',$order->GetUserAddSerivecs->id)->where('finish',1)->sum('buy_price') }} $</li>
								<li>	- اجمالى المدفوعات
									{{ $thisPay = \App\buy::where('user_id',$order->GetUserAddSerivecs->id)->where('finish','!=',2)->sum('buy_price') }} $</li> 
									

									<li>
										<hr>
										الرصيد الحالى
										{{ ($thischarge + $thisProfit)- $thisPay }}$ </li> 
										
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="text-muted bootstrap-admin-box-title">
										معلومات  عن طالب الخدمه
									</div>
								</div>
								<div class="bootstrap-admin-panel-content">
									<ul>
										<li>
											<a href="{{ url('admin/user/'.$order->GetMyOrders->id.'/edit') }}">
												{{$order->GetMyOrders->name}}</a></li>
												<li> اجمالى شحن الحساب
													{{$thischarge = \App\PayInfo::where('user_id',$order->GetMyOrders->id)->sum('price') }} $ </li>
													<li> + الارباح
														{{ $thisProfit = \App\buy::where('rev_id',$order->GetMyOrders->id)->where('finish',1)->sum('buy_price') }} $</li>
														<li>	- اجمالى المدفوعات
															{{ $thisPay = \App\buy::where('user_id',$order->GetMyOrders->id)->where('finish','!=',2)->sum('buy_price') }} $</li> 
															
															<li>
																<hr>
																الرصيد الحالى
																{{ ($thischarge + $thisProfit)- $thisPay }}$ </li>  
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
											<div class="row">
												<div class="col-lg-12">
													<div class="panel panel-default">
														<div class="panel-heading">
															<div class="text-muted bootstrap-admin-box-title">

																{{$order->service->name}}
															</div>
														</div>
														<div class="bootstrap-admin-panel-content text-muted" >
															<div class="col-lg-12">

																

																<div class="col-lg-12">
																	<div class="form-group row ">
																		<label class="col-lg-2 pull-right">
																			اسم الخدمه
																		</label>
																		<div class="col-lg-10">
																			{{$order->service->name}}

																		</div>
																	</div>
																	<div class="form-group row ">
																		<label class="col-lg-2 pull-right">
																			السعر
																		</label>
																		<div class="col-lg-10">
																			{{$order->service->price}}
																		</div>
																	</div>
																	<div class="form-group row ">
																		<label class="col-lg-2 pull-right">
																			حاله الطلب
																		</label>
																		<div class="col-lg-10">
																			

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
																			

																		</div>
																	</div>
																	<form action="{{ url('/admin/orders/changOrderStatus') }}" method="post" >
																		{{ csrf_field() }}
																		<input type="hidden" name="order_id" value="{{$order->id}}">
																		<input type="hidden" name="user_id" value="{{$order->GetUserAddSerivecs->id}}">
																		<input type="hidden" name="rev_id" value="{{$order->GetMyOrders->id}}">


																		<div class="form-group row ">
																			<label class="col-lg-2 pull-right">
																				اسم الخدمه
																			</label>
																			<div class="col-lg-10">
																				<select name="status" class="form-control">
																					<option value="0">طلب جديد</option>
																					<option value="1"> طلب قديم </option>
																					<option value="2"> طلب قيد التنفيذ </option>
																					<option value="3"> طلب ملغي </option>
																					<option value="4"> طلب منتهي </option>
																				</select>
																				<br>
																				<div class="alert alert-warning">
																					<b> تحذير: </b>
																					<span>
																						تغير حاله الطلب قد يؤدى الى تغير قيمه الارباح والمدفوعات بالعضوين المعنين بالطلب برجاء  الانتباه  عند تغير  حاله الطلب
																					</span>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="col-lg- 2">
																				
																			</label>
																			<div class="col-lg-10">
																				<input type="submit"  value="تغير حاله الطلب" class="btn btn-info form-control" >
																			</div>
																		</div>
																	</form>
																	
																	
																	
																</div>
																<div class="col-lg-12 ">
																	<h1 >التعلقات
																		{{ count($order->comment) }}
																	</h1>
																	<div>
																		
																		

																		@foreach($order->comment as  $comment)
																		<section class="comment-list  ">

																			<article class="row " >
																				
																				<div class="col-md-12 col-sm-12 col-xs-12 ">
																					<div class="panel panel-default arrow left">
																						<div class="panel-body " >
																							<header class="text-right clearfix">
																								<div class="comment-user pull-right">
																									
																									<a href="">
																										<i class="fa fa-user"></i> 
																										{{$comment->user_id}}
																									</a>
																								</div>
																								<time class="comment-date pull-left" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{$comment->created_at}}</time>
																							</header>
																							<div class="comment-post">
																								<p class="list-inline">
																									{{$comment->comment}}

																								</p>
																							</div>
																							<p class="text-right"><a href="{{url('/admin/comment/'.$comment->id.'/delete')}}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-remove"></i> حذف</a></p>
																						</div>
																					</div>
																				</div>
																			</article>
																		</section>
																		@endforeach
																	</div>
																	
																</div>
																
															</div>
															<div class="clearfix"></div>

														</div>
													</div>
												</div>
											</div>

										</div>
										


										
										
										@endsection
