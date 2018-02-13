<template>
    

<div class="bigdive">
<div class="message">
     <done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
     <span class="icon-ok-circled alert-icon-float-right"></span>
     <b> تم:</b>
         <p> 
         تم  طلب الخدمه بنجاح فى انتظار رد  مقدم الخدمه 

              <a href="#" v-link="{path:'/SendOrder'}">لعرض تفاصيل الخدمه </a>
               </p>
    </done_message>
<error_message :show.sync="error" placement="top-left" duration="3000" type="danger" width="400px" dismissable>
       <span class="icon-ok-circled alert-icon-float-right"></span>
            <b> خطاء:</b>
                     <p> 
            لا يمكنك  طلب الخدمه الاحد الاساب   التاليه 
            <br>
            1- هذه الخدمه مضافه من  طرفك
            <br>
            2- هذه الخدمه  قمت  بطلبها سابقا
            <br>
            3-هذه الخدمه غير موجوده
         </p>
      </error_message>

</div>

<button @click.prevent="AddOrder()"  v-bind:disabled="dis" class="  btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span>اشترى</button>
                        
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


    export default{
        components: {
            done_message:Alert,
            error_message:Alert
  },
        props:['service'],
       data: function(){   
                return{
                done:false,
                error:false,
                    dis:false,
                }
            }
        ,methods:{
    AddOrder :function () {
        this.dis=true;
        this.$http.get('/AddOrder/'+this.service.id).then(function(res){
       this.done=true;
 //alert('sssssssss')
        },function (res) {
            

                   this.error=true;

            //alert('nnnnnnn')
        });
        this.dis=false;
    }
}

    }
</script>