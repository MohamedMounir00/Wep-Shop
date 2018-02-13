<template>
<header_nav></header_nav>
      <div class="container">
	<div>
	<span v-show="isloading">
		<div class="container">
		
    <div class="row">
       
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2 pull-right">
          <Mssage_menu></Mssage_menu>
        </div>
        <div class="col-sm-9 col-md-10 pull-left">
        <ol class="breadcrumb">
  <li  v-if=" viewtype == 'income'">
     <a v-link="{path:'/GetMyReseviedMessage'}"> الوارد </a>
  </li>
  <li v-else>
     <a v-link="{path:'/GetMySendMessage'}" >الصادر</a>
  </li>

  <li class="active">
    {{message.title}}
  </li>
</ol>
       

        <h2> تفاصيل الرساله </h2>
       <table class="table table-striped">
       	<tr>
       		<th>عنوان الرساله</th>
       		<td>{{message.title}}</td>
       	</tr>
       		<tr>
       		<th>نص الرساله</th>
       		<td>{{message.message}}</td>
       	</tr>
       		<tr>
       		<th>ارسلت فى </th>
       		<td>{{message.created_at}}	</td>
       	</tr>
       
       </table>
       <hr>
       <div v-if="viewtype !='send'"> 
        	 <h2>معلومات عن المرسل </h2>
       <table class="table table-striped">
       	<tr>
       		<th>الاسم</th>
       		<td>
       		<a v-link="{name:'/UserServices',params:{user_id:message.get_send_user.id , username:message.get_send_user.name}}">
       		{{ message.get_send_user.name }}
</a>
       		</td>
       	</tr>
       		<tr>
       		<th>البريد الالكترونى</th>
       		<td>{{ message.get_send_user.email }}</td>
     </tr>
     

       </table>
         <send_message :user="message.get_send_user"></send_message>
         	</div>
         	  <div v-else> 
        	 <h2>معلومات عن المرسل اليه </h2>
       <table class="table table-striped">
       	<tr>
       		<th>الاسم</th>
       		<td>
       		<a v-link="{name:'/UserServices',params:{user_id:message.get_resived_user.id , username:message.get_resived_user.name}}">
       		{{ message.get_resived_user.name }}
</a>
       		</td>
       	</tr>
       		<tr>
       		<th>البريد الالكترونى</th>
       		<td>{{ message.get_resived_user.email }}</td>
       	</tr>
       		
       
       </table>
       <send_message :user="message.get_resived_user"></send_message>
         	</div>

        </div>
    </div>
</div>

</span>
<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
	</div>
</template>
<script >
  var spinner = require('vue-strap/dist/vue-strap.min').spinner;
import SendMessage from '../buttons/sendMessage.vue';
        import Header from '../layouts/header.vue';

	import MnueMessage from './MessageMenu.vue';
	export default{
		components:{
	spinner:spinner,
	Mssage_menu:MnueMessage,
	send_message:SendMessage,
             header_nav:Header,

},
	data(){
			return {
           messagelist:[],

				message:"",
				 isloading:false,
				 viewtype:"",
         

				}
			},
			ready: function(){
				this.viewtype =this.$route.params.viewtype;
  this.$refs.spinner.show();

  this.GetThisMessageDetiles();
},

			methods:{
				GetThisMessageDetiles:function(){

				   this.$http.get('/GetThisMessageDetiles/'+this.$route.params.message_id).then(function(res){

     this.message=res.body;
    this.$refs.spinner.hide();
    this.isloading=true;
  }, function(res){
    //alert('هناك خهطاء برجاء مراسله الاداره');
  }); 
 }

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