<template>
<header_nav></header_nav>
      <div class="container">
  <span v-show="isloading">
    <h3 class=""><span class="label label-default"><i class="fa fa-user"></i> الخدمات الخاصه بالعضو{{ user.name}}</span></h3>

    <div class="alert alert-warning">
      <h3>   <span class="label label-danger">
        انت الان لديك
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
          
          هذا العضو ليس لديه خدمات مضافه
          <a  v-link="{path:'/AddServices'}">
           <i class="fa fa-plus"></i>
           اضف خدمه
         </a>
       </div>
     </span>
     
   </span>
   <spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
</div>
 </template>

 <script>
  var spinner = require('vue-strap/dist/vue-strap.min').spinner;

  import SingelSerives from './singelServices.vue';
          import Header from '../layouts/header.vue';


  export default{
   components:{

    singel_services:SingelSerives,
    spinner:spinner,
               header_nav:Header

  },
  data: function(){

    return{
      services:[],
      sortkey:'',
      unvircse:1,
      user:'',
      isloading:false,
       nomore:true
    }
  },
  ready:function()
  {
    this.$refs.spinner.show();
    this.getMyservices();
  },
  methods:{
    getMyservices: function(length){
        if (length !== undefined) {

  var sendlen = '/'+length;
  }else{
    var sendlen = '';
  }

      this.$http.get('/getMyservices'+sendlen).then(function(res){

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
        
        

      },

      function(res){
        alert('خطاء غير عروف');

      });
    }
    ,
showmore:function(){
  var length  = this.services.length
  this.getMyservices(length);


}
    ,Sort:function(Sort)
    {
      this.unvircse= (this.sortkey == Sort) ? this.unvircse * -1 : 1;
      this.sortkey= Sort;
    }
  },

  filters:
  {
    limit: function (string ,value){

      return string.substring(0 ,value )+'...';
    }
  }
,

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
