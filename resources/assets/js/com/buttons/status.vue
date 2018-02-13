<template>
	<div>
		<span  v-if="status ==0">
			<span class=" label label-info">
				طلب جديد
			</span>
		</span>
		<span  v-if="status ==1">
			<span class="label label-default">
				طلب قديم
			</span>
		</span>
		<span  v-if="status ==3">
			<span class="label label-danger">
				طلب ملغي
			</span>
		</span>
		<span  v-if="status ==2">
			<span class="label label-warning">
				طلب قيد التنفيذ
			</span>
		</span>
		<span  v-if="status ==4">
			<span class="label label-success">
				طلب منتهي
			</span>
		</span>
	</div>
</template>
<script>
	export default{
		props:['status']
	}
</script>