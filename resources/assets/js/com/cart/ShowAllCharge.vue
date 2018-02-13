		<template>
			<header_nav></header_nav>
      <div class="container">
			<div>
				
				<span v-if="isloading">
					<h3 class=""><span class="label label-default"><i class="fa fa-user"></i> عمليات الشحن الخاصه بالعضو {{ user.name}}</span></h3>
					<h3 class=""><span class="label label-warning"><i class="fa fa-money"></i>  لديك فى حسابك {{ sumprice}} $</span></h3>
				
				<table class="table table-striped">
					<thead>
					<tr>
						<th> رقم العمليه</th>
						<th> طريقه الشحن</th>
						<th> حاله الشحن</th>
						<th> قيمه الشحن</th>
						<th> تاريخ الشحن</th>
</tr>
					</thead>
					<tbody >
					<tr v-for="p in pay">
						<td>{{ p.id }}</td>
						<td>{{ p.payment_method }}</td>
						<td>{{ p.state }}</td>
						<td>{{ p.price }}</td>
						<td>{{ p.created_at }}</td>
						</tr>
					</tbody>
				</table>
				</span>
				<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
</div>
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
						pay:[],
						sumprice:[]
						
					

					}
				},

				ready: function(){
					this.$refs.spinner.show();
					this.GetAllShowChearg();
				},
				methods:{
					GetAllShowChearg:function(){

						this.$http.get('/GetAllShowChearg').then(function (res) {
							
							this.user=res.body['user'];
							this.pay=res.body['pay'];
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