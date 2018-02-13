<template>
	<div style="display:inline-block">
	<div class="message">
     <done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
     <span class="icon-ok-circled alert-icon-float-right"></span>
     <b> تم:</b>
         <p> 
         تم اضافه الخدمه الى المفضله بنجاح

              <a href="#" v-link="{path:'/SendOrder'}">لعرض تفاصيل الخدمه </a>
               </p>
    </done_message>
<error_message :show.sync="error" placement="top-left" duration="3000" type="danger" width="400px" dismissable>
       <span class="icon-ok-circled alert-icon-float-right"></span>
            <b> خطاء:</b>
                     <p> 
            لا يمكنك  اضافه الخدمه الاحد الاساب   التاليه 
            <br>
            1- هذه الخدمه مضافه من  طرفك
            <br>
            2- هذه الخدمه  قمت  اضافتها سابقا
            <br>
            3-هذه الخدمه غير موجوده
         </p>
      </error_message>

</div>
		  <button @click.prevent="Addfav()"  v-bind:disabled="dis"type="button" class="btn btn-danger">
		  <i class="fa fa-heart"></i>
                       المفضله
                  </button>
	</div>
</template>

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
    Addfav :function () {
        this.dis=true;
        this.$http.get('/Addfav/'+this.service.id).then(function(res){
          this.$dispatch('AddToParent' , res.body);
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