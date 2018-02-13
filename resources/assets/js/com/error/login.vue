<template>
<header_nav></header_nav>
      <div class="container">
      <div>
      	<h1>
      		خطاء فى التصريح
      	</h1>
      	<div class="alert alert-danger">
      		<span>
      			
      				لا تملك تصريح لدخول هذه الصفحه برجاء 
      			
      		</span>
      		<a href="/login">
      		<i class="fa fa-user"></i>
      		تسجيل الدخول</a>
      	    <a href="/register">
      	     <i class="fa fa-user-plus"></i>
             تسجيل عضويه جديده</a>

      	</div>
      </div>
 </div>
	

</template>
<script >
	            import Header from '../layouts/header.vue';


  export default{
   components:{

                  header_nav:Header,

   },
}
</script>