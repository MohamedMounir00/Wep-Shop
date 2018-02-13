<template>
	<div class="col-lg-12">


         <ol class="breadcrumb">
       <li v-if="pathurl == '/GetMySendMessage'"> <a v-link="{path:'/GetMySendMessage'}" >الصادر</a></li>
       <li v-if="pathurl == '/GetMyNewMessage'"> <a v-link="{path:'/GetMyNewMessage'}" >رسائل غير مقروئه</a></li>
       <li v-if="pathurl == '/GetMyReseviedMessage'"> <a v-link="{path:'/GetMyReseviedMessage'}" >الوارد</a></li>
         <li v-if="pathurl == '/GetMyReadMessage'"> <a v-link="{path:'/GetMyReadMessage'}" >رسائل مقروئه</a></li>

       <li class="active">({{messagelist.length}})</li>

                 </ol>
                      <div class="row">
  <div class="col-lg-6 col-sm-12 pull-right">
    <div class="btn-group ">
     
      
      <button class="btn btn-info" @click="Sort('seen')">
        
       المشاهده
      </button>
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
                    <span v-if="type == 'income'">
                      اسم المرسل 
                    </span>
                    <span v-else>
                     اسم المرسل اليه
                 </span>
             </th>
             <th>
                عنوان الرساله
            </th>
            <th>
                ارسلت فى
            </th>
            <th>
                الحاله
            </th>
            <th>
                مشاهدع
            </th>
            <th>
               
            </th>
        </tr>
        <tbody v-if="messagelist.length > 0">
                <tr v-for="message in messagelist | orderBy sortkey unvircse |filterBy title in 'title'">
                            <td>

                                <span v-if="message.get_resived_user">
                                <a v-link="{name:'/UserServices',params:{user_id:message.get_resived_user.id , username:message.get_resived_user.name}}">
                                   {{message.get_resived_user.name}}
                                   </a>
                               </span>

                               <span v-else>
                               <a v-link="{name:'/UserServices',params:{user_id:message.get_send_user.id , username:message.get_send_user.name}}">
                                {{message.get_send_user.name}}
                                </a>
                            </span>
                        </td>
                        <td>{{message.title}}</td>
                        <td>{{message.created_at}}</td>
                        <td>
                            <span v-if="message.seen == 1">
                                <span class=" label label-success">
                                   <i class="fa fa-eye"></i>
                               </span>
                           </span>
                           <span v-else>
                            <span class=" label label-danger">
                               <i class="fa fa-eye"></i>
                           </span>
                       </span>
                    </td>
                    <td>
                       <a v-link="{name:'/GetThisMessageDetiles', params:{message_id:message.id ,viewtype:type}}" class="btn btn-info">
                          مشاهده
                      </a>
                        <span v-if="message.get_resived_user">
                              
                                     <a v-link="{name:'/SendMessage', params:{user_id:message.get_resived_user.id }}" class="btn btn-warning">
                                      <i class="fa fa-reply"></i>
                                   </a>
                               </span>

                               <span v-else>
                             
                                  <a v-link="{name:'/SendMessage', params:{user_id:message.get_send_user.id}}" class="btn btn-warning">
                                  <i class="fa fa-reply"></i>
                                </a>
                            </span>
                    
                      </a>
                    </td>
                </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="6">
                             ليس لديك  رسائل 
                        </td>
                    </tr>
                </tbody>
</table>

</div>
</template>
<script >
	
	export default{
		props:['messagelist' ,'type'],
        data:function(){
            return {
                pathurl:"",
                sortkey:'',
                unvircse:1,
                title:''

            }},
            ready:function(){
                this.pathurl=this.$route.path;

            },
            methods:{
                 Sort:function(Sort)
 {
  this.unvircse= (this.sortkey == Sort) ? this.unvircse * -1 : 1;
  this.sortkey= Sort;
}
            }
            ,route:{
        canReuse:false,///forse reload data
      }

	}
</script>