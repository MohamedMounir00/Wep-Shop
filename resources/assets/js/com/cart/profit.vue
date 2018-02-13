		<template>
			<header_nav></header_nav>
      <div class="container">
			<div >
				
				<span v-if="isloading">
					<h3 class=""><span class="label label-default"><i class="fa fa-user"></i> 
					اجمالى الارباح الخاصه بالعضو {{ user.name}}</span></h3>


					<h3 class=""><span class="label label-warning"><i class="fa fa-money"></i> 
					اجمالى الارباح{{ sumprice}} $</span></h3>
				
				<table class="table table-striped">
					<thead>
					<tr>
						<th> رقم العمليه</th>
						<th> الطلب الخاص بعمليه الدفع</th>
						<th> حاله الدفع</th>
						<th> قيمه الدفع</th>
						<th> تاريخ الدفع</th>
                     </tr>
					</thead>
					<tbody >
					<tr v-for="p in buy">
						<td>{{ p.id }}</td>
						<td><a v-link="{name:'/Order',params:{order_id:p.order_id}}">
						رقم الطلب
						#
						{{ p.order_id }}
</a>
						</td>
						<td>
							<span v-if="p.finish == 0"> 
							<span class="label label-warning"> 
								رصيد معلق
							</span>
							</span>
							<span v-if="p.finish == 1"> 
							<span class="label label-success"> 
								رصيد مخصوم
							</span>
							</span>
							<span v-if="p.finish == 2"> 
							<span class="label label-danger"> 
								طلب ملغى
							</span>
							</span>

						</td>
						<td>{{ p.buy_price }}$</td>
						<td>{{ p.created_at }}</td>
						</tr>
					</tbody>
				</table>
				</span>
				<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>

			</div>
		</template>


		<script >
			var spinner = require('vue-strap/dist/vue-strap.min').spinner;
            import Header from '../layouts/header.vue';


			export default{
				components:{
					spinner:spinner,
					 header_nav:Header



				},
				data: function(){

					return{
						isloading:false,
						user:[],
						buy:[],
						sumprice:[]
						
					

					}
				},

				ready: function(){
					this.$refs.spinner.show();
					this.ShowAllProfit();
				},
				methods:{
					ShowAllProfit:function(){

						this.$http.get('/ShowAllProfit').then(function (res) {
							
							this.user=res.body['user'];
							this.buy=res.body['buy'];
								this.sumprice=res.body['sumprice'];
							this.$refs.spinner.hide();
							this.isloading=true;
						},function(res){


						});
					},
				
				}		,route:{
        canReuse:false,///forse reload data
      }
       ,events:{
      Auth:function(value){
        if (value === 'false') {
            this.$router.go(

                              {
                                  path:'/Loginrequire'
                                });
        }

      }
    }

			}

		</script>