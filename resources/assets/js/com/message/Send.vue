<template>
<header_nav></header_nav>
		<div>
		<div class="container">
		
    <div class="row">
       
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2 pull-right">
          <Mssage_menu></Mssage_menu>
        </div>
        <div class="col-sm-9 col-md-10 pull-left">
        		<div class="message">
			<done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
			<span class="icon-ok-circled alert-icon-float-right"></span>
			<b> تم:</b>
			<p> 
				تم ارسال الرساله بنجاح

				
			</p>
			</done_message>
			<error_message :show.sync="error" placement="top-left" duration="3000" type="danger" width="400px" dismissable>
			<span class="icon-ok-circled alert-icon-float-right"></span>
			<b> خطاء:</b>
			<p> 
				هناك خطاء فى ارسال الرساله
			</p>
			</error_message>

		</div>
         	<validator name="validation1">
					<form novalidate>
					<div class="form-group" >
					<label for="title"> العنوان </label>
						<input type="text" placeholder="اضف عنوان" name="title" v-model="title" @valid="showtitle = false"class="form-control" v-validate:title="{required:true ,minlength:5 , maxlength:500}" >

						<div class="form-group alert alert-danger" v-if="showtitle">
								<p v-if="$validation1.title.required">هذا الحقل مطلوب</p>
								<p v-if="$validation1.title.minlength"> يجب ان يكون العنوان اكثر من 5 حروف</p>
								<p v-if="$validation1.title.maxlength"> العنوان  لا يجب ان يتعدى 50 حرف</p>

							</div>
					</div>
						<div class="form-group">
						<label for="name"> نص الرساله </label>
			       <textarea class="form-control" placeholder="add A message" rows="3"   @valid="showmessage = false" v-model="message" v-validate:message="{required:true ,minlength:5 , maxlength:500}"></textarea>
							<div class="form-group alert alert-danger" v-if="showmessage">
								<p v-if="$validation1.message.required">هذا الحقل مطلوب</p>
								<p v-if="$validation1.message.minlength"> نص الرساله يجب ان يكون اكثر من 5 حروف</p>
								<p v-if="$validation1.message.maxlength">  نص الرساله لا يجب  ان يتعدى اكثر من 500 حرف</p>

							</div>
						</div>
						<div class="form-group">

							<button type="submit"  v-bind:disabled="disable" @click.prevent="AddMessage()" class="btn btn-success green"><i class="fa fa-comment"></i> Add</button>
						</div>
					</form>
				</validator>
         
            
        </div>
    </div>
</div>

	</div>
</template>

<style>
	.message{
		position: absolute;
		top: 120px;
		right: 10px;
		z-index: 10000;

	}
	
</style>
<script>
import MnueMessage from './MessageMenu.vue';
	        import Header from '../layouts/header.vue';

var Alert = require('vue-strap/dist/vue-strap.min').alert;
	export default{
components:{
	Mssage_menu:MnueMessage,
		done_message:Alert,
			error_message:Alert,
					header_nav:Header

	},
		data(){
			return {
				disable:true,
				message:'',
				title:'',
				done:false,
				error:false,
				showmessage:true,
				showtitle:true,
			}
		},
		computed:{
			disable: function () {
				if (this.showmessage == false && this.showtitle == false) {

					return false;
				}
				else{
					return true;
				}			}
		},
		methods:{
						AddMessage:function () {
			var formData = new FormData();
				formData.append('user_id',this.$route.params.user_id);
				formData.append('message',this.message);
				formData.append('title',this.title);
				this.$http.post('/AddMessage/',formData).then(function(res) {
					this.message="";
					this.title="";
				    this.done=true;
				    this.disable=true;
				    this.showmessage=true;
				    this.showtitle=true;

				


				},function (res) {

				this.error=true;

				});
			}		,route:{
        canReuse:false,///forse reload data
      }
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