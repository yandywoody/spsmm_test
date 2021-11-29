<template>
    <div>
        <h2 class="text-center">Product List</h2>
        <router-link :to="{name: 'product-create'}" class="btn btn-success">Create + </router-link>
        <br /><br />

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Detail</th>
                    <th>Location</th>
                    <th>Stock</th>
                    <th>Satuan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{product.id}}</td>
                    <td>{{product.name}}</td>
                    <td>{{product.detail}}</td>
                    <td>{{product.location.name}}</td>
                    <td>{{product.stock}}</td>
                    <td>{{product.satuan}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'product-edit', params: {id: product.id}}" class="btn btn-success">Edit </router-link>
                            <button class="btn btn-danger" @click="deleteproduct(product.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default{
       data(){
          return{products:[]}
        },
       created(){
            this.axios.get(this.$base_url_api + 'products/').then(response => {
                this.products = response.data;
             });
        },
       methods:{
           deleteproduct(id){
                this.axios.delete(this.$base_url_api + 'products/' + id).then(response =>{
                    let i=this.products.map(data=>data.id).indexOf(id);
                    Toast.fire({
                        icon: 'success',
                        title: 'Product deleted successfully'
                    })
                    this.products.splice(i, 1)
                });
            }
        }
    } 
</script>