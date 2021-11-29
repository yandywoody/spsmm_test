<template>
    <div>
        <h3 class="text-center">Create Location</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addLocation">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="location.name">
                    </div>
                    <div class="form-group">
                        <label>Max Qty</label>
                        <input type="text" value=0 class="form-control" v-model="location.max_qty">
                    </div>
                    <div class="form-group">
                        <label>Area</label>
                        <input type="text" value=0 class="form-control" v-model="location.area">
                    </div>
                    <div class="form-group">
                        <label>Zone</label>
                        <input type="text" value=0 class="form-control" v-model="location.zone">
                    </div>
                    <div class="form-group">
                        <label>Aisle</label>
                        <input type="text" value=0 class="form-control" v-model="location.aisle">
                    </div>
                    <div class="form-group">
                        <label>Bay</label>
                        <input type="text" value=0 class="form-control" v-model="location.bay">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input type="text" value=0 class="form-control" v-model="location.level">
                    </div>
                    <div class="form-group">
                        <label>Posistion</label>
                        <input type="text" value=0 class="form-control" v-model="location.position">
                    </div>
                    <div class="form-group">
                        <label>Group</label>
                        <input type="text" value=0 class="form-control" v-model="location.id_group">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{location:{}}
               },
        methods:{
            addLocation(){
                this.axios.post(this.$base_url_api + 'locations', this.location).then((res)=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'Location created successfully'
                    });
                    this.$router.push({name: 'location'});
                     
                }).catch(err=> console.log(err))
                .finally(()=> this.loadin=false);                
            }
        }
    } 
</script>