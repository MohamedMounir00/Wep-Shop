<template>
   
    <div class="thumbnail" >
        <a v-link="{name:'ServicesDetails',params:{services_id:service.id, services_name:service.name}}">
            <h3 class="text-center"><span class="label label-default">{{ service.name}}</span></h3></a>
            <img v-bind:src="'/images/services/'+service.image" class="img-responsive">
            <div class="caption">
                <div class="row">
                    <div class="col-md-6 col-xs-6 price text-left">
                        <h3>
                            <label>${{ service.price}}</label></h3>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <h3>
                             <a  v-link="{name:'/UserServices' ,params :{user_id:service.user_id,username:service.username }}">
                                {{ service.username}}
                            </a> 
                        </h3>

                    </div>
                   
                </div>
                
                    
                    <div class="product-rating pull-left">
                   

                        </div>
                        <div class="pull-left">
                          <span class=" label label-info">
                            <i class=" fa fa-user"></i>
                            
                            {{service.vote_count}}
                          </span>
                            <span class=" label label-warning" v-if="service.vote_sum">
                            <i class=" fa fa-star"></i>
                           
                            {{service.vote_sum}}
                          </span>
                          <span  class=" label label-warning" v-else>
                               <i class=" fa fa-star"></i>0

                          </span>
                           
                          <span class="label label-success" v-if="service.vote_sum ">
                         
                            {{(service.vote_sum * 100 /(service.vote_count*5))}} %
                          </span>
                           <span class="label label-success" v-else>
                               0%
                           </span>
                        </div>
                       <div class="clearfix"></div>
              
                
                
                <div>
                   <btn_buy :service="service"></btn_buy>
                   <btn_fav :service="service"></btn_fav>


               </div> 
               

               <div class="clearfix">
               </div>

               
           </div>
       </div>


   </template>

   <script>
    import btnbuy from '../buttons/btn_buy.vue';
        import btnfave from '../buttons/fave.vue';
        import Rating from '../buttons/rating.vue';


    export default{
        components:{
            btn_buy:btnbuy,
             btn_fav:btnfave,
              rating:Rating
        },
        props:['service'],
          data(){
            return{
            
               
                sum:0
            }
        },
        filters:
        {
            limit: function (string ,value){
                return string.substring(0 ,value )+'...';
            }
        }

    }
</script>
