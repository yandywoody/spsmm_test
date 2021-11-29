<template>
    <div>
        <h3 class="text-center">Create User</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addUser">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" value=0 class="form-control" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" value=0 class="form-control" v-model="user.password">
                    </div>
                    <div class="form-group">
                        <label>Nik</label>
                        <input type="text" value=0 class="form-control" v-model="user.nik">
                    </div>
                    <div class="form-group">
                        <label>Departement</label>
                        <input type="text" value=0 class="form-control" v-model="user.departement">
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
            return{user:{}}
               },
        methods:{
            addUser(){
                this.axios.post('http://localhost:8000/api/users', this.user).then((res)=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
                    });
                    this.$router.push({name: 'user'});
                     
                }).catch(err=> console.log(err))
                .finally(()=> this.loadin=false);                
            }
        }
    } 
</script>