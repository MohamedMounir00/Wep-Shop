@foreach(GetAllNotObject(Auth::user()->id) as $not)
<li class="pull-right">

	@if($not->type == 'ReacveOrder')
	<a  v-link="{name:'/Order',params:{order_id:{{ $not->notify_id }}}}">
		تم استقال طلب شراء 
		من العضو
		{{ $not->GetUserSendNotication->name }}
	</a>

	@elseif( $not->type == 'ComplateOrder')
	<a  v-link="{name:'/Order',params:{order_id:{{ $not->notify_id }}}}">
		قام العضو 
		{{ $not->GetUserSendNotication->name }}
		بانهاء الطلب  رقم 
		{{$not->notify_id}}
		برجاء  مراجعه ارباحك
	</a>
	@elseif( $not->type == 'RejectOrder')
	<a  v-link="{name:'/Order',params:{order_id:{{ $not->notify_id }}}}">
		قام العضو 
		{{ $not->GetUserSendNotication->name }}
		برفض الطلب رقم
		{{$not->notify_id}}
	</a>
	@elseif( $not->type == 'DoneOrder')
	<a  v-link="{name:'/Order',params:{order_id:{{ $not->notify_id }}}}">
		قام العضو 
		{{ $not->GetUserSendNotication->name }}
		بالموافقه على الطلب رقم
		{{$not->notify_id}}
		من افطلك  قم بانئها الطلب
	</a>
	@elseif( $not->type == 'AddComment')
	<a  v-link="{name:'/Order',params:{order_id:{{ $not->notify_id }}}}">
		قام العضو 
		{{ $not->GetUserSendNotication->name }}
		بالتعليق على  طلب شراء رقم
		{{$not->notify_id}}
	</a>
	@elseif( $not->type == 'Reacvemessage')
	<a  v-link="{name:'/GetThisMessageDetiles',params:{message_id:{{ $not->notify_id }},viewtype:'income'}}">
		تم استقبال رساله 
		من العضو
		{{ $not->GetUserSendNotication->name }}
	</a>
	@endif

</li>

@endforeach

