<template>
	<div>

	<span v-if="section2">
			<ul class="list-group" style="padding:0px;">
		<li class="list-group-item active" >
		<h5>
			<i class="fa fa-heart"></i> اخترنا لك
			</h5>
		</li>

			<li v-for="order in section2 " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'ServicesDetails' , params:{services_id:order.id , services_name:order.name}}" >
						<span class="pull-right"> 
						<i class="fa fa-heart"></i>
							{{order.name}}
						</span>
						
					</a>
				</div>
				</div>
				
			</li>
		</ul>
		</span>
		<ul class="list-group" style="padding:0px;">
		<li class="list-group-item active" >
		<h5>
			<i class="fa fa-cart-plus"></i> الاكثر مبيعا
			</h5>
		</li>

			<li v-for="pay in section3 " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'ServicesDetails' , params:{services_id:pay.id , services_name:pay.name}}" >
						<span class="pull-right"> 
							{{pay.name}}
						</span>
						<span class="label label-success pull-left"> <i class="fa fa-cart-plus"></i>
							{{pay.orders_count}}
						</span>
						
					</a>
				</div>
				</div>
				
			</li>
		</ul>
		<!--
		<ul class="list-group" style="padding:0px;">
<li class="list-group-item active" >
		<h5>
			<i class="fa fa-folder"></i>	الاقسام	</h5>
		</li>
			<li v-for="c in cat " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'/Cat' , params:{cat_id:c.id ,cat_name:c.name}}" >
						<span class="pull-right"> 
						<i class="fa fa-folder"></i>
							{{c.name}}
						</span>
						
					</a>
				</div>
				</div>
				
			</li>
		</ul>
		
		
-->
				<ul class="list-group" style="padding:0px;">
		<li class="list-group-item active" >
		<h5>
			<i class="fa fa-eye"></i> الاكثر مشاهده
			</h5>
		</li>

			<li v-for="view in section1 " class="list-group-item" >
			<div class="row">
				<div class="col-lg-12">
					<a  v-link="{name:'ServicesDetails' , params:{services_id:view.id , services_name:view.name}}" >
						<span class="pull-right"> 
							{{view.name}}
						</span>
						
					</a>
				</div>
				</div>
				
			</li>
		</ul>
		
	</div>
</template>
<script >
	
	export default{
		props:['cat','section1','section2','section3'],


	}
</script>