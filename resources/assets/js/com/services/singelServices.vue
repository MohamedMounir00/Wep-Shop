<template>
            <div class="container">
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
                               <a href="#" v-link="{name:'/UserServices' ,params :{user_id:service.user_id,username:service.username }}">
                                {{ service.username}}
                            </a> 
                        </h3>

                    </div>

                </div>
                <p>{{ service.des  | limit '30'}}</p>
                <p ><i class="fa fa-eye"></i>
                    {{service.view_count}}
                </p>
                
                <span v-if="service.status ==0" class="btn btn-warning col-md-12 btn-product">
                    <span class="fa fa-clock-o"></span>
                    :
                    فى الانتظار

                </span>
                <span v-if="service.status ==1" class="btn btn-success col-md-12 btn-product">
                    <span class="fa fa-check"></span>
                    :
                    تم الموافقه

                </span>
                <span v-if="service.status ==2" class="btn btn-danger col-md-12 btn-product">
                    <span class="fa fa-close"></span>
                    :
                    تم رفض الخدمه

                </span>
                <div class="clearfix"></div>

                
            </div>
        </div>

</div>
    </template>

    <script>

        export default{
   
            props:['service'],
            filters:
            {
                limit: function (string ,value){
                    return string.substring(0 ,value )+'...';
                }
            }
            


        }
    </script>
