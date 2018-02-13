<template>
<header_nav></header_nav>
      <div class="container">
 <div class="col-lg-12 ">
<span v-if="isloading">
   <div class="row">
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right"> 
   <div class="row">
  <div class="col-lg-6 col-sm-12 pull-right">
    <div class="btn-group ">
      <button class="btn btn-info" @click="Sort('price')">
        
        على حسب السعر
      </button>
      
      <button class="btn btn-info" @click="Sort('vote_sum')">
        
       الاكثر تقيما
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
      
     
     ليس لديه خدمات حاليا
   </div>
 </span>
 
</div>
</div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-left"> 
  <main_side_bar  :section1="section1" :section2="section2" :section3="section3"></main_side_bar>
  </div>
  </div>
</span>
<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
</div>
</div>

</template>
<script >
  var spinner = require('vue-strap/dist/vue-strap.min').spinner;

  import SingelSerives from '../users/singelServices.vue';
  import SideBar from './MainSideBar.vue' ;
  import Header from '../layouts/header.vue';

  export default{
   components:{
     spinner:spinner,
     main_side_bar:SideBar,
    singel_services:SingelSerives,
     header_nav:Header

   },
   data: function(){

    return{
     isloading:false,
    //cats:[],
     services:[],
     sortkey:'',
     unvircse:1,
     section1:[],
     section2:[],
     section3:[],
      nomore:true
   }
 },

 ready: function(){
  this.$refs.spinner.show();

  this.getAllServices();
},
methods:{
 getAllServices: function(length){
  if (length !== undefined) {

  var sendlen = '/'+length;
  }else{
    var sendlen = '';
  }
   this.$http.get('/getAllServices'+sendlen).then(function(res){

    if (length !== undefined) {
  if (res.body['services'].length >0) {
    this.services=this.services.concat(res.body['services']);
  }else{
  this.nomore=false;
  }

}else{

 this.services=res.body['services'];
     //this.cats=res.body['cats'];
     this.section1=res.body['sidebarsection1'];
  this.section2=res.body['sidebarsection2'];
    this.section3=res.body['sidebarsection3'];


    
    this.$refs.spinner.hide();
    this.isloading=true;
    }
   
  }, function(res){
    alert('هناك خهطاء برجاء مراسله الاداره');
  }); 
 },
showmore:function(){
  var length  = this.services.length
  this.getAllServices(length);


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
  this.$broadcast('AddToSonInHeader',value);
}
      }

    }

  </script>