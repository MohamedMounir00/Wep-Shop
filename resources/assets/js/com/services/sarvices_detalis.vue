<template  xmlns:v-el="http://www.w3.org/1999/xhtml">
<div>
<header_nav></header_nav>
      <div class="container">
    <span v-if="isloading">
      
     <div class="col-lg-9 col-sm-12 col-md-9 col-xs-12 pull-right">


        <div class="content-wrapper">
            <div class="item-container">
                <div class="container">
                    <div class="col-md-12">
                       <span class="product-title pull-right">{{service.name}} </span>
                       <span class="small pull-left"><i class="fa fa-clock-o"></i> {{service.created_at}}</span>
                       <div class="clearfix"></div>
                       <div class="product-rating pull-right">
                   <rating :service="service"></rating>

                        </div>
                        <div class="pull-left" v-if=" service.vote_count >0">
                          <span class=" label label-info">
                            <i class=" fa fa-user"></i>
                            
                            {{service.vote_count}}
                          </span>
                            <span class=" label label-warning">
                            <i class=" fa fa-star"></i>
                           
                            {{sum}}
                          </span>
                          <span class="label label-success">
                         
                            {{(sum * 100 /(service.vote_count*5))}} %
                          </span>
                        </div>

                         <div class="pull-left" v-else>
                          <span class=" label label-info">
                            <i class=" fa fa-user"></i>
                            
                            0
                          </span>
                            <span class=" label label-warning">
                            <i class=" fa fa-star"></i>
                           
                           0
                          </span>
                          <span class="label label-success">
                         
                            0 %
                          </span>
                        </div>
                       <div class="clearfix"></div>


                   </div>
                   <br>

                   <div class="col-md-12">
                    <img id="item-display"  class="img-responsive" v-bind:src="'/images/services/'+service.image" alt="{{service.name}}">



                </div>

                <div class="col-md-12">
                    <div class="product-desc">{{service.des}}</div>
                    <hr>
                    <div class="product-price pull-left">$ {{service.price}}</div>
                    <div class="product-price pull-right">
                       عدد مرات الشراء
                       ({{order_count}})

                   </div>
                   <div class="clearfix"></div>
                   <hr>
                   <div class="">
                     <btn_buy :service="service"></btn_buy>
                     
                   <btn_fave :service="service"></btn_fave>
              </div>
          </div>
      </div>
  </div>
  <div class="container-fluid">
    <div class="col-md-12 product-info">
        <ul id="myTab" class="nav nav-tabs nav_tabs " style="padding-right: 0px;">

            <li class="active"><a href="#service-one" data-toggle="tab">خدماتى فى نفس القسم</a></li>
            <li><a href="#service-two" data-toggle="tab">خدمات اخرى</a></li>


        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="service-one">
               <div class="row">
               <div v-if="myOwnServicesIntheCat.length >0" >
                 <div v-for="service in myOwnServicesIntheCat"  track-by="$index" class="col-sm-6 col-md-4 pull-right">
                     <br>
                     <my_own_services_in_the_cat :service="service"> </my_own_services_in_the_cat>       

                 </div>
                 </div>
             </div>
             </div>
             <div class="tab-pane fade" id="service-two">


               <div class="row">
               <div v-if="otherServicesIntheCat.length >0" >
                 <div v-for="service in otherServicesIntheCat"  track-by="$index" class="col-sm-6 col-md-4 pull-right">
                     <br>
                     <other_services_in_thecat :service="service"> </other_services_in_thecat>       

                 </div>
                 </div>

             </div>
         </div>

     </div>
     <hr>
 </div>
</div>
</div>
</div>
  <div class="col-lg-3 col-sm-12 col-md-3 col-xs-12 pull-left">
         <sidebar :service="service" :most_vote="mostvote" :most_view="mostview" :section="section"></sidebar>
     </div>
</span>
<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>


</div>
</div>
</template>

<script>
import Rating from '../buttons/rating.vue';
    import btnbuy from '../buttons/btn_buy.vue';
     import btnfave from '../buttons/fave.vue';
    import myOwnServicesIntheCat from './singelServices.vue';
    import otherServicesIntheCat from '../users/singelServices.vue';
    import sidebar from './sidebar.vue';
     import Header from '../layouts/header.vue';

    var spinner = require('vue-strap/dist/vue-strap.min').spinner;




    export default{
        components:{
            my_own_services_in_the_cat:myOwnServicesIntheCat,
            other_services_in_thecat:otherServicesIntheCat,
            sidebar:sidebar,
            btn_buy:btnbuy,
            spinner:spinner,
            btn_fave:btnfave,
            rating:Rating,
              header_nav:Header




        },
        data(){
            return{
                service:"",
                isloading:false,
                myOwnServicesIntheCat:[],
                otherServicesIntheCat:[],
                order_count:'',
                sum:0,
                mostvote:[],
                mostview:[],
                section:[]
            }
        },
        ready: function(){
            this.$refs.spinner.show();
            this.GetServicesById();

        },
        methods:
        {
            GetServicesById: function(){
                this.$http.get('/GetServicesById/'+this.$route.params.services_id).then(function(res){
                  
                 this.service=res.body['service'];
                 this.myOwnServicesIntheCat=res.body['myOwnServicesIntheCat'];
                 this.otherServicesIntheCat=res.body['otherServicesIntheCat'];
                 this.order_count=res.body['order_count'];
                 if (res.body['sum']) {
                  this.sum=res.body['sum'];
                 }
                 
                 this.mostvote=res.body['mostvote'];
                  this.mostview=res.body['mostview'];
                     this.section=res.body['sidebarsection2'];
                  

                 


                 this.$refs.spinner.hide();
                 this.isloading=true;


                 


             },function(res){
                this.$router.go(
                    {path:'/'}
                    );

            });

            }
        },
        events:{
          addNewVot:function(value){
           this.service.vote_count +=1;
            this.sum = parseInt(this.sum )+parseInt(value);
            //console.log(this.sum += value);
              
          }
        },

        route:{
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
