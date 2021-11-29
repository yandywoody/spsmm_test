<template>
    <div>
        <h2 class="text-center">Locations List</h2>
        <router-link :to="{name: 'location-create'}" class="btn btn-success">Create +</router-link>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Max Qty</th>
                    <th>Area</th>
                    <th>Zone</th>
                    <th>Aisle</th>
                    <th>Bay</th>
                    <th>Level</th>
                    <th>Posistion</th>
                    <th>Group</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="location in locations" :key="location.id">
                    <td>{{location.id}}</td>
                    <td>{{location.name}}</td>
                    <td>{{location.max_qty}}</td>
                    <td>{{location.area}}</td>
                    <td>{{location.zone}}</td>
                    <td>{{location.aisle}}</td>
                    <td>{{location.bay}}</td>
                    <td>{{location.level}}</td>
                    <td>{{location.position}}</td>
                    <td>{{location.id_group}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'location-edit', params: {id: location.id}}" class="btn btn-success">Edit </router-link>
                            <button class="btn btn-danger" @click="deletelocation(location.id)">Delete</button>
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
          return{locations:[]}
        },
       created(){
            this.axios.get(this.$base_url_api + 'locations/').then(response => {
                this.locations = response.data;
             });
        },
       methods:{
           deletelocation(id){
                this.axios.delete(this.$base_url_api + 'locations/' + id).then(response =>{
                    let i=this.locations.map(data=>data.id).indexOf(id);
                    Toast.fire({
                        icon: 'success',
                        title: 'Location deleted successfully'
                    })
                    this.locations.splice(i, 1)
                });
            }
        }
    } 
</script>