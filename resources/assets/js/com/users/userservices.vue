<template>
<header_nav></header_nav>
      <div class="container">
 <div>
<span v-if="isloading">

  <h3 class=""><span class="label label-default"><i class="fa fa-user"></i> الخدمات الخاصه بالعضو{{ user.name}}</span></h3>

  <div class="alert alert-warning">
    <h3>   <span class="label label-danger">
     هذا العضو  لديه
     {{ services.length}}
     خدمات على الموقع
   </span></h3>
 </div>
  <div class="row">
  <div class="col-lg-6 col-sm-12 pull-right">
    <div class="btn-group ">
      <button class="btn btn-info" @click="Sort('price')">
        
        على حسب السعر
      </button>
      
      <button class="btn btn-info" @click="Sort('status')">
        
        فى انتظار وفقه الاداره
      </button>
      <button class="btn btn-info" @click="Sort('id')">
        
        المضاف اخير
      </button>
    </div>
  </div>
  <div class="col-lg-5 col-sm-12 pull-left text-left">
    <input type="text" name="" v-model="services_name" placeholder="ابحث عن اسم الخدمه" class="form-control">
  </div>
</div>
<br>

<div class="row" >
  <span  v-if="services.length > 0">
    
    <div v-for="service in services | orderBy sortkey unvircse |filterBy services_name in 'name' 'price' "  track-by="$index" class="col-sm-6 col-md-4 pull-right">
      <singel_services  :service="service" >  </singel_services>
    </div>
    <div  v-if="services.length > 12">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-info" v-if="nomore" @click="showmore()">
  المزيد
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-danger" v-if="!nomore" @click="showmore()">
 لا يوجد المزيد من الخدمات
</div>
<div class="clearfix"></div>
<br>
</div>
  </span>
  <span v-else>
    <div class="alert-warning">
      
     {{user.name}}
     ليس لديه خدمات حاليا
   </div>
 </span>
 
</div>
</span>

<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
</div>
</div>
</template>
<script >
  var spinner = require('vue-strap/dist/vue-strap.min').spinner;

  import SingelSerives from './singelServices.vue';
              import Header from '../layouts/header.vue';


  export default{
   components:{
     spinner:spinner,

     singel_services:SingelSerives,
                  header_nav:Header,

   },
   data: function(){

    return{
     isloading:false,
     user:"",
     services:[],
     sortkey:'',
     unvircse:1,
     nomore:true
   }
 },

 ready: function(){
  this.$refs.spinner.show();

  this.getUserServices();
},
methods:{
 getUserServices: function(length){
if (length !== undefined) {

  var sendlen = '/'+length;
  }else{
    var sendlen = '';
  }
   this.$http.get('/getUserServices/'+this.$route.params.user_id+sendlen).then(function(res){
if (length !== undefined) {
  if (res.body['services'].length >0) {
    this.services=this.services.concat(res.body['services']);
  }else{
  this.nomore=false;
  }

}else{


    this.user=res.body['user'];
    this.services=res.body['services'];
    this.$refs.spinner.hide();
    this.isloading=true;
    }
  }, 
   
 function(res){
    alert('هناك خهطاء برجاء مراسله الاداره');
  }); 
 }
 ,
showmore:function(){
  var length  = this.services.length
  this.getUserServices(length);
}
 ,Sort:function(Sort)
 {
  this.unvircse= (this.sortkey == Sort) ? this.unvircse * -1 : 1;
  this.sortkey= Sort;
}
}
,route:{
        canReuse:false,///forse reload data
      },
           events:{
AddToParent:function(value){
 //alert(value);
  this.$broadcast('AddToSonInHeader',value);
}
      }


    }

  </script>