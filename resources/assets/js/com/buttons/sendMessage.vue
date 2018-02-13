<template>
	<div >
		<a v-link="{name:'/SendMessage', params:{user_id:user.id}}" class="btn btn-info">
	<i class="fa fa-send"></i>
	ارسل رساله
	{{user.name}}
</a>
	</div>
</template>
<script >
	export default{
		props:['user']
	}
</script>