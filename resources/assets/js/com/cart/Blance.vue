		<template>
			<header_nav></header_nav>
      <div class="container">
			<div class="col-lg-12">
				
				<span v-if="isloading">
					<h3 class=""><span class="label label-default"><i class="fa fa-money "></i> 
					الرصيد الخاصه بالعضو {{ user.name}}</span></h3>
<div class="col-lg-8">
	

				  <div class="row">
				                   <div class="col col-lg-4">
										<div class="well text-center">
											<h3>
												الرصيد الحالى
											</h3>
											<p> {{(parseInt(userChearhe) + parseInt(realProft)) - (parseInt(userPay) +parseInt(userDoneProfit) +parseInt(userWaitProfit))}} $</p>
										</div>
									</div>
									
										
									<div class="col col-lg-4">
										<div class="well text-center">
										<a  v-link="{path:'/ShowAllCharge'}">
											<h3>
												شحن الحساب
											</h3>
											</a>
											<p> {{userChearhe}}$</p>
										</div>
									</div>
									
									
				                   <div class="col col-lg-4">
										<div class="well text-center">
										<a  v-link="{path:'/ShowAllPay'}">

											<h3>
												المدفوعات
											</h3>
											</a>
											<p> {{userPay}}$</p>
										</div>
									</div>

						</div>
					  <div class="row">
									<div class="col col-lg-3">
											<div class="well text-center">
												<h3>
													اجمالى الارباح
												</h3>
												<p> {{ parseInt(userWaitProfit) + parseInt(userProfit)}} $</p>
											</div>
									</div>
										<div class="col col-lg-3">
											<div class="well text-center">
											<a  v-link="{path:'/profit'}">
												<h3>
													ارباح للسحب
												</h3>
												</a>
												<p> {{userCanProfit}}$</p>
											</div>
										</div>
										<div class="col col-lg-3">
											<div class="well text-center">
												<a  v-link="{path:'/RetainedProfits'}">


												<h3>
													ارباح محتجزه
												</h3>
												</a>
												<p> {{userWaitProfit}}$</p>
											</div>
										</div>
											<div class="col col-lg-3">
											<div class="well text-center">
												<a  v-link="{path:'/RetainedProfits'}">


												<h3>
													ارباح مسحوبه
												</h3>
												</a>
												<p> {{userDoneProfit}}$</p>
											</div>
										</div>
					       </div>
            
							</div>		
<div class="col-lg-4">

					<div class="row">
						<div class="form-group">
							<label for=""> سحب الارباح </label>
							<input type="text" name="" v-model="userCanProfit" class="form-control">
						</div>
						<div class="alert alert-warning">
							<b>  ملحوظه:</b>
							<span>
								يمكنك سحب الارباح فقط  ولا يمكنك سحب اى رصيد اخر
							</span>
						</div>
					
					<div class="bigdive">
<div class="message">
     <done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
     <span class="icon-ok-circled alert-icon-float-right"></span>
     <b> تم:</b>
         <p> 
تم ارسال طلبك لاداره سوف يتم ارسال تنبيه اليك فى حاله ارسال المبلغ
               </p>
    </done_message>
<error_message :show.sync="error" placement="top-left" duration="3000" type="danger" width="400px" dismissable>
       <span class="icon-ok-circled alert-icon-float-right"></span>
            <b> خطاء:</b>
                     <p> 
لا يمكنك سحب الرصيد لاساب التاليه            <br>
            1- يجب ان يكون رصيدك اكبر من 10 دولار
            <br>
            2- او ان رصيدك الحالى لا يسمح بارجاء السحب
            <br>
         </p>
      </error_message>

</div>


                        
</div>
	<div class="form-group">
						<input type="submit"   @click="Getprofit()" name="" value="سحب الرصيد" class="btn btn-info">
						</div>
					</div>
					</div>

				</span>
				<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
</div>
</div>
</template>
			
<style>
    .message{
        position: absolute;
        bottom: 60px;
        right: 20px;
        z-index: 10000;

    }
    .bigdive{
        display: inline-block;
    }
</style>

		<script >
		var Alert = require('vue-strap/dist/vue-strap.min').alert;

			var spinner = require('vue-strap/dist/vue-strap.min').spinner;

            import Header from '../layouts/header.vue';

			export default{
				components:{
					spinner:spinner,
					header_nav:Header,
				    done_message:Alert,
                    error_message:Alert



				},
				data: function(){

					return{
						isloading:false,
						user:'',
						userPay:0,
						userProfit:0,
						userChearhe:0,
						profit:0,
						done:false,
                        error:false,
                        userWaitProfit:0,
                        userDoneProfit:0,
                        realProft:0,
                        userCanProfit:0


					

					}
				},

				ready: function(){
					this.$refs.spinner.show();
					this.ShowAllProfit();
				},
				computed:{
userCanProfit:function(){
	var p = parseInt(this.userChearhe)  - parseInt(this.userPay) ;
	var pro = parseInt(this.realProft)-(parseInt(this.userDoneProfit) +parseInt(this.userWaitProfit));
	if (p > 0) {
		return pro ;
	}else{
		return parseInt(p) - parseInt(this.userChearhe)  + parseInt(pro);
	}
}
				},
				methods:{
					ShowAllProfit:function(){

						this.$http.get('/ShowAllBlance').then(function (res) {
							
							this.user=res.body['user'];
							this.userPay=res.body['userPay'];
							this.userProfit=res.body['userProfit'];
							this.userChearhe=res.body['userChearhe'];
			            	this.profit=res.body['userProfit'];
			            	this.userWaitProfit=res.body['userWaitProfit'];
			            	this.userDoneProfit=res.body['userDoneProfit'];
			            	this.realProft=res.body['realProft'];

			            	
							this.$refs.spinner.hide();
							this.isloading=true;
						},function(res){


						});
					},
					Getprofit:function(){
						this.$refs.spinner.show();
						var formData = new FormData();
						formData.append('profit' , this.userCanProfit);

						this.$http.post('/Getprofit',formData).then(function (res) {
							
							this.userProfit= parseInt(this.userProfit) - parseInt(res.body);

			            	this.userCanProfit= parseInt(this.userCanProfit) - parseInt(res.body);
			                this.userWaitProfit= parseInt(this.userWaitProfit) + parseInt(res.body);


                             this.done=true;

							this.$refs.spinner.hide();
							this.isloading=true;
						},function(res){
						    this.error=true;
							this.$refs.spinner.hide();

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