		<template>
			<header_nav></header_nav>
      <div class="container">
			<div>
				
				<span v-if="isloading">
					<h3 class=""><span class="label label-default"><i class="fa fa-user"></i> شحن الحساب الخاص بالعضو {{ user.name}}</span></h3>

					<div>
						<validator name="validation1">
							<form novalidate action="/AddCartItme" method="post">
							<input type="hidden" name="_token" value="" v-model="_token">
								<div class="form-group">
									<label >
										الرصيد
									</label>
									<div class="form-group">

										<select v-model="price"  name="price" class="form-control" @valid="showprice = false"class="form-control" v-validate:price="{required:true ,minlength:1 , maxlength:4}">
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="40">40</option>
										<option value="50">50</option>
										<option value="60">60</option>
										<option value="70">70</option>
										<option value="80">80</option>
										<option value="90">90</option>
										<option value="100">100</option>
										<option value="150">150</option>
										<option value="200">200</option>


										</select>
									</div>

								<div class="form-group alert alert-danger" v-if="showprice">
									<p v-if="$validation1.price.required">من فضلك ادخل الرصيد</p>
					

								</div>

								</div>
								<input type="submit" name=""  v-bind:disabled="desable"  value="اشحن الان"class="btn btn-default">
							</form>
						</validator>
					</div>
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
						user:'',
						email:'',
						desable:false,
						showtitle:true,
						price:10,
						_token:''


					}
				},

				ready: function(){
					this.$refs.spinner.show();
					this.GetAuthUser();
				},
				methods:{
					GetAuthUser:function(){

						this.$http.get('/GetAuthUser').then(function (res) {
							this.user=res.body;
							this.email=res.body.email;
							this._token=document.getElementById('_token').getAttribute('value');
							this.$refs.spinner.hide();
							this.isloading=true;
						},function(res){


						});
					},
					AddCreditNow:function(){
							this.$refs.spinner.show();
							this.isloading=false;
						this.desable=true;
						var formData = new FormData()
						formData.append(
							'price' ,this.price
							)
						this.$http.post('/AddCartItme' ,formData).then(function(res){
                            this.$refs.spinner.hide();
                            this.$router.go(

                            	{
                            		path:'/ShowAllCharge'
                            	});
						},function(res){

						});
					}
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