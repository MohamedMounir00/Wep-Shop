<template>

	<div class="row ">


		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<status :status="service.status"></status>
			


			

		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>{{service.created_at}}</b></div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>
			<a  v-link="{name:'/UserServices',params:{user_id:user_to_show.id,username:user_to_show.name }}">
				<i class="fa fa-user"></i>{{user_to_show.name}}</a></b></div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><b> <a v-link="{name:'/Order',params:{order_id:service.id}}">{{service.service.name}}</a></b></div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><b>{{service.id}}</b></div>
				
			</div>
			<hr/>

			
		</template>
		<script >
			import status from '../buttons/status.vue';
			export default{
				components:{
					status:status,
				},
				props:['service' ,'user_to_show']
			}
		</script>


		
		