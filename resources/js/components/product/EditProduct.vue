<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
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
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/product" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                product:{},
                dtLoc: [],                
            }
        },
        created(){
            this.axios.get(this.$base_url_api + 'products/${this.$route.params.id}').then((
                res)=> {this.product = res.data;}
            );

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
            updateProduct(){
                this.axios.patch(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product).then((res)=> 
                {this.$router.push({name: 'product'});});
                           }
                 }
                } 
</script>