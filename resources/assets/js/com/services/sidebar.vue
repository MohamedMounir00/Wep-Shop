<template>
	<div>
		<div>

			<a  v-link="{name:'/UserServices' ,params :{user_id:service.user.id,username:service.user.name }}">
				<i class="fa fa-user"></i>
				{{ service.user.name}}
			</a> 
			<br>
			<send_message :user="service.user"></send_message>
		</div>
		<hr>
		<span v-if="section">
			<ul class="list-group" style="padding:0px;">
		<li class="list-group-item active" >
		<h5>
			<i class="fa fa-heart"></i> اخترنا لك
			</h5>
		</li>

			<li v-for="order in section " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'ServicesDetails' , params:{services_id:order.id , services_name:order.name}}" >
						<span class="pull-right"> 
						
							{{order.name}}
						</span>
						<span class="label label-danger pull-left"> <i class="fa fa-heart"></i></span>
						
						
					</a>
				</div>
				</div>
				
			</li>
		</ul>
		</span>
		
		<ul class="list-group" style="padding:0px;">
<li class="list-group-item active" >
<h5>
	<i class="fa fa-star"></i> الاكثر تقيما
	</h5>
</li>
			<li v-for="vote in most_vote " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'ServicesDetails' , params:{services_id:vote.id , services_name:vote.name}}" >
						<span class="pull-right"> 
							{{vote.name}}
						</span>
						<span class="label label-warning pull-left"> <i class="fa fa-star"></i>
							{{vote.vote_sum}}
						</span>
					</a>
				</div>
				</div>
				
			</li>
		</ul>
		
		
		<ul class="list-group" style="padding:0px;">
			<li class="list-group-item active" >
		<h5>
			<i class="fa fa-eye"></i> الاكثر مشاهده
			</h5>
		</li>

			<li v-for="view in most_view " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'ServicesDetails' , params:{services_id:view.id , services_name:view.name}}" >
						<span class="pull-right"> 
							{{view.name}}
						</span>
						<span class="label label-default pull-left"> <i class="fa fa-eye"></i>
							{{view.view_count}}
						</span>
					</a>
				</div>
				</div>
				
			</li>
		</ul>
	</div>
</template>
<script >
	import SendMessage from '../buttons/sendMessage.vue';
	export default{



		components:{
			send_message:SendMessage
		},
		props:['service','most_vote','most_view','section'],


	}
</script>