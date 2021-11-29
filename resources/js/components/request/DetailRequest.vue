<template>
    <div>
        <h3 class="text-center">Create Request</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addRequest">
                    <div class="form-group">
                        <label>Doc Number</label>
                        <input id="doc_num" type="text" class="form-control" v-model="requestHdr.doc_num" disabled>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input id="name" type="text" class="form-control" v-model="requestHdr.user.name" disabled>
                    </div>
                    <div class="form-group">
                        <label>Doc Date</label>
                        <input id="doc_date" type="text" class="form-control" v-model="requestHdr.doc_date" disabled>

                    </div>
                    
                </form>
            </div>
            <div class="col-md-6">
                <form @submit.prevent="addRequest">
                    <div class="form-group">
                        <label>NIK</label>
                        <input id="NIK" type="text" class="form-control" v-model="requestHdr.user.nik" disabled>
                    </div>
                    <div class="form-group">
                        <label>Departement</label>
                        <input id="departement" type="text" class="form-control" v-model="requestHdr.user.departement" disabled>
                    </div>
                </form>
            </div>

        </div>
        <br /><br />
        <h2>Request Detail</h2>
        <table class="table" id="tbl_dtl">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Lokasi</th>
                    <th>Quantity</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="request in requestDtl" :key="request.id">
                    <td>{{request.product.name}}</td>
                    <td>{{request.product.location.name}}</td>
                    <td>{{request.quantity}}</td>
                    <td>{{request.product.satuan}}</td>
                    <td>{{request.comments}}</td>
                </tr>
            </tbody>
        </table>
        <br /><br /><br />
        <div class="text-center">
            <a class="btn btn-danger" href="/request"> Back </a>
        </div>

        <br /><br />
        
    </div>
</template>

<script>
    export default{
        data(){
            return{
                requestHdr:{},
                requestDtl:{},
            }
        },
        created(){
            var url = window.location.pathname;
            var idParam = url.substring(url.lastIndexOf('/') + 1);

            this.axios.get(this.$base_url_api + 'request_hdrs/' + idParam).then((
                res)=> {this.requestHdr = res.data[0];}
            );
            this.axios.get(this.$base_url_api + 'request_dtls/' + idParam).then(response => {                
                this.requestDtl = response.data;
            });

        },        
        methods:{
            detail() {
             

            },      

        },
    }   
</script>