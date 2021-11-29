<template>
    <div>
        <h3 class="text-center">Create Request</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addRequest">
                    <div class="form-group">
                        <label>Doc Number</label>
                        <input id="doc_num" type="text" class="form-control" v-model="request.doc_num" disabled>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input id="name" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Doc Date</label>
                        <datepicker id="doc_date" v-model="request.doc_date" type="datetime"></datepicker>

                    </div>
                    
                </form>
            </div>
            <div class="col-md-6">
                <form @submit.prevent="addRequest">
                    <div class="form-group">
                        <label>NIK</label>
                        <select2 id="user_id" v-on:change="UserDataOnChange" v-model="request.user_id" :options="dtUser"  />
                    </div>
                    <div class="form-group">
                        <label>Departement</label>
                        <input id="departement" type="text" class="form-control" disabled>
                    </div>
                </form>
            </div>

        </div>
        <br /><br />
        <h2>Request Detail</h2>
        <table class="table" id="tbl_dtl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Lokasi</th>
                    <th>Tersedia</th>
                    <th>Quantity</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>*</th>
                </tr>
            </thead>
            <tbody id="tbl_body">
            </tbody>
        </table>
        <div class="well clearfix">
            <a class="btn btn-success pull-right add-record" v-on:click="addRow" data-added="0"><i class="glyphicon glyphicon-plus"></i> Add Row + </a>
        </div>
        <br /><br /><br />
        <div class="text-center">
            <button id="btn_proses" class="btn btn-primary" v-on:click="ProcessData">Process </button>
            <a class="btn" href="/request"> Batal </a>
        </div>
        <br /><br /><br />
        
    </div>
</template>

