<template>
	<div class="Noteall" >
	<span v-if="n.type == 'ReacveOrder'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-arrow-down"></i>

		تم استقال طلب شراء 
		من 
		{{ n.get_user_send_notication.name }}
	</a>
</span>
	<span v-if="n.type == 'ComplateOrder'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-check"></i>

		قام 
		{{ n.get_user_send_notication.name }}
		بانهاء الطلب  رقم 
		{{n.notify_id}}
		برجاء  مراجعه ارباحك
	</a>
	</span>
	<span v-if="n.type == 'RejectOrder'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-close"></i>

		قام 
		{{ n.get_user_send_notication.name }}
		برفض الطلب رقم
		{{n.notify_id}}
	</a>
	</span>
	<span v-if=" n.type == 'DoneOrder'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
		<i class="fa fa-check"></i>

		قام 
		{{ n.get_user_send_notication.name }}
		بالموافقه على الطلب رقم
		{{n.notify_id}}
		من افطلك  قم بانئها الطلب
	</a>
	</span>
	<span v-if=" n.type == 'AddComment'">
	<a  v-link="{name:'/Order',params:{order_id: n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
	<i class="fa fa-comment"></i>
		قام 
		{{ n.get_user_send_notication.name }}
		بالتعليق على  طلب  رقم
		{{n.notify_id}}
	</a>
	</span>
	<span v-if=" n.type == 'Reacvemessage'">
	<a  v-link="{name:'/GetThisMessageDetiles',params:{message_id:n.notify_id ,viewtype:'income'}}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
	<i class="fa fa-envelope"></i>
		تم استقبال رساله 
		من 
		{{ n.get_user_send_notication.name }}
	</a>
	</span>
	<span v-if=" n.type == 'AdminAccepteServices'">
	  <a v-link="{name:'ServicesDetails',params:{services_id:n.notify_id, services_name:''}}"          v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
	<i class="fa fa-check"></i>
		قامت الاداره بالموافقه على الخدمه رقم
				{{n.notify_id}}

	</a>
	</span>
		<span v-if=" n.type == 'AdminRejectServices'">
	  <a v-link="{name:'ServicesDetails',params:{services_id:n.notify_id, services_name:''}}"          v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
	<i class="fa fa-close"></i>
		قامت الاداره برفض الخدمه رقم
				{{n.notify_id}}
				الخاصه بك

	</a>
	</span>
		<span v-if="n.type == 'AdminMakeNew'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-eye"></i>

قامت الاداره بتحويل الطلب رقم
		#{{n.notify_id}}
		الى طلب جديد
	</a>
	</span>
		<span v-if="n.type == 'AdminMakeFinsh'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-check"></i>

قامت الاداره بانهاء الطلب رقم
		#{{n.notify_id}}
		
	</a>
	</span>
		<span v-if="n.type == 'AdminMakeOld'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-eye-slash"></i>

قامت الاداره بتحويل الطلب رقم
		#{{n.notify_id}}
		الى طلب قديم
	</a>
	</span>
		<span v-if="n.type == 'AdminMakeAccepte'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-check"></i>

		قامت الاداره بالموافقه على الطلب رقم
		#{{n.notify_id}}
		
	</a>
	</span>
		<span v-if="n.type == 'AdminMakeReject'">
	<a  v-link="{name:'/Order',params:{order_id:n.notify_id }}" v-bind:class="n.seen ==0 ? 'noteunseen' : 'notefseen'">
			<i class="fa fa-close"></i>

		قامت  الاداره بالغا الطلب  رقم
		#{{n.notify_id}}
		
	</a>
	</span>
	
</div>
</template>
<script>
	
				export default{
					 props:['n'],
}
</script>