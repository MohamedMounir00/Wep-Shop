<template>
	<h1>
     تحكم فى العضو   
    </h1>
            <hr />
            <ul class="nav nav-pills nav-stacked" style="padding:0px;">
                <li ><a v-link="{path:'/GetMyReseviedMessage'}">  <span class="fa fa-reply"></span>
الوارد </a>
                </li>
                <li><a v-link="{path:'/GetMySendMessage'}" >
                 <span class="fa fa-share"></span>
                لصادر</a></li>
                <li><a v-link="{path:'/GetMyReadMessage'}" >
                 <span class="fa fa-eye"></span>
                 رسائل  مقروئه</a></li>

                <li><a v-link="{path:'/GetMyNewMessage'}" >
 <span class="fa fa-eye-slash"></span>
                رسائل غير مقروئه</a></li>
                 <li >
                         <a v-link="{path:'/GetMyFaveroits'}">
                             <span class="fa fa-heart"></span>
                            المفضله
                         </a>
                     </li>
                         <li >
                         <a v-link="{path:'/Notfication'}">
                             <span class="fa fa-bell"></span>
                            الاشعرات
                         </a>
                     </li>
                
                

                
               
            </ul>
</template>
<script>
	
	export default{

	}
</script>