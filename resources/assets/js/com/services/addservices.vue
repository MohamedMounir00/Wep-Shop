<template xmlns:v-el="http://www.w3.org/1999/xhtml">
<header_nav></header_nav>
      <div class="container">
    
        <span v-if="messages.length > 0" >
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-table="class">&times;</a>
                <b>
                    خطاء:
                </b>
                <ol>

                   <p v-for="message in messages[0]">
                    {{ message }}

                </p>
            </ol>

        </div>
    </span>
    <h1> Add Serviecs</h1>
    <div class="form-group">
        <label for=" Name">
            اسم الخدمه
        </label>
        <input type="text" name="name" id="name" v-model="name" class="form-control"/>
    </div>

    <div class="form-group">
        <label for=" Name">
            صوره الخدمه
        </label>
        <input type="file" v-el:image/>
        <span class="help-block">
            الصوره يجب ان تكون اكبر من 300 بيكسل طول وعرض واقل من 1000 بيكسل طول وعرض
        </span>

        <label for=" des">
            وصف الخمدمه </label>
            <textarea name="des" rows="10" id="des" v-model="des" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for=" cat">
             القسم            </label>
             <select  v-model="cat_id" class="form-control" >
                <option value="1">
                    القسم الاول
                </option>


            </select>
        </div>
        <div class="form-group">
            <label for=" price">
             السعر            </label>
             <select  v-model="price" class="form-control" >
                <option value="5"> 5 </option>
                <option value="10"> 10</option>
                <option value="20">20 </option>
                <option value="30">30</option>



            </select>    </div>
            <div class="form-group">

                <input type="submit"   @click="AddThisServices()" value="اضف خدمه"  class="btn btn-default" >
            </div>


</div>
    </template>

    <script>
        import Header from '../layouts/header.vue';

        export default{
          components:{
       
           header_nav:Header



        },
            data:function(){
                return{
                    name:"",
                    des:"",
                    cat_id:"",
                    image:"",
                    price:"",
                    messages:[],
                }
            },
            methods:{
               AddThisServices: function(){
                   var formdata= new FormData();
                   formdata.append('name', this.name);
                   formdata.append('des', this.des);
                   formdata.append('cat_id', this.cat_id);
                   formdata.append('price', this.price);
                   formdata.append('image', this.$els.image.files[0]);

                   this.sendDate(formdata );




               },
               sendDate:function (formdata){
                this.$http.post('/addservices' , formdata).then(function (res){
                  this.name='';
                  this.des='';
                  this.cat_id='';
                  this.price='';
                  this.image='';
                  this.messages=[];
                  if(res.body =='done')
                  {


                    alert('تمت الاضافه بنجاح');
                }else if(res.body =='checkpricefiled'){

                   alert('من فضلك عدم تغير المدخلات');
               }

               else
               {
                alert('هناك خطاء فى الاضافه');

            }


        },function(res){

          this.messages=[];
          this.messages.push(res.body);

      });
            }
        },

        route:{
        canReuse:false,///forse reload data
    },events:{
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
