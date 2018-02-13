<template>
<header_nav></header_nav>
      <div class="container">
    <div>
    <span v-show="isloading">
        <div class="col-lg-12">
        
    
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2 col-sm-12 col-xs-12 pull-right">
          <Mssage_menu ></Mssage_menu>
        </div>
        <div class="col-sm-9 col-md-10 col-sm-12 col-xs-12 pull-left">
  
                <hr>
             <message_list :messagelist="messagelist" :type="income"></message_list>
            
        </div>
    </div>
</div>
</span>
<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
    </div>
        </div>

</template>
<script >
  var spinner = require('vue-strap/dist/vue-strap.min').spinner;

    import MnessageList from './MessageList.vue'
    import MnueMessage from './MessageMenu.vue';
            import Header from '../layouts/header.vue';

    export default{
        components:{
            spinner:spinner,
    Mssage_menu:MnueMessage,
    message_list:MnessageList,
               header_nav:Header

},
    data(){
            return {
                messagelist:[],
                 isloading:false,
                 income:'income'
                }
            },
            ready: function(){
  this.$refs.spinner.show();

  this.GetMessageList();
},

            methods:{
                GetMessageList:function(){

                   this.$http.get('/GetMyReadMessage/').then(function(res){

     this.messagelist=res.body;
    this.$refs.spinner.hide();
    this.isloading=true;
  }, function(res){
   // alert('هناك خهطاء برجاء مراسله الاداره');
  }); 
 }
 ,Sort:function(Sort)
 {
  this.unvircse= (this.sortkey == Sort) ? this.unvircse * -1 : 1;
  this.sortkey= Sort;
}
            }
            ,route:{
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