<template>
	<div>
	<span v-if="showComment">
		<add_comment :order="order"></add_comment>
	</span>
		

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-lg-6 col-sm-12 pull-right">
							<h2 class=""> التعليقات
								( {{ comments.length }} )
							</h2>
						</div>
						<br>
						<div class="col-lg-3 col-sm-12 pull-left">
							<div class="btn-group ">
								

								<button class="btn btn-info" @click="Sort('created_at')">

									التاريخ
								</button>
								<button class="btn btn-info" @click="Sort('id')">

									المضاف اخير
								</button>
							</div>
						</div>
						<div class="col-lg-3 col-sm-12 pull-left text-left">
							<input type="text" name="" v-model="username" placeholder="ابحث باسم العضو" class="form-control">
						</div>
					</div>

					<div v-if="comments.length > 0" >

						<section v-for="comment in comments | orderBy sortkey unvircse |filterBy username in 'user.name'  " track-by="$index"class="comment-list ">
							<!-- First Comment -->
							<article class="row">
								<div class="col-md-2 col-sm-2 col-xs-2 pull-right">
									<figure class="thumbnail">
										<img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
										<figcaption class="text-center"> </figcaption>
									</figure>
								</div>
								<div class="col-md-10 col-sm-10 col-xs-10 pull-left">
									<div class="panel panel-default arrow left">
										<div class="panel-body">
											<header class="text-left">
												<div class="comment-user">
													<a  v-link="{name:'/UserServices' , params:{user_id:comment.user.id , username:comment.user.name}}">
														<i class="fa fa-user"></i> 
														{{comment.user.name}}
													</a>
												</div>
												<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{comment.created_at}}</time>
											</header>
											<div class="comment-post">
												<p>
													{{comment.comment}}.
												</p>
											</div>

										</div>
									</div>
								</div>
							</article>
						</section>

					</div>
					<div v-else>
						<div class="alert alert-warning">
							<b> عفوا</b>
							<span> لا يوجد تعليقات على هذه الخدمه </span>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script >
	import AddComment from './AddComment.vue';
	export default{
		components:{
			add_comment:AddComment,
		},

		props:['order'],
		data(){
			return {
				comments:[],
				sortkey:'',
				unvircse:1,
				username:'',
				showComment:true
			}
		},
		ready: function(){
			this.GetAllComment();
		},
		methods:{
			GetAllComment: function () {
				this.$http.get('GetAllComment/'+this.order.id).then(function(res) {
					this.comments=res.body;
					


				},function (res) {


				});
			},
			Sort:function(Sort)
			{
				this.unvircse= (this.sortkey == Sort) ? this.unvircse * -1 : 1;
				this.sortkey= Sort;
			}
		},
		events:{
			AddComment:function(val){
				this.comments.push(val);

			},
			disableAddComment:function(val)
			{
				if (val =='true') {
					this.showComment = false;
				}
			}
		}

	}
</script>