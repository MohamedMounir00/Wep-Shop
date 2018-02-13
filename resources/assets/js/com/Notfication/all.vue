		<template>
			<header_nav></header_nav>
			<div class="container">

			<div class="row" >
				
				<span v-if="isloading">
			
					  				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right">
					  				          <Mssage_menu ></Mssage_menu>

					  				</div>


				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-left">
							<h3 class=""><span class="label label-default"><i class="fa fa-bell"></i> 
					الاشعرات الخاصه بالعضو{{ user.name}}</span></h3>

         <h3 class=""><span class="label label-danger"><i class="fa fa-bell"></i> 
					  {{ sum}}  عدد الاشعرات  </span></h3>
					<table class="table table-striped">
			
					<tbody >
					<tr v-for="n in not">
											<td>{{ n.id}}</td>
                       <td>
                       						<note_list :n="n"></note_list>

                       </td>

						<td>{{ n.created_at }}</td>
						</tr>
					</tbody>
				</table>
				</div>
				
				</span>
				<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>

			</div>
			</div>
			
		</template>


		<script >
			var spinner = require('vue-strap/dist/vue-strap.min').spinner;
        import MnueMessage from '../message/MessageMenu.vue';
        import Header from '../layouts/header.vue';
         import Note from '../buttons/note.vue';





			export default{
				components:{
					spinner:spinner,
					 Mssage_menu:MnueMessage,
					 header_nav:Header,
					 note_list:Note



				},
				data: function(){

					return{
						isloading:false,
						user:[],
						not:[],
						sum:[]
						
					

					}
				},

				ready: function(){
					this.$refs.spinner.show();
					this.GetNotifaction();
				},
				methods:{
					GetNotifaction:function(){

						this.$http.get('/GetNotifaction').then(function (res) {
							
							this.user=res.body['user'];
							this.not=res.body['not'];
							this.sum=res.body['sum'];
							this.$refs.spinner.hide();
							this.isloading=true;
						},function(res){


						});
					},
				
				},

        route:{
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