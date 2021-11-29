<template>
    <div>
        <h2 class="text-center">Request List</h2>
        <router-link :to="{name: 'request-create'}" class="btn btn-success">Create + </router-link>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Doc Number</th>
                    <th>Doc Date</th>
                    <th>User</th>
                    <th>Approve</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="request in requests" :key="request.id">
                    <td>{{request.id}}</td>
                    <td>{{request.doc_num}}</td>
                    <td>{{request.doc_date}}</td>
                    <td>{{request.user.name}}</td>
                    <td>{{request.approve}}</td>
                    <td>{{request.comments}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'request-detail', params: {id:request.id}}" class="btn btn-primary">Detail </router-link>
                            <button class="btn btn-danger" @click="deleterequest(request.id)">Delete</button>
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
          return{requests:[]}
        },
       created(){
            this.axios.get(this.$base_url_api + 'request_hdrs/').then(response => {
                this.requests = response.data;
             });
        },
       methods:{
           deleterequest(id){
                this.axios.delete(this.$base_url_api + 'request_hdrs/' + id).then(response =>{
                    let i=this.requests.map(data=>data.id).indexOf(id);
                    Toast.fire({
                        icon: 'success',
                        title: 'Request deleted successfully'
                    })
                    this.requests.splice(i, 1)
                });
            }
        }
    } 
</script>