<template>
	<div class="col-lg-12">


         <ol class="breadcrumb">
       <li> <a v-link="{path:'/GetMyFaveroits'}" >المفضله</a></li>


       <li class="active">({{favelist.length}})</li>

                 </ol>
                      <div class="row">
  <div class="col-lg-6 col-sm-12 pull-right">
    <div class="btn-group ">
     
      
    
      <button class="btn btn-info" @click="Sort('created_at')">
        
        على حسب التاريخ
      </button>
    </div>
  </div>
  <div class="col-lg-5 col-sm-12 pull-left text-left">
    <input type="text" name="" v-model="title" placeholder="عنوان الرساله" class="form-control">
  </div>
</div>
                 <br>
        <table class="table table-striped table-responsive" >


            <tr>
                <th> 
                  صاحب الخدمه
             </th>
             <th>
            اسم الخدمه
            </th>
            <th>
               اضيفت فى
            </th>
            <th>
            	حذف
            </th>
            
           
        </tr>
        <tbody v-if="favelist.length > 0">
                <tr v-for="list in favelist | orderBy sortkey unvircse |filterBy title in 'services.name' 'getuser_servises.name'" track-by="$index">
                            <td>
                                <a v-link="{name:'/UserServices',params:{user_id:list.getuser_servises.id , username:list.getuser_servises.name}}">
                                   {{list.getuser_servises.name}}
                                   </a>
                                   </td>
                        <td>
                        <a v-link="{name:'ServicesDetails',params:{services_id:list.services.id, services_name:list.services.name}}">

                        {{list.services.name}}
                        </a>

                        </td>
                        <td>{{list.created_at}}</td>
                        <td>
                         <a @click.prevent="Deletefav(list.id ,$index)" class="btn btn-danger">
                         <i class="fa fa-trash"></i>
                      </a>
                    </td>
                   
                </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="6">
                            لا يوجد خدمات مفضله
                        </td>
                    </tr>
                </tbody>
</table>
<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
</div>
</template>
<script >
	  var spinner = require('vue-strap/dist/vue-strap.min').spinner;

	export default{
		  components:{
            spinner:spinner,
        },

		props:['favelist'],
        data:function(){
            return {
              
                sortkey:'',
                unvircse:1,
                title:''

            }},
            ready:function(){
               

            },
            methods:{
                 Sort:function(Sort)
 {
  this.unvircse= (this.sortkey == Sort) ? this.unvircse * -1 : 1;
  this.sortkey= Sort;
}
,
Deletefav:function(id ,index){

this.$refs.spinner.show();
	 this.$http.get('/Deletefav/'+id).then(function(res){
	 	this.favelist.splice(index , 1);
    this.$dispatch('DeleteFaveParent' , res.body);
    this.$refs.spinner.hide();
    this.isloading=true;
  }, function(res){
    alert('هناك خهطاء برجاء مراسله الاداره');
  }); 
}
            }
        
	}
</script>