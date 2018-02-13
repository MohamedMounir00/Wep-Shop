<template>
            <span v-if="isloading">

  <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container  ">

        <div class="navbar-header pull-right">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand pull-right"  v-link="{path:'/'}">SHOPS</a>

            <form class="navbar-form navbar-right" style="padding-right:50px" >


                <div class="form-group">
                    <input type="text" class="form-control" placeholder="بحث">
                </div>
                <button type="submit" class="btn btn-info">بحث</button>
            </form>
        </div>

        <div class="collapse navbar-collapse js-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-folder"></i>
                     الاقسام <span class="caret"></span></a>                
                     <ul class="dropdown-menu mega-dropdown-menu">
                 <li class="col-sm-3 pull-right" v-for="c in cat">
                 <ul class="text-right">
                 
                         
                 <li>
                 <a  v-link="{name:'/Cat' , params:{cat_id:c.id ,cat_name:c.name}}" >
                 {{ c.name }}</a>
                 </li>
                           
                        
                </ul>
                 </li>

                     </ul>
                 </li>
             </ul>       


             


  <ul class="nav navbar-nav navbar-left" v-if="login">
  <li class="dropdown ">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" ><span class="hidden-lg hidden-md">الرسائل</span>
                         <span ><i class="fa fa-envelope"></i></span>
                           <span class="caret"></span>

                                </a>

                 <ul class="dropdown-menu" role="menu">
                     <li class="text-right" ><a v-link="{path:'/GetMyReseviedMessage'}"><i class="fa fa-reply"></i>  الوارد</a></li>
                     <li class="text-right" ><a v-link="{path:'/GetMySendMessage'}"><i class="fa fa-share"></i>  الصادر</a></li>
                     <li class="text-right"><a v-link="{path:'/GetMyNewMessage'}"><i class="fa fa-eye-slash"></i>  غير مقروائه</a></li>
                      <li class="text-right"><a v-link="{path:'/GetMyReadMessage'}"><i class="fa fa-eye"></i>  مقروائه</a    ></li>

                             </ul>
                         </li>
  <li class="dropdown">
            <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <i class="fa fa-money"></i> <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu" >
             <li class="text-right"><a  v-link="{path:'/ShowAllCharge'}"><i class="fa fa-money"></i> عمليات شحن رصيدي</a></li>
             <li class="text-right"><a v-link="{path:'/AddCredit'}"><i class="fa fa-plus"></i> شحن رصيدى</a></li>
             <li class="text-right"><a v-link="{path:'/ShowAllPay'}"><i class="fa fa-minus"></i> المدفوعات</a></li>
             <li class="text-right"><a v-link="{path:'/profit'}"><i class="fa fa-briefcase"></i> الارباح</a></li>
             <li class="text-right"><a v-link="{path:'/RetainedProfits'}"><i class="fa fa-check"></i> ارباح محتجزه</a></li>

             <li class="text-right"><a v-link="{path:'/Blance'}"><i class="fa fa-money"></i> رصيدى</a></li>



         </ul>
          </li>
  <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <i class="fa fa-user"></i> <span class="caret"></span>
           </a>

                   <ul class="dropdown-menu" role="menu">
                <li class="text-right"><a href="logout"><i class="fa fa-edit"></i>تعديل بيناتى</a></li>


            <li class="text-right"><a href="logout"><i class="fa fa-btn fa-sign-out"></i>تسجيل الخروج</a></li>
                  </ul>
         </li>
  <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
         <i class="fa fa-first-order"></i>
         <span class="caret"></span>
     </a>

     <ul class="dropdown-menu" role="menu">
        <li class="text-right"><a v-link="{path:'/IncomedOrder'}"><i class="fa fa-truck"></i> الطلبات الوارده</a></li>
        <li class="text-right"><a v-link="{path:'/SendOrder'}"><i class="fa fa-cart-plus"></i>الطلبات المنهيه</a></li>

        </ul>
      </li>
  <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-server" aria-hidden="true"></i>
                  <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li class="text-right"><a v-link="{path:'/AddServices'}"><i class="fa fa-plus"></i>اضافه خدمه</a></li>
                <li class="text-right"> <a v-link="{path:'/Myservices'}"><i class="fa fa-user"></i>خدماتى</a></li>

                  </ul>
                </li>
 <li class="dropdown">
               <a href="#" @click="notAll" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                   <span class="fa fa-bell">
                   </span>
                   <span class=" posation notbell">

                     {{ not }}


                 </span>

             </a>
             <ul class="dropdown-menu" role="menu" style="width:250px !important">
               <li role="separator" class="divider "></li>
               <li v-if="loadingNot" class="text-center">
                  <img v-bind:src="'/images/loading.gif'">
              </li>
              <li  class="text-right" v-for=" note in Allnot"> 


                 <note_list :n="note"></note_list>



                 <hr>

                 </li>

             <li  class="text-center"> <a  v-link="{path:'/Notfication'}"><i class="fa fa-bell"></i>كل الاشعرات</a></li>

                 </ul>
                  </li>
 <li >
               <a v-link="{path:'/GetMyFaveroits'}">
                   <span class="fa fa-heart">
                   </span>
                   <span class=" posation not">
                       {{ fav }}
                   </span>

                   <span class="hidden-lg hidden-md">المفضله</span>
               </a>
               </li>
 <li >
     <a v-link="{path:'/SendOrder'}">
      <i class="fa fa-cart-plus"> </i>
      <span class=" posation notorder">
       {{ orders }}
      </span>
  
        <span class="hidden-lg hidden-md">المفضله</span>
        </a>
       </li>
