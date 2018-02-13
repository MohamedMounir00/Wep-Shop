<template>
	<div>
		<div class="message">
			<done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
			<span class="icon-ok-circled alert-icon-float-right"></span>
			<b> تم:</b>
			<p> 
				تم  اضافه التعلقي  بنجاح

				
			</p>
			</done_message>
			<error_message :show.sync="error" placement="top-left" duration="3000" type="danger" width="400px" dismissable>
			<span class="icon-ok-circled alert-icon-float-right"></span>
			<b> خطاء:</b>
			<p> 
				عفوا لا يمكن  اضافه تعليف اكثر من 1000 حرف واقل من 5احرف
			</p>
			</error_message>

		</div>
		<div>
			<div class="">
				<validator name="validation1">
					<form novalidate>
						<div class="form-group">
							<textarea class="form-control" placeholder="add A comment" rows="3"   @valid="valid" v-model="comment" v-validate:message="{required:true ,minlength:5 , maxlength:1000}"></textarea>
							<div class="form-group alert alert-danger" v-if="disable">
								<p v-if="$validation1.message.required">هذا الحقل مطلوب</p>
								<p v-if="$validation1.message.minlength"> التعليق يجب ان يكون اكثر من 5 حروف</p>
								<p v-if="$validation1.message.maxlength"> التعلقيق لا يجب ان يكون اكثر من 1000 حرف</p>

							</div>
						</div>
						<div class="form-group">

							<button type="submit"  v-bind:disabled="disable" @click.prevent="AddComment()" class="btn btn-success green"><i class="fa fa-comment"></i> Add</button>
						</div>
					</form>
				</validator>

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
<script >
	var Alert = require('vue-strap/dist/vue-strap.min').alert;

	export default{
		components: {
			done_message:Alert,
			error_message:Alert
		},
		props:['order'],

		data(){
			return {
				disable:true,
				comment:'',
				done:false,
				error:false,
			}
		},
		methods:{
			valid: function () {
				this.disable =false;
			},
			AddComment:function () {
				var formData = new FormData();
				formData.append('order_id',this.order.id);
				formData.append('comment',this.comment);
				this.$http.post('AddComment/',formData).then(function(res) {
					this.done=true;
					this.comment='';
					this.$dispatch('AddComment',res.body);


				},function (res) {

					this.error=true;
					this.comment='';
				});
			}
		}
		
		
	}
</script>