<template>
	<div class="sidebar-nav">
		<div class="well" style=" padding: 8px 0; ">
			<ul class="nav nav-list" style="padding-right:0px;">        
				<li><a v-link="{name:'/UserServices' ,params:{ user_id:user.id , username:user.name}}"> <i class="fa fa-user"></i> {{user.name}}</a></li>
				<li class="divider"></li>
				<li v-for="service in user.services">
					<a v-link="{name:'ServicesDetails',params:{services_id:service.id ,services_name:service.name}}"><i class="icon-home"></i>{{service.name}} </a>
				</li>

				<li class="divider"></li>
				
			</ul>
		</div>
	</div>
</template>
<script >
	export default{

		props:['user'],
	}
</script>