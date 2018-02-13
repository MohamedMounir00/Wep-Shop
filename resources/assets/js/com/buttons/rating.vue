<template>
<div>
	 
                        <div class="rating" v-if="rating">
   
    <input type="radio" id="star5" name="rating" value="5" @click.prevent="Addrating(5)" /><label for="star5" title="Rocks!">5 stars</label>

    <input type="radio" id="star4" name="rating" value="4" @click.prevent="Addrating(4)" /><label for="star4" title="Pretty good">4 stars</label>

    <input type="radio" id="star3" name="rating" value="3" @click.prevent="Addrating(3)" /><label for="star3" title="Meh">3 stars</label>

    <input type="radio" id="star2" name="rating" value="2" @click.prevent="Addrating(2)" /><label for="star2" title="Kinda bad">2 stars</label>

    <input type="radio" id="star1" name="rating" value="1" @click.prevent="Addrating(1)" /><label for="star1" title="Sucks big time">1 star</label>
</div>
<div class="rating" v-if="!rating">
	<label v-for="n in ratingValue" class="fa fa-star ratingStyleActive" ></label>
</div>
<div v-if="error">
	<div class="alert alert-danger" style="font-size:14px">
		<b> :خطاء</b>
		<span>
			لا يمكنك اضافه تقيم
		</span>
	</div>
</div>
</div>
</template>


<script>
	export default{
		props:['service'],
data(){
	return{
    rating:true,
    ratingValue:'',
    error:false
	}
},
		
		methods:{
			Addrating:function(value)
			{
				this.$http.get('/AddNewVote/'+value+'/'+this.service.id).then(function(res){
						this.rating=false;
						this.ratingValue=value;
						this.$dispatch('addNewVot',value);
						//console.log(value);
					
				},function(res){
					this.rating=false;
					this.error=true;	
				});
			}
		}
	}
</script>