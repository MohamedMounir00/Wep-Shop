<template>
  <header_nav></header_nav>
      <div class="container">
  <div class="col-lg-12">

    <div v-if="isloading">

      <h3 class=""><span class="label label-default"><i class="fa fa-user"></i> طلبات البيع الخاصه بالعضو{{ user.name}}</span></h3>

      <div class="alert alert-warning">
        <h3>   <span class="label label-danger">
          انت الان لديك
          {{ services.length}}
          طلبات بيع
        </span></h3>
      </div>
      <div class="row">
        <div class="col-lg-6 col-sm-12 pull-right">
          <div class="btn-group ">
            <button class="btn btn-info" @click="filter('0')">
              
             طلب جديد
           </button>
           
           <button class="btn btn-default" @click="filter('1')">
            
            طلب قديم
          </button>
          <button class="btn btn-danger" @click="filter('3')">
            
           طلب ملغي
         </button>
         <button class="btn btn-warning" @click="filter('2')">
          
          طلب قيد التنفيذ
        </button>
        <button class="btn btn-success" @click="filter('4')">
          
          طلب منتهي
        </button>
        <button class="btn btn-primary "  @click="filter('')">
          
         كل الطلبات
       </button>
     </div>
   </div>
   <div class="col-lg-5 col-sm-12 pull-left text-left">
    <input type="text" name="" v-model="services_name" placeholder="ابحث عن اسم الخدمه" class="form-control">
  </div>
</div>
<br>
<div class="row ">
 
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>حاله الطلب</b></div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>وقت الطلب</b></div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>اسم طالب الخدمه</b></div>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><b>اسم الخدمه</b></div>
  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><b>رقم العمليه</b></div>
  
</div>
<hr/>

<div v-if="services.length > 0">
  <div  v-for="service in services |filterBy filterData in 'status' | filterBy services_name in 'service.name'" track-by="$index">

    <orders :service="service" :user_to_show="service.get_my_orders"></orders>
  </div>
      <div  v-if="services.length > 12">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-info" v-if="nomore" @click="showmore()">
  المزيد
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-danger" v-if="!nomore" @click="showmore()">
 لا يوجد المزيد من الطلبات
</div>
<div class="clearfix"></div>
<br>
</div>
</div>

<div v-else>
 <div class="alert alert-warning">
   <b>: عفوا</b>
   <span>
     ليس لديك اى طلبات شراء
   </span>
 </div>
</div>

</div>

<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>


</div>
</div>
</template>

<script>
  var spinner = require('vue-strap/dist/vue-strap.min').spinner;
  import orders from './orders.vue';
            import Header from '../layouts/header.vue';



  export default{
    components:{
      spinner:spinner,
      orders:orders,
      header_nav:Header


    },

    data: function(){

      return{
       isloading:false,
       services:[],
       user:"",
       filterData:'',
            nomore:true


       
     }
   },
   ready: function(){
     this.$refs.spinner.show();

     this.GetMyIncomeOrders();
   },
   methods:{
     GetMyIncomeOrders:function(length){
        if (length !== undefined) {

  var sendlen = '/'+length;
  }else{
    var sendlen = '';
  }

      this.$http.get('GetMyIncomeOrders'+sendlen).then(function(res) {

        if (length !== undefined) {
  if (res.body['services'].length >0) {
    this.services=this.services.concat(res.body['services']);
  }else{
  this.nomore=false;
  }

}else{


      this.isloading=true;
        this.services=res.body['services'];
        this.user=res.body['user'];
        this.$refs.spinner.hide();
    }
     

      },function(res){


      });
    },
    filter:function(value)
    {
      this.filterData =value;
    }
    ,
showmore:function(){
  var length  = this.services.length
  this.GetMyIncomeOrders(length);


}

  },

        route:{
        canReuse:false,///forse reload data
    },events:{
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
