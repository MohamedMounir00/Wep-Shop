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
             <fave_list :favelist="favelist" :type="income"></fave_list>
            
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

    import favelist from './FaveList.vue';
    import MnueMessage from '../message/MessageMenu.vue';
            import Header from '../layouts/header.vue';

    export default{
        components:{
            spinner:spinner,
    Mssage_menu:MnueMessage,
    fave_list:favelist,
               header_nav:Header

},
    data(){
            return {
                favelist:[],
                 isloading:false,
                 income:'income'
                }
            },
            ready: function(){
  this.$refs.spinner.show();

  this.GetMyFav();
},

            methods:{
                GetMyFav:function(){

     this.$http.get('/GetMyFav/').then(function(res){

     this.favelist=res.body;
    this.$refs.spinner.hide();
    this.isloading=true;
  }, function(res){
   // alert('هناك خهطاء برجاء مراسله الاداره');
  }); 
 }

            }
            ,route:{
        canReuse:false,///forse reload data
      }
,events:{
  DeleteFaveParent:function(value){
    this.$broadcast('DeletToHeader',value);
  },
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