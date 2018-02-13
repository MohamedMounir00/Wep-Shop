<template>
  <header_nav></header_nav>
      <div class="container">
    <div class="col-lg-12">
     <done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
     <span class="icon-ok-circled alert-icon-float-right"></span>
     <b> تم:</b>
         <p> 
         تم تغير حاله الخدمه بنجاح

               </p>
    </done_message>
<error_message :show.sync="error" placement="top-left" duration="3000" type="danger" width="400px" dismissable>
       <span class="icon-ok-circled alert-icon-float-right"></span>
            <b> خطاء:</b>
                     <p> 
           هناخ خطاء برجاء الاتصال بالاداره
         </p>
      </error_message>
        <div class="row">
            <div class="col-lg-9 pull-right">
                <span v-if="isloading">
                    
                 <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <div class="content-wrapper">
                        <div class="item-container">
                            <div class="container">
                                <div class="col-md-12">
                                 <span class="product-title pull-right">
                                     {{order.service.name}}
                                     <status :status="order.status"></status>
                                 </span>
                                 <span class="small pull-left"><i class="fa fa-clock-o"></i> {{order.created_at}}</span>
                                 <div class="clearfix"></div>
                                 <div class="product-rating">
                                     <i class="fa fa-star gold"></i> 
                                     <i class="fa fa-star gold"></i>
                                     <i class="fa fa-star gold"></i>
                                     <i class="fa fa-star gold"></i>
                                     <i class="fa fa-star-o"></i> 
                                 </div>

                             </div>
                             <br>
                            


                             <div class="col-md-12">
                                <img id="item-display"  class="img-responsive" v-bind:src="'/images/services/'+order.service.image" alt="{{order.service.name}}">



                            </div>

                            <div class="col-md-12">
                                <div class="product-desc">{{order.service.des}}</div>
                                <hr>
                                <div class="product-price pull-left">$ {{order.service.price}}</div>
                                <div class="product-price pull-right"> 
                                   
                                   عدد مرات الشراء
                                   ({{order_count}})
                               </div>
                               <div class="clearfix"></div>

                               <hr>
                               
                           </div>
                       </div>
                       
                   </div>
                      </div>
           </div>
         
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <all_comment :order="order"></all_comment>
            </div>
                        

       </span>
       <spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
   </div>
   <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12 pull-left">
    <div class="clearfix" >
                               <span v-if="AuthUser.id == user_id.id" >
                               <div v-if="showbuttinsStatus">
                                     <button class="btn btn-success pull-right" @click="ChangStatus(2)">
                                   <i class="fa fa-check"></i>
                                   قبول
                                 </button>
                                 <button class="btn btn-danger pull-left"  @click="ChangStatus(3)">
                                  <i class="fa fa-close"></i>
                                  رفض
                                 </button>
                               </div>
                             
                               </span>
                               <span v-if="AuthUser.id == order_user.id" >
                               <div v-if="showbuttinsStatus2" >
                                     <button class="btn btn-success pull-right" @click="finshOrder(4)">
                                   <i class="fa fa-check"></i>
                                  انهى الطلب
                                 </button>
                                 
                               </div>
                             
                               </span>
                             </div>
                             <br>
    <div>
        <user_id :user="user_id"></user_id>
    </div>
    <div>
        <user_id :user="order_user"></user_id>
    </div>

</div>

</div>

</div>
</div>
</template>


<script>
    var spinner = require('vue-strap/dist/vue-strap.min').spinner;
    var Alert = require('vue-strap/dist/vue-strap.min').alert;
    import UserSidebar from '../users/userSidebar.vue';
    import status from '../buttons/status.vue';
    import AllComment from '../comment/AllComment.vue';
              import Header from '../layouts/header.vue';


    export default{
        components:{
            user_id:UserSidebar,
            spinner:spinner,
            status:status,
          all_comment:AllComment,
           done_message:Alert,
            error_message:Alert,
                           header_nav:Header


        },
        data(){
            return{
                service:"",
                isloading:false,
                order_user:'',
                user_id:'',
                order:'',
                order_count:'',
                AuthUser:'',
                 done:false,
                error:false,
                showbuttinsStatus:false,
                showbuttinsStatus2:false
            }
        },
        ready: function(){
            this.GetServicesById();
            this.$refs.spinner.show();
        },
        methods:
        {
            GetServicesById: function(){
                this.$http.get('/GetOrderById/'+this.$route.params.order_id).then(function(res){
                   this.order=res.body['order'];
                   this.user_id=res.body['user_id'];
                   this.order_user=res.body['order_user'];
                   this.order_count=res.body['order_count'];
                   this.AuthUser=res.body['auth_user'];
                   
                   if (this.order.status != 2 && this.order.status != 3 && this.order.status != 4 ) {
                    this.showbuttinsStatus =true; // لو  الطلب  ليس   ملغى او تم  اظهر   المفاتيح السابقه
                   }

                   if (this.order.status != 3 && this.order.status != 4 && this.order.status !=0 && this.order.status !=1) {
                    this.showbuttinsStatus2 =true; // لو  الطلب  ليس   ملغى او تم  اظهر   المفاتيح السابقه
                   }

                    
                   
                   if (this.order.status == 3) {
                  this.$dispatch('disableAddComment' ,'true'); 
                  // لو الطلب ملغى اقفلى الكمنت محدش يعرف يضيف كمنت
                }
                   this.$refs.spinner.hide();
                   this.isloading=true;
               },function(res){
                this.$router.go(
                    {path:'/'}
                    );
            });
            },
             ChangStatus:function (status) {
                this.$refs.spinner.show();
                if (status == 3) {
                  this.$dispatch('disableAddComment' ,'true'); 
                  // لو الطلب ملغى اقفلى الكمنت محدش يعرف يضيف كمنت
                }
             this.$http.get('/ChangStatus/'+this.$route.params.order_id+'/'+status).then(function(res){
               this.showbuttinsStatus =false;
               this.$refs.spinner.hide();
               this.done=true;
               },function(res){
                this.error=true;
            });
            }
              , finshOrder:function (status) {
            
             this.$http.get('/finshOrder/'+this.$route.params.order_id).then(function(res){
               //this.showbuttinsStatus2 =false;
               this.$refs.spinner.hide();
               this.done=true;
               },function(res){
                this.error=true;
            });
            }
        },route:{
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