<script>
    export default{
        data(){
            return{
                request:{},
                dtUser: [],
                dtProduct: [],
                dtselected: {},
                total_row: 0,
            }
        },
        created(){
            var date = new Date();
            var components = [
                date.getYear(),
                date.getMonth() + 1,
                date.getDate(),
                date.getHours(),
                date.getMinutes(),
                date.getSeconds(),
            ];

            var id = components.join("");            
            this.request.doc_num = "Doc-" + id.substring(1);
            this.axios.get(this.$base_url_api + 'users/').then(response => {                
                //this.dtLoc = response.data;
                var finaldt = [];
                $.each(response.data, function(key, value) {
                    var dtlc = {
                        'id': value.id, 
                        'text': value.name + " (NIK : " + value.nik + ")",
                        'name': value.name,
                        'departement': value.departement
                    } 
                    finaldt.push(dtlc);
                });

                this.dtUser = finaldt;
            });

        },        
        methods:{
            ProcessData() { 

                var tablex = document.getElementById("tbl_dtl");
                var totalRowCount = tablex.rows.length-1;
                var canProcees = 1;
                var app = this;
                for(var i=0;i<totalRowCount;i++){
                    console.log($('#stock_'+(i+1)).text());
                    if($('#stock_'+(i+1)).text() <= 0){
                        canProcees = 0;
                    }
                }

                if(canProcees > 0){
                    $.ajax({
                        dataType: 'JSON'
                        , url: this.$base_url_api + 'request_hdrs/'
                        , type: 'POST'
                        //, processData: false
                        , contentType: 'application/x-www-form-urlencoded'
                        , cache: false
                        , data: {
                            'id': 0
                            , 'doc_num': $('#doc_num').val()
                            , 'doc_date': $('#doc_date').val()
                            , 'user_id': $('#user_id').val()
                            , 'approve': "-"
                            , 'comments': "-"
                        }                     
                        , success: function (dt) {
                            for(var i=0;i<totalRowCount;i++){
                                app.ProcessDataDtl(dt, i);
                            }
                            var delayInMilliseconds = 2000;
                            setTimeout(function() {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Request created successfully'
                                }); 
                                app.$router.push({name: 'request'});                                
                            }, delayInMilliseconds);
                            
                        }
                        , error: function (jqXHR, textStatus, errorThrown) {
                            Toast.fire({
                                icon: 'error',
                                title: textStatus + ' ' + errorThrown + ' || Check your form'
                            });     
                        }
                    });                        

                }else{
                    Toast.fire({
                        icon: 'error',
                        title: 'Cannot Process, Stock running out'
                    });                        

                }
             

            },
            ProcessDataDtl(dt, i){
                $.ajax({
                    dataType: 'JSON'
                    , url: this.$base_url_api + 'request_dtls/'
                    , type: 'POST'
                    //, processData: false
                    , contentType: 'application/x-www-form-urlencoded'
                    , cache: false
                    , data: {
                        'id': 0
                        , 'request_hdr_id': dt.id
                        , 'product_id': $('#data_product_'+(i+1)).val()
                        , 'quantity': $('#quantity_'+(i+1)).val()
                        , 'comments': $('#comments_'+(i+1)).val()
                    }                     
                    , success: function (dt) {


                    }
                    , error: function (jqXHR, textStatus, errorThrown) {
                        Toast.fire({
                            icon: 'error',
                            title: textStatus + ' ' + errorThrown + ' || Check your form'
                        });     
                    }
                });  

            },
            addRequest(){
                this.axios.post(this.$base_url_api + 'request_hdrs', this.request).then(response =>(this.$router.push({name: 'home'})))
                .catch(err=> console.log(err))
                .finally(()=> this.loadin=false)
            },
            UserDataOnChange(e) { 
                $.each(this.dtUser, function(key, value) {
                    if(value.id == e){
                        $("#departement").val(value.departement);
                        $("#name").val(value.name);

                    }
                });
            },
            addRow(){
                this.axios.get(this.$base_url_api + 'products/').then(response => {                
                    //this.dtLoc = response.data;
                    var finaldt = [];
                    $.each(response.data, function(key, value) {
                        var dtlc = {
                            'id': value.id, 
                            'text': value.name,
                            'stock': value.stock,
                            'location': value.location.name
                        } 
                        finaldt.push(dtlc);
                    });

                    this.dtProduct = finaldt;
                });

                this.total_row++;
                var element = '';
                element += '<tr valign="top">';
                element += '<td>'+this.total_row+'</td>';
                element += '<td><select id="data_product_'+this.total_row+'" name="data_product" class="form-control m-select2 data_product" style="width: 100%;"></select></td>';
                element += '<td><span id="location_name_'+this.total_row+'">-</span></td>';
                element += '<td><span id="stock_'+this.total_row+'">0</span></td>';
                element += '<td><input type="number" class="quantity" id="quantity_'+this.total_row+'" name="quantity[]" value="0" /></td>';
                element += '<td><span id="satuan_'+this.total_row+'">-</span></td>';
                element += '<td><input type="text" class="comments" id="comments_'+this.total_row+'" name="comments[]" value="-" /></td>';
                element += '<td><div id="status_'+this.total_row+'" class="p-2 rounded"></div></td>';
                element += '<td><a href="javascript:void(0);" class="remCF">Remove</a></td>';
                element += '</tr>';

                $("#tbl_body").append(element);
                $("#tbl_body").on('click','.remCF',function(){
                    this.total_row--;
                    $(this).parent().parent().remove();
                });
                $('#data_product_'+this.total_row).select2({
                    placeholder: 'Select an option'
                    , allowClear: true
                    , ajax: {
                        dataType: 'json'
                        , url: this.$base_url_api + 'products/'
                        , type: "GET"
                        //, processData: false
                        , contentType: 'application/x-www-form-urlencoded'
                        , cache: true
                        , delay: 500
                        , data: function (param) {
                            return {
                                'name': param.term == null ? '' : param.term
                            }
                        }
                        , processResults: function (data, params) {
                            return {
                                results:
                                data.map(function (item) {
                                    return {
                                        id: item['id']
                                        , text: item['name']
                                        , dt_product: item
                                    };
                                }
                            )
                            };
                        }
                    }
                }).val(null).trigger('change');  
                var currentTotalRow = this.total_row;
                var currentTotalRow = this.total_row;
                $('#data_product_'+this.total_row).on('change', function (e) {
                    var dt_prod = [];
                    if ($(this).select2('val') !== null) {
                        dt_prod.push($(this).select2('data')[0]['dt_product']);
                    } else {
                        dt_prod = [];
                    }

                    $('#location_name_'+currentTotalRow).text(dt_prod[0].location.name);
                    $('#stock_'+currentTotalRow).text(dt_prod[0].stock);
                    $('#satuan_'+currentTotalRow).text(dt_prod[0].satuan);

                });
                $('#quantity_'+this.total_row).on('change', function (e) {
                    var dtStock = $('#stock_'+currentTotalRow).text();
                    var selisih = dtStock - $(this).val();
                    if(dtStock == 0){
                        $('#status_'+currentTotalRow).removeClass('text-black');
                        $('#status_'+currentTotalRow).removeClass('bg-success');
                        $('#status_'+currentTotalRow).removeClass('bg-warning');
                        $('#status_'+currentTotalRow).removeClass('bg-danger');

                        $('#status_'+currentTotalRow).addClass('bg-danger text-white');
                        $('#status_'+currentTotalRow).text('Stock kosong');
                    } else if(selisih <= 0){
                        $('#status_'+currentTotalRow).removeClass('text-white');
                        $('#status_'+currentTotalRow).removeClass('bg-success');
                        $('#status_'+currentTotalRow).removeClass('bg-danger');
                        $('#status_'+currentTotalRow).removeClass('bg-warning');

                        $('#status_'+currentTotalRow).addClass('bg-warning text-black');
                        $('#status_'+currentTotalRow).text('Stock Sebagian');

                    }else{
                        $('#status_'+currentTotalRow).removeClass('text-black');
                        $('#status_'+currentTotalRow).removeClass('bg-success');
                        $('#status_'+currentTotalRow).removeClass('bg-warning');
                        $('#status_'+currentTotalRow).removeClass('bg-danger');

                        $('#status_'+currentTotalRow).addClass('bg-success text-white');
                        $('#status_'+currentTotalRow).text('Stock Terpenuhi');

                    }
                });

            },
            removeRow(){
                $("#tbl_body").parent().parent().remove();                

            }        

        },
    }   
</script>