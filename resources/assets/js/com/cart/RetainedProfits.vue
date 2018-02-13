		<template>
			<header_nav></header_nav>
      <div class="container">
			<div >
				
				<span v-if="isloading">
				  	<span class="pull-right">

					<h3 class=""><span class="label label-default"><i class="fa fa-user"></i> 
					اجمالى الارباح المحتجزه للعضو {{ user.name}}</span></h3>
                 </span>
  				<span class="pull-left" style="margin-top:20px">
					<span class="label label-warning" style="margin-left:10px"><i class="fa fa-money"></i> 
					ارباح فى لانتظار {{ sumWating}} $ </span>

					<span class="label label-success"><i class="fa fa-money"></i> 
					ارباح تم ارسالها {{ sumDone}} $</span>
                </span>

				<table class="table table-striped">
					<thead>
					<tr>
						<th> رقم العمليه</th>
						<th> حاله السحب</th>
						<th> قيمه السحب</th>
						<th> تاريخ السحب</th>
                     </tr>
					</thead>
					<tbody >
					<tr v-for="p in Profit">
						<td>{{ p.id }}</td>

						<td>
							<span v-if="p.status == 0">
							<span class="label label-warning"> 
								رصيد معلق
							</span>
							</span>
							<span v-if="p.status == 1">
							<span class="label label-success"> 
								تم سحب الرصيد
							</span>
							</span>
							

						</td>
						<td>{{ p.profit_price }}$</td>
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
						Profit:[],
						sumDone:0,
						sumWating:0
						
					

					}
				},

				ready: function(){
					this.$refs.spinner.show();
					this.RetainedProfits();
				},
				methods:{
					RetainedProfits:function(){

						this.$http.get('/RetainedProfits').then(function (res) {
							
							this.user=res.body['user'];
							this.Profit=res.body['Profit'];
							this.sumWating=res.body['sumWating'];
							this.sumDone=res.body['sumDone'];

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