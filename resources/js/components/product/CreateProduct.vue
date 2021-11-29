<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="product.detail">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select2 v-model="product.location_id" :options="dtLoc" />
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="text" class="form-control" v-model="product.stock">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" v-model="product.satuan">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        //components: {Select2},
        data(){
            return{
                product:{},
                dtLoc: [],                
            }
        },
       created(){
            this.axios.get(this.$base_url_api + 'locations/').then(response => {
                //this.dtLoc = response.data;
                var rspn = response.data;
                var finaldt = [];
                $.each(response.data, function(key, value) {
                    var dtlc = {
                        'id': value.id, 
                        'text': value.name
                    } 
                    finaldt.push(dtlc);
                });

                this.dtLoc = finaldt;
            });

        },
        methods:{
            addProduct(){
                this.axios.post(this.$base_url_api + 'products', this.location).then((res)=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Product created successfully'
                    });
                    this.$router.push({name: 'product'});
                     
                }).catch(err=> console.log(err))
                .finally(()=> this.loadin=false);                
            }
        }
    } 
</script>