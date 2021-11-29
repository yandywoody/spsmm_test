<template>
    <div>
        <h2 class="text-center">User List</h2>
        <router-link :to="{name: 'user-create'}" class="btn btn-success">Create +</router-link>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>NIK</th>
                    <th>Departemen</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.nik}}</td>
                    <td>{{user.departement}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'user-edit', params: {id: user.id}}" class="btn btn-success">Edit </router-link>
                            <button class="btn btn-danger" @click="deleteuser(user.id)">Delete</button>
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
          return{users:[]}
        },
       created(){
            this.axios.get('http://localhost:8000/api/users/').then(response => {
                this.users = response.data;
             });
        },
       methods:{
           deleteuser(id){
                this.axios.delete('http://localhost:8000/api/users/' + id).then(response =>{
                    let i=this.users.map(data=>data.id).indexOf(id);
                    Toast.fire({
                        icon: 'success',
                        title: 'Location deleted successfully'
                    })
                    this.users.splice(i, 1)
                });
            }
        }
    } 
</script>