</ul>   
  <ul class="nav navbar-nav navbar-left" v-if="!login">

 <li >
               <a href="/login">
                   <span class="fa fa-user">
                  تسجيل دخول
                   </span>

               </a>
               </li>
 <li>
   <a href="/register">
                   <span class="fa fa-user-plus">
                  تسجيل عضويه جديده
                   </span>

               </a>
       </li>
</ul>       
</div>
</div>
</nav>
</span>
<!--
<spinner v-ref:spinner size="lg" fixed text="جارى التحميل"></spinner>
-->
</template>
<script>
 // var spinner = require('vue-strap/dist/vue-strap.min').spinner;

   import Note from '../buttons/note.vue';

   export default{
    components:{
     //spinner:spinner,

       note_list:Note



   },
   data: function(){

      return{
          orders:0,
          not:0,
          fav:0,
          Allnot:[],
          loadingNot:false,
          login:true,
          cat:[],
          isloading:false



      }
  },
  
  ready: function(){
     // this.$refs.spinner.show();
                 this.isloading=false;

   this.GetAllInfo();
},
methods:{
    GetAllInfo:function(){
        this.$http.get('/GetAllNot').then(function(res){
            if (res.body['login'] == 'errorLogin') {
                this.login=false;
                this.$dispatch('Auth','false');
            }else{
            this.$dispatch('Auth','true');
            this.fav=res.body['fav'];
            this.not=res.body['note'];
            this.orders=res.body['orders'];

}
             this.cat=res.body['cat'];

    //this.$refs.spinner.hide();
                 this.isloading=true;

        } ,function(res){
           alert('خطاء رقم 1000');

        });
    },
    notAll:function(){
        this.loadingNot=true
        this.$http.get('/notAll').then(function(res){
            this.loadingNot=false

            this.Allnot=res.body['note'];
            this.not=res.body['noteSum'];


        } ,function(res){
            alert('خطاء رقم 1002');
        }); 
    }

},
events:{
    AddToSonInHeader:function(value)
    {
       this.fav = parseInt(value);
                 //console.log(this.fav + value);


             }
             ,DeletToHeader:function(value){
               this.fav = parseInt(value);

           }
       }
   }
</script